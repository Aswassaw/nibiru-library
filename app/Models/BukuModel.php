<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $allowedFields = ['no_buku', 'nama_buku', 'pengarang_buku', 'penerbit_buku', 'sampul_buku', 'kategori_buku', 'deskripsi_buku', 'status_buku', 'jumlah_dipinjam', 'love', 'buku-created_at', 'buku-updated_at'];
    protected $primaryKey = 'no_buku';
}
