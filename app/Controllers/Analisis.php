<?php

namespace App\Controllers;

use App\Libraries\AprioriService;
use CodeIgniter\HTTP\ResponseInterface;

class Analisis extends BaseController
{
    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        // Ambil pesan flash jika ada
        $data = [
            'active_menu' => 'analisis',
            'success' => $this->session->getFlashdata('success'),
            'error' => $this->session->getFlashdata('error'),
        ];

        return view('analisis/index', $data);
    }

    public function proses()
    {
        // Validasi input
        $rules = [
            'min_support' => [
                'label' => 'Minimum Support',
                'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[100]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.',
                    'greater_than' => '{field} harus lebih besar dari 0.',
                    'less_than_equal_to' => '{field} tidak boleh lebih dari 100.'
                ]
            ],
            'min_confidence' => [
                'label' => 'Minimum Confidence',
                'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[100]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.',
                    'greater_than' => '{field} harus lebih besar dari 0.',
                    'less_than_equal_to' => '{field} tidak boleh lebih dari 100.'
                ]
            ],
            'min_lift' => [
                'label' => 'Minimum Lift',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.',
                    'greater_than' => '{field} harus lebih besar dari 0.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terdapat kesalahan pada input: ' . implode('<br>', $this->validator->getErrors()));
        }

        try {
            $minSupport = (float) $this->request->getPost('min_support');
            $minConfidence = (float) $this->request->getPost('min_confidence');
            $minLift = (float) $this->request->getPost('min_lift');

            $apriori = new AprioriService();
            $results = $apriori->run($minSupport, $minConfidence, $minLift);

            // Simpan hasil ke session untuk keperluan penyimpanan nanti
            $this->session->set('hasil_terakhir', [
                'parameter' => [
                    'min_support' => $minSupport,
                    'min_confidence' => $minConfidence,
                    'min_lift' => $minLift,
                ],
                'hasil' => $results,
                'timestamp' => date('Y-m-d H:i:s'),
                'transaction_count' => $apriori->getTransactionCount()
            ]);

            $data = [
                'hasil' => $results,
                'min_support' => $minSupport,
                'min_confidence' => $minConfidence,
                'min_lift' => $minLift,
                'transaction_count' => $apriori->getTransactionCount(),
                'active_menu' => 'analisis',
            ];

            return view('analisis/hasil', $data);
        } catch (\RuntimeException $e) {
            log_message('error', 'Apriori analysis error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan dalam proses analisis: ' . $e->getMessage());
        } catch (\Exception $e) {
            log_message('error', 'Unexpected error in Apriori analysis: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    public function simpan()
    {
        // Ambil data hasil terakhir dari session
        $hasilTerakhir = session()->get('hasil_terakhir');

        // Jika tidak ada data di session, kembalikan dengan error
        if (empty($hasilTerakhir)) {
            return redirect()->to('apriori/analisis')->with('error', 'Tidak ada hasil analisis untuk disimpan.');
        }

        // Siapkan data untuk dimasukkan ke database
        $dataToSave = [
            'min_support' => $hasilTerakhir['parameter']['min_support'],
            'min_confidence' => $hasilTerakhir['parameter']['min_confidence'],
            'min_lift' => $hasilTerakhir['parameter']['min_lift'],
            'hasil_analisis' => json_encode($hasilTerakhir['hasil']), // Ubah array menjadi string JSON
            'jumlah_aturan' => count($hasilTerakhir['hasil']),
        ];

        // Simpan ke database
        $db = \Config\Database::connect();
        $db->table('history_analisis')->insert($dataToSave);

        // Hapus data dari session setelah disimpan
        session()->remove('hasil_terakhir');

        // Kembalikan ke halaman history (yang akan kita buat nanti) dengan pesan sukses
        return redirect()->to('/analisis')->with('success', 'Hasil analisis berhasil disimpan ke history.');
    }

    /**
     * Method untuk melihat history analisis
     */
    public function history()
    {
        try {
            $db = \Config\Database::connect();

            // Ambil history dengan pagination
            $page = (int) ($this->request->getGet('page') ?? 1);
            $perPage = 10;
            $offset = ($page - 1) * $perPage;

            $query = $db->table('history_analisis')
                ->orderBy('created_at', 'DESC')
                ->limit($perPage, $offset);

            $history = $query->get()->getResultArray();

            // Hitung total untuk pagination
            $totalQuery = $db->table('history_analisis')->countAllResults();
            $totalPages = ceil($totalQuery / $perPage);

            $data = [
                'history' => $history,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'active_menu' => 'history',
            ];

            return view('analisis/history', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading history: ' . $e->getMessage());
            return redirect()->to('/analisis')
                ->with('error', 'Terjadi kesalahan saat memuat history.');
        }
    }

    /**
     * Method untuk melihat detail history
     */
    public function detailHistory($id)
    {
        try {
            $db = \Config\Database::connect();

            $history = $db->table('history_analisis')
                ->where('id', $id)
                ->get()
                ->getRowArray();

            if (!$history) {
                return redirect()->to('/analisis/history')
                    ->with('error', 'Data history tidak ditemukan.');
            }

            // Parse JSON hasil analisis
            $hasilAnalisis = json_decode($history['hasil_analisis'], true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \RuntimeException('Data hasil analisis rusak');
            }

            $data = [
                'history' => $history,
                'hasil' => $hasilAnalisis,
                'active_menu' => 'history',
            ];

            return view('analisis/detail_history', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading history detail: ' . $e->getMessage());
            return redirect()->to('/analisis/history')
                ->with('error', 'Terjadi kesalahan saat memuat detail history.');
        }
    }

    /**
     * Method untuk menghapus history
     */
    public function hapusHistory($id)
    {
        try {
            $db = \Config\Database::connect();

            $exists = $db->table('history_analisis')
                ->where('id', $id)
                ->countAllResults();

            if ($exists == 0) {
                return redirect()->to('/analisis/history')
                    ->with('error', 'Data history tidak ditemukan.');
            }

            if (!$db->table('history_analisis')->where('id', $id)->delete()) {
                throw new \RuntimeException('Gagal menghapus data');
            }

            return redirect()->to('/analisis/history')
                ->with('success', 'History berhasil dihapus.');
        } catch (\Exception $e) {
            log_message('error', 'Error deleting history: ' . $e->getMessage());
            return redirect()->to('/analisis/history')
                ->with('error', 'Terjadi kesalahan saat menghapus history.');
        }
    }
}
