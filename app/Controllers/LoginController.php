<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel;
        // helper form untuk fungsi set_value
        helper(['form']);
    }

    public function index()
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            $rules = [
                // Validasi untuk form nis
                'nis' => [
                    'label' => 'Nomor Induk Siswa',
                    'rules' => 'required|validateNis[nis]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'validateNis' => '{field} yang anda masukkan salah',
                    ]
                ],
                // Validasi untuk form password
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|validatePassword[nis,password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'validatePassword' => '{field} yang anda masukkan salah',
                    ]
                ],
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['validation'] = $this->validator;
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel untuk menampung data milik user
                $nis = $this->request->getVar('nis');
                $user = $this->UserModel->find($nis);

                // Membuat session2 yang diperlukan
                session()->set(['nis' => $user['nis']]);
                session()->set(['isLoggedIn' => true]);
                // Akan diarahkan ke halaman home
                return redirect()->to(base_url('home'));
            }
        }

        $data['title'] = 'Login - Nibiru Library';
        return view('login/v_login', $data);
    }

    public function logout()
    {
        //Sintaks untuk menghancurkan semua session
        session()->destroy();
        //Redirect paksa ke halaman / atau Users::index / login page
        return redirect()->to(base_url('/'));
    }
}
