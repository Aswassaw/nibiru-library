<?php

namespace App\Models;

use CodeIgniter\Model;

class LikebukuModel extends Model
{
    protected $table = 'likebuku';
    protected $allowedFields = ['nis_likebuku', 'no_likebuku', 'likebuku-created_at'];
    protected $primaryKey = 'id_likebuku';
}
