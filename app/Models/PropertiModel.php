<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertiModel extends Model
{
    protected $table = 'properti'; // Nama tabel utama
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_properti'];

    /**
     * Mengambil semua data properti beserta kriteria-kriterianya
     * dalam satu string yang dipisahkan koma.
     */
    public function getPropertiWithKriteria()
    {
        // Menggunakan Query Builder untuk keamanan dan kemudahan
        return $this->db->table('properti p')
            ->select('p.id, p.nama_properti, GROUP_CONCAT(k.nilai ORDER BY k.kategori SEPARATOR ", ") as kriteria_list')
            ->join('transaksi_properti tp', 'p.id = tp.id_properti')
            ->join('kriteria k', 'tp.id_kriteria = k.id')
            ->groupBy('p.id, p.nama_properti')
            ->orderBy('p.id', 'ASC')
            ->get()
            ->getResultArray();
    }
}
