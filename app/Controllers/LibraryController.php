<?php

namespace App\Controllers;

// Model yang diperlukan
use App\Models\UserModel;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\BukupinjamModel;
use App\Models\LikebukuModel;

class LibraryController extends BaseController
{
    protected $UserModel;
    protected $BukuModel;
    protected $KategoriModel;
    protected $BukupinjamModel;
    protected $LikebukuModel;

    public function __construct()
    {
        $this->UserModel = new UserModel;
        $this->BukuModel = new BukuModel;
        $this->KategoriModel = new KategoriModel;
        $this->BukupinjamModel = new BukupinjamModel;
        $this->LikebukuModel = new LikebukuModel;
        // l = nama hari, d-m-yy = hari, bulan, dan tahun, H:i:s = jam, menit, dan detik.
        $this->Waktu = date('l, d-m-yy, H:i:s');
        // helper form untuk fungsi set_value
        helper(['form']);
    }

    // Method untuk halaman home
    public function index()
    {
        $data['title'] = 'Home - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['new_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, deskripsi_buku, buku-created_at')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->orderBy('buku-created_at', 'DESC')->findAll(3);
        $data['banyak_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, deskripsi_buku, jumlah_dipinjam')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->orderBy('jumlah_dipinjam', 'DESC')->findAll(3);
        $data['populer_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, deskripsi_buku, love')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->orderBy('love', 'DESC')->findAll(3);
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('library/v_home', $data);
    }

    // Method untuk halaman library
    public function library()
    {
        // Jika terdapat request dengan nama kategori
        if ($this->request->getVar('kategori')) {
            if ($this->request->getVar('kategori') == 'Tidak') {
                session()->remove('kategori_library');
            } else {
                session()->set(['kategori_library' => $this->request->getVar('kategori')]);
            }
            return redirect()->back();
        }
        // Jika ada pencarian
        if ($this->request->getVar('keyword')) {
            // Menampung keyword
            $keyword = $this->request->getVar('keyword');
            // Jika ada filter kategori
            if (session()->get('kategori_library')) {
                // Mengambil semua data buku + join kategori
                $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, deskripsi_buku')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->groupStart()->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->where('nama_kategori', session()->get('kategori_library'))->paginate(9, 'buku');
            } else {
                // Mengambil semua data buku + join kategori
                $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, deskripsi_buku')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->paginate(9, 'buku');
            }
        } else if (session()->get('kategori_library')) {
            // Mengambil semua data buku + join kategori
            $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, deskripsi_buku')->where('nama_kategori', session()->get('kategori_library'))->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->paginate(9, 'buku');
        } else {
            // Mengambil semua data buku + join kategori
            $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, deskripsi_buku')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->paginate(9, 'buku');
        }
        $data['title'] = 'Library - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['kategori'] = $this->KategoriModel->select('nama_kategori')->findAll();
        $data['pager'] = $this->BukuModel->pager;
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('library/v_library', $data);
    }

    // Method untuk link kaegori pada footer
    public function kategoriCepat($kategori)
    {
        // Mengambil kategori dari database
        $kategori_final = $this->KategoriModel->select('nama_kategori')->where('nama_kategori', $kategori)->first();
        // Jika kategori tersebut tidak ada
        if ($kategori_final == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            session()->set(['kategori_library' => $kategori_final['nama_kategori']]);
            return redirect()->to(base_url('library'));
        }
    }

    // Method untuk halaman detail buku
    public function detailBuku($no_buku)
    {
        // Jika buku tersebut tidak ada
        if ($this->BukuModel->select('no_buku')->find($no_buku) == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $data['title'] = 'Detail Buku - Nibiru Library';
            $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
            $data['buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, status_buku, pengarang_buku, penerbit_buku, love, nama_kategori, deskripsi_buku')->where('no_buku', $no_buku)->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->first();
            $data['peminjam'] = $this->BukupinjamModel->select('nis_bukupinjam')->where(['no_bukupinjam' => $no_buku, 'status_bukupinjam' => 0])->first();
            // Mengecek apakah user menyukai buku ini
            if ($data['sudah_like'] = $this->LikebukuModel->select('id_likebuku')->where(['nis_likebuku' => session()->get('nis'), 'no_likebuku' => $no_buku])->first() != null) {
                $data['sudah_like'] = true;
            } else {
                $data['sudah_like'] = false;
            }
            $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
            return view('library/v_detailbuku', $data);
        }
    }

