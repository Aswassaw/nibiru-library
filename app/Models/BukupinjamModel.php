<?php

namespace App\Models;

use CodeIgniter\Model;

class BukupinjamModel extends Model
{
    protected $table = 'bukupinjam';
    protected $allowedFields = ['id_bukupinjam', 'no_bukupinjam', 'nis_bukupinjam', 'status_bukupinjam', 'tanggal_pinjam', 'tanggal_kembali'];
    protected $primaryKey = 'id_bukupinjam';
}
