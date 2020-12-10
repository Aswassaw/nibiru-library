<?php

namespace App\Controllers;

// Model yang diperlukan
use App\Models\UserModel;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\BukupinjamModel;

class UserController extends BaseController
{
    protected $UserModel;
    protected $BukuModel;
    protected $KategoriModel;
    protected $BukupinjamModel;
    protected $Waktu;

    public function __construct()
    {
        $this->UserModel = new UserModel;
        $this->BukuModel = new BukuModel;
        $this->KategoriModel = new KategoriModel;
        $this->BukupinjamModel = new BukupinjamModel;

        // l = nama hari, d-m-yy = hari, bulan, dan tahun, H:i:s = jam, menit, dan detik.
        $this->Waktu = date('l, d-m-yy, H:i:s');
        // helper form untuk fungsi set_value
        helper(['form']);
    }

    // Method untuk halaman profile
    public function index()
    {
        $data['title'] = 'Profile - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan, tanggal_lahir, deskripsi')->find(session()->get('nis'));
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('user/v_profile', $data);
    }

    // Method untuk menyimpan parubahan foto profile
    public function updateFotoUser()
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            $rules = [
                // Validasi untuk foto
                'foto' => [
                    'label' => 'Foto',
                    'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]',
                    'errors' => [
                        'is_image' => '{field} yang anda pilih bukanlah gambar',
                        'mime_in' => '{field} yang anda pilih bukanlah gambar',
                        'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                    ],
                ],
            ];
            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['title'] = 'Profile - Nibiru Library';
                $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan, tanggal_lahir, deskripsi')->find(session()->get('nis'));
                $data['validation'] = $this->validator;
                // Redirect ke halaman add user
                $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                return view('user/v_profile', $data);
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Nis
                $nis = session()->get('nis');
                // Membuat variabel $image yang menampung file foto yang dimasukkan oleh user
                $image = $this->request->getFile('foto');
                //Membuat nama random untuk foto
                $name = $image->getRandomName();
                // Mencari nama foto lama untuk dihapus nanti
                $foto_lama = $this->UserModel->select('foto_profil')->find($nis)['foto_profil'];
                // Cek apakah foto lama berupa gambar default, ini agar gambar default tidak ikut terhapus
                if ($foto_lama != 'default.png') {
                    // Menghapus foto yang lama
                    unlink('foto/fotoprofil/' . $foto_lama);
                }
                // Memindahkan file foto yang diupload user ke dalam folder foto/fotoprofil
                $image->move('foto/fotoprofil', $name);

                // Membuat variabel data untuk menampung data baru
                $data = [
                    'nis' => $nis,
                    'foto_profil' => $name,
                    'user-updated_at' => $this->Waktu,
                ];

                // Menyimpan data baru
                $this->UserModel->save($data);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Foto Profil berhasil diubah.');
                // Arahkan ke admin
                return redirect()->to(base_url('profile'));
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk halaman update data diri
    public function updateProfile()
    {
        $data['title'] = 'Update Profile - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan, tanggal_lahir, deskripsi')->find(session()->get('nis'));
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('user/v_updateprofile', $data);
    }

    // Method untuk menyimpan perubahan data diri
    public function saveUpdateProfile()
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            $rules = [
                // Validasi untuk form nama
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required|alpha_space|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'alpha_space' => '{field} hanya boleh mengandung huruf',
                        'max_length' => '{field} terlalu panjang (max 100)',
                    ]
                ],
                // Validasi untuk form tanggal_lahir
                'tanggal_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_date' => '{field} tersebut tidak valid',
                    ]
                ],
                // Validasi untuk form deskripsi
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'max_length[450]',
                    'errors' => [
                        'max_length' => '{field} terlalu panjang (max 450)',
                    ]
                ]
            ];
            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['title'] = 'Update Profile - Nibiru Library';
                $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan, tanggal_lahir, deskripsi')->find(session()->get('nis'));
                $data['validation'] = $this->validator;
                // Redirect ke halaman update profile
                $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                return view('user/v_updateprofile', $data);
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel data untuk menampung data baru
                $data = [
                    'nis' => session()->get('nis'),
                    'nama_user' => htmlspecialchars($this->request->getVar('nama')),
                    'tanggal_lahir' => htmlspecialchars($this->request->getVar('tanggal_lahir')),
                    'user-update_at' => $this->Waktu,
                ];

                // Jika ada deskripsi maka tambahkan
                if ($this->request->getVar('deskripsi')) {
                    $data['deskripsi'] = nl2br(htmlspecialchars($this->request->getVar('deskripsi')));
                }

                // Menyimpan data baru
                $this->UserModel->save($data);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Data berhasil diubah.');
                // Arahkan ke admin
                return redirect()->to(base_url('profile'));
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk halaman buku saya
    public function myBook()
    {
        // Jika admin berusaha mengakses halaman ini
        if ($this->UserModel->find(session()->get('nis'))['jabatan'] == 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            // Jika terdapat request dengan nama kategori
            if ($this->request->getVar('kategori')) {
                if ($this->request->getVar('kategori') == 'Tidak') {
                    session()->remove('kategori_mybook');
                } else {
                    session()->set(['kategori_mybook' => $this->request->getVar('kategori')]);
                }
                return redirect()->back();
            }
            // Jika ada pencarian
            if ($this->request->getVar('keyword')) {
                // Menampung keyword
                $keyword = $this->request->getVar('keyword');
                // Jika ada filter kategori
                if (session()->get('kategori_mybook')) {
                    $data['buku_pinjam'] = $this->BukupinjamModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, tanggal_pinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->where(['nis_bukupinjam' => session()->get('nis'), 'status_bukupinjam' => 0, 'nama_kategori' => session()->get('kategori_mybook')])->groupStart()->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->orderBy('tanggal_pinjam', 'DESC')->paginate(5, 'bukupinjam');
                } else {
                    $data['buku_pinjam'] = $this->BukupinjamModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, tanggal_pinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->where(['nis_bukupinjam' => session()->get('nis'), 'status_bukupinjam' => 0])->groupStart()->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->orderBy('tanggal_pinjam', 'DESC')->paginate(5, 'bukupinjam');
                }
            } else if (session()->get('kategori_mybook')) {
                $data['buku_pinjam'] = $this->BukupinjamModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, tanggal_pinjam')->where(['nis_bukupinjam' => session()->get('nis'), 'status_bukupinjam' => 0, 'nama_kategori' => session()->get('kategori_mybook')])->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->orderBy('tanggal_pinjam', 'DESC')->paginate(5, 'bukupinjam');
            } else {
                $data['buku_pinjam'] = $this->BukupinjamModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku, tanggal_pinjam')->where(['nis_bukupinjam' => session()->get('nis'), 'status_bukupinjam' => 0])->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->orderBy('tanggal_pinjam', 'DESC')->paginate(5, 'bukupinjam');
            }
            $data['title'] = 'My Book - Nibiru Library';
            $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
            $data['kategori'] = $this->KategoriModel->select('nama_kategori')->findAll();
            $data['pager'] = $this->BukupinjamModel->pager;
            $data['current_page'] = $this->request->getVar('page_bukupinjam') ? $this->request->getVar('page_bukupinjam') : 1;
            $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
            return view('user/v_mybook', $data);
        }
    }
}
