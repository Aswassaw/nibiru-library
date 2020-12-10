<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $allowedFields = ['nama_kategori', 'kategori-created_at', 'kategori-updated_at'];
    protected $primaryKey = 'id_kategori';
}
