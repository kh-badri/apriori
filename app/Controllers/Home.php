<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Mengambil data untuk grafik distribusi lokasi
        $lokasiData = $db->table('kriteria')
            ->select('nilai, COUNT(transaksi_properti.id_kriteria) as jumlah')
            ->join('transaksi_properti', 'kriteria.id = transaksi_properti.id_kriteria')
            ->where('kategori', 'Lokasi')
            ->groupBy('nilai')
            ->orderBy('jumlah', 'DESC')
            ->get()->getResultArray();

        // Format data agar bisa dibaca oleh Chart.js
        $chartLabels = [];
        $chartData = [];
        foreach ($lokasiData as $row) {
            $chartLabels[] = $row['nilai'];
            $chartData[] = $row['jumlah'];
        }

        $data = [
            'active_menu' => 'home',
            'total_properti' => $db->table('properti')->countAllResults(),
            'total_kriteria' => $db->table('kriteria')->countAllResults(),
            'chart_labels' => json_encode($chartLabels), // Kirim sebagai JSON
            'chart_data' => json_encode($chartData),     // Kirim sebagai JSON
        ];

        return view('home/index', $data);
    }
}
