<?php

namespace App\Filters;
//Fungsi Ini digunakan untuk perlindungan bagian dalam, jadi user tidak akan bisa mengakses halaman misal users/profile yang memiliki segment 2 sebelum login
// Jika lupa, coba hapus isi dari if dibawah, logout, lalu ketik di url users/profile, maka kau akan ingat fungsinya.

//Memanggil Fungsi Yang diperlukan
use Codeigniter\HTTP\RequestInterface;
use Codeigniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

//Membuat class UsersCheck yang mengimplementasikan FilterInterface, fci4
class UsersCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Mendapatkan url saat ini
        $uri = service('uri');

        //Jika segment 1 adalah logincontroller maka jalankan perintah ini
        if ($uri->getSegment(1) == 'logincontroller') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '') {
                $segment = '/';
            } else {
                $segment = '/' . $uri->getSegment(2);
            }
            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }

        //Jika segment 1 adalah librarycontroller maka jalankan perintah ini
        if ($uri->getSegment(1) == 'librarycontroller') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '') {
                $segment = '/';
            } else {
                $segment = '/' . $uri->getSegment(2);
            }
            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }

        //Jika segment 1 adalah usercontroller maka jalankan perintah ini
        if ($uri->getSegment(1) == 'usercontroller') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '') {
                $segment = '/';
            } else {
                $segment = '/' . $uri->getSegment(2);
            }
            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }

        //Jika segment 1 adalah admincontroller maka jalankan perintah ini
        if ($uri->getSegment(1) == 'admincontroller') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '') {
                $segment = '/';
            } else {
                $segment = '/' . $uri->getSegment(2);
            }
            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }
    }



    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
