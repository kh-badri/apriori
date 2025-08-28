<?php

namespace App\Controllers;

use App\Libraries\AprioriService;

class Analisis extends BaseController
{
    public function index()
    {
        $data = [
            'active_menu' => 'analisis',
            // Ambil semua data, urutkan dari yang paling baru
        ];

        return view('analisis/index', $data);
    }

    public function proses()
    {
        // ... (Validasi input jika ada)

        $minSupport = $this->request->getPost('min_support');
        $minConfidence = $this->request->getPost('min_confidence');
        $minLift = $this->request->getPost('min_lift');

        $apriori = new AprioriService();
        $results = $apriori->run($minSupport, $minConfidence, $minLift);

        // Simpan hasil ke session agar bisa diambil oleh fungsi simpan()
        session()->set('hasil_terakhir', [
            'parameter' => [
                'min_support' => $minSupport,
                'min_confidence' => $minConfidence,
                'min_lift' => $minLift,
            ],
            'hasil' => $results
        ]);

        $data = [
            'hasil' => $results,
            'min_support' => $minSupport,
            'min_confidence' => $minConfidence,
            'min_lift' => $minLift,
            'active_menu' => 'analisis',
        ];

        return view('analisis/hasil', $data);
    }

    /**
     * Fungsi baru untuk menyimpan hasil analisis ke database.
     */
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
}
