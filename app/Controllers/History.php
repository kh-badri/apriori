<?php

namespace App\Controllers;

use App\Models\HistoryModel;

class History extends BaseController
{
    public function index()
    {
        $historyModel = new HistoryModel();

        $data = [
            'active_menu' => 'history',
            // Ambil semua data, urutkan dari yang paling baru
            'history' => $historyModel->orderBy('tanggal_analisis', 'DESC')->findAll()
        ];

        return view('history/index', $data);
    }

    public function delete($id)
    {
        $historyModel = new HistoryModel();
        $historyModel->delete($id);

        return redirect()->to(site_url('/history'))->with('success', 'Data history berhasil dihapus.');
    }
}
