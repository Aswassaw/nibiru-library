<?php

namespace App\Validation;

use App\Models\UserModel;

class LoginRules
{
    public function validateNis(string $str, string $fields, array $data)
    {
        $model = new UserModel();
        // Pencarian data
        $nis = $data['nis'];
        $user = $model->where('nis', $nis)->first();

        // Jika nis tersebut ada
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePassword(string $str, string $fields, array $data)
    {
        $model = new UserModel();
        // Pencarian data
        $nis = $data['nis'];
        $user = $model->where('nis', $nis)->first();

        // Jika nis salah
        if (!$user) {
            return false;
        }

        // Validasi password
        return password_verify($data['password'], $user['password']);
    }
}
