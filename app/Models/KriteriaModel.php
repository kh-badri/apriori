<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $allowedFields = ['kategori', 'nilai'];

    /**
     * Fungsi ini akan mencari kriteria. Jika tidak ada, ia akan membuatnya.
     * Apapun hasilnya, ia akan mengembalikan ID dari kriteria tersebut.
     *
     * @param string $kategori
     * @param string $nilai
     * @return int ID dari kriteria
     */
    public function findOrCreate(string $kategori, string $nilai): int
    {
        // Coba cari dulu
        $kriteria = $this->where(['kategori' => $kategori, 'nilai' => $nilai])->first();

        if ($kriteria) {
            // Jika ada, kembalikan ID-nya
            return $kriteria['id'];
        } else {
            // Jika tidak ada, buat baru dan kembalikan ID yang baru dibuat
            $this->insert([
                'kategori' => $kategori,
                'nilai' => $nilai
            ]);
            return $this->insertID();
        }
    }
}
