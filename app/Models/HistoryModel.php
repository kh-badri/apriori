<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table            = 'history_analisis';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'min_support',
        'min_confidence',
        'min_lift',
        'hasil_analisis',
        'jumlah_aturan'
    ];
}
