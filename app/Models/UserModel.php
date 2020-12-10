<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nis', 'nama_user', 'tanggal_lahir', 'password', 'foto_profil', 'deskripsi', 'jabatan', 'user-created_at', 'user-updated_at'];
    protected $primaryKey = 'nis';
}