    // Method untuk fungsi meminjam buku
    public function pinjamBuku($no_buku)
    {
        // Jika petugas mencoba meminjam buku
        if ($this->UserModel->select('jabatan')->find(session()->get('nis'))['jabatan'] == 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $buku = $this->BukuModel->select('status_buku, jumlah_dipinjam')->find($no_buku);
            // Jika buku tersebut tidak ada
            if ($buku == null) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            } else {
                // Jika buku tersebut sudah dipinjam oleh orang lain
                if ($buku['status_buku'] == 1) {
                    // Membuat sebuah flash data pesan berhasil
                    session()->setFlashdata('danger', 'Buku tersebut sedang dipinjam siswa lain.');
                    return redirect()->back();
                } else {
                    $data = [
                        'no_bukupinjam' => $no_buku,
                        'nis_bukupinjam' => session()->get('nis'),
                        'tanggal_pinjam' => $this->Waktu,
                    ];

                    $data2 = [
                        'no_buku' => $no_buku,
                        'status_buku' => 1,
                        'jumlah_dipinjam' => $buku['jumlah_dipinjam'] + 1,
                    ];

                    $this->BukupinjamModel->insert($data);
                    $this->BukuModel->save($data2);
                    // Membuat sebuah flash data pesan berhasil
                    session()->setFlashdata('success', 'Anda berhasil meminjam buku ini.');
                    return redirect()->back();
                }
            }
        }
    }

    // Method untuk fungsi mengembalikan buku
    public function kembalikanBuku($no_buku)
    {
        // Jika petugas mencoba mengembalikan buku
        if ($this->UserModel->select('jabatan')->find(session()->get('nis'))['jabatan'] == 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            // Jika buku tersebut tidak ada
            if ($this->BukuModel->select('no_buku')->find($no_buku) == null) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            } else {
                $bukupinjam = $this->BukupinjamModel->select('id_bukupinjam')->where(['nis_bukupinjam' => session()->get('nis'), 'no_bukupinjam' => $no_buku, 'status_bukupinjam' => 0])->first();
                // Jika peminjaman buku tersebut tidak pernah ada dan atau user lain yang meminjamnya
                if ($bukupinjam == null) {
                    // Membuat sebuah flash data pesan berhasil
                    session()->setFlashdata('danger', 'Anda tidak meminjam buku tersebut.');
                    return redirect()->back();
                } else {
                    $data = [
                        'id_bukupinjam' => $bukupinjam['id_bukupinjam'],
                        'status_bukupinjam' => 1,
                        'tanggal_kembali' => $this->Waktu,
                    ];

                    $data2 = [
                        'no_buku' => $no_buku,
                        'status_buku' => 0,
                        'buku-updated_at' => $this->Waktu,
                    ];

                    $this->BukupinjamModel->save($data);
                    $this->BukuModel->save($data2);
                    // Membuat sebuah flash data pesan berhasil
                    session()->setFlashdata('success', 'Anda berhasil mengembalikan buku tersebut.');
                    return redirect()->back();
                }
            }
        }
    }

    // Method untuk menyukai buku
    public function likeBuku($no_buku)
    {
        // Jika petugas mencoba menyukai buku
        if ($this->UserModel->select('jabatan')->find(session()->get('nis'))['jabatan'] == 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $buku = $this->BukuModel->select('love')->find($no_buku);
            // Jika buku tersebut tidak ada
            if ($buku == null) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            } else {
                // Jika sudah ada like
                if ($this->LikebukuModel->select('id_likebuku')->where(['nis_likebuku' => session()->get('nis'), 'no_likebuku' => $no_buku])->find() != null) {
                    // Menghapus data like
                    $this->LikebukuModel->select('id_likebuku')->where(['nis_likebuku' => session()->get('nis'), 'no_likebuku' => $no_buku])->delete();

                    $data2 = [
                        'no_buku' => $no_buku,
                        'love' => $buku['love'] = $buku['love'] - 1,
                    ];
                    $this->BukuModel->save($data2);
                } else {
                    $data = [
                        'nis_likebuku' => session()->get('nis'),
                        'no_likebuku' => $no_buku,
                        'likebuku-created_at' => $this->Waktu,
                    ];

                    $data2 = [
                        'no_buku' => $no_buku,
                        'love' => $buku['love'] = $buku['love'] + 1,
                        'buku-updated_at' => $this->Waktu,
                    ];

                    $this->LikebukuModel->insert($data);
                    $this->BukuModel->save($data2);
                }
                return redirect()->back();
            }
        }
    }
}
