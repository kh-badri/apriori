<?php

namespace App\Controllers;

use App\Models\PropertiModel;

class Dataset extends BaseController
{
    // Fungsi ini HANYA untuk menampilkan halaman
    public function index()
    {
        $data = [
            'active_menu' => 'dataset'
        ];

        $propertiModel = new PropertiModel();
        $data['properti'] = $propertiModel->getPropertiWithKriteria();

        // Mengambil pesan flash dari session jika ada (setelah proses upload)
        $data['success'] = session()->getFlashdata('success');
        $data['error'] = session()->getFlashdata('error');

        return view('dataset/index', $data);
    }

    // Fungsi ini HANYA untuk memproses file upload
    public function upload()
    {
        // 1. Validasi file yang diupload
        $file = $this->request->getFile('dataset_csv');
        if (!$file->isValid() || $file->getExtension() !== 'csv') {
            return redirect()->to('/dataset')->with('error', 'File tidak valid! Harap unggah file dengan format .csv');
        }

        // Buka file CSV untuk dibaca
        $handle = fopen($file->getTempName(), "r");

        // Lewati baris header
        fgetcsv($handle, 1000, ",");

        // Dapatkan koneksi database
        $db = \Config\Database::connect();
        $kriteriaModel = new \App\Models\KriteriaModel(); // Kita butuh model ini

        $db->transStart(); // Mulai transaksi untuk memastikan semua data masuk atau tidak sama sekali

        // 2. Baca file baris per baris
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Asumsi urutan kolom di CSV:
            // 0: Lokasi, 1: Jenis_Tanah, 2: Jenis_Properti, 3: Luas_Tanah, 4: Jarak_Ke_Pusat, 5: Fasilitas_Sekitar
            $nama_properti_baru = "Properti " . ($db->table('properti')->countAllResults() + 1);

            // 3. Masukkan ke tabel `properti` dan dapatkan ID-nya
            $db->table('properti')->insert(['nama_properti' => $nama_properti_baru]);
            $propertiId = $db->insertID();

            // 4. Proses setiap atribut (6 kolom)
            $kategori = ['Lokasi', 'Jenis_Tanah', 'Jenis_Properti', 'Luas_Tanah', 'Jarak_Ke_Pusat_Kota', 'Fasilitas_Sekitar'];
            for ($i = 0; $i < count($kategori); $i++) {
                $nilai = $row[$i];

                // Cari ID kriteria di tabel `kriteria`
                $kriteria = $db->table('kriteria')->where(['kategori' => $kategori[$i], 'nilai' => $nilai])->get()->getRow();

                if ($kriteria) {
                    $kriteriaId = $kriteria->id;
                } else {
                    // Jika tidak ada, buat baru dan dapatkan ID-nya
                    $db->table('kriteria')->insert(['kategori' => $kategori[$i], 'nilai' => $nilai]);
                    $kriteriaId = $db->insertID();
                }

                // 5. Masukkan ke tabel `transaksi_properti`
                $db->table('transaksi_properti')->insert([
                    'id_properti' => $propertiId,
                    'id_kriteria' => $kriteriaId
                ]);
            }
        }

        fclose($handle);
        $db->transComplete(); // Selesaikan transaksi

        if ($db->transStatus() === FALSE) {
            return redirect()->to('/dataset')->with('error', 'Gagal mengimpor dataset ke database.');
        } else {
            return redirect()->to('/dataset')->with('success', 'Dataset berhasil diimpor!');
        }
    }
    public function hapusSemua()
    {
        $db = \Config\Database::connect();

        // 1. Matikan sementara pemeriksaan foreign key
        $db->query('SET FOREIGN_KEY_CHECKS = 0');

        // 2. Mulai transaksi database
        $db->transStart();

        // 3. Lakukan proses truncate pada setiap tabel
        $db->table('transaksi_properti')->truncate();
        $db->table('properti')->truncate();
        $db->table('kriteria')->truncate();

        // 4. Selesaikan transaksi
        $db->transComplete();

        // 5. Aktifkan kembali pemeriksaan foreign key setelah selesai
        $db->query('SET FOREIGN_KEY_CHECKS = 1');

        if ($db->transStatus() === false) {
            // Jika terjadi error, kirim pesan gagal
            return redirect()->to(site_url('dataset'))->with('error', 'Gagal menghapus dataset.');
        } else {
            // Jika berhasil, kirim pesan sukses
            return redirect()->to(site_url('dataset'))->with('success', 'Seluruh dataset berhasil dihapus.');
        }
    }
}
