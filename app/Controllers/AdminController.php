<?php

namespace App\Controllers;

// Model yang digunakan
use App\Models\UserModel;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\BukupinjamModel;
use TCPDF;

class AdminController extends BaseController
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

        // Jika user bukanlah admin/petugas maka akan muncul 404 not found
        if ($this->UserModel->select('jabatan')->find(session()->get('nis'))['jabatan'] != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk halaman admin (admin)
    public function index()
    {
        $data['title'] = 'Admin - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['jumlah'] = [
            'siswa' => $this->UserModel->where('jabatan', 2)->countAllResults(),
            'buku' => $this->BukuModel->countAllResults(),
            'kategori' => $this->KategoriModel->countAllResults(),
            'peminjaman' => $this->BukupinjamModel->where('status_bukupinjam', 0)->countAllResults(),
            'pengembalian' => $this->BukupinjamModel->where('status_bukupinjam', 1)->countAllResults(),
        ];
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_admin', $data);
    }

    // Method untuk halaman user (admin)
    public function user()
    {
        // Jika ada pencarian
        if ($this->request->getVar('keyword')) {
            // Menampung keyword
            $keyword = $this->request->getVar('keyword');
            // Mengambil data berdasarkan keyword yang dimasukkan
            $data['all_siswa'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->where('jabatan', 2)->groupStart()->like(['nis' => $keyword,])->orLike('nama_user', $keyword)->groupEnd()->paginate(5, 'user');
            // Menghitung jumlah data yang ditemukan
            $data['jumlah_siswa'] = $this->UserModel->where('jabatan', 2)->groupStart()->like(['nis' => $keyword,])->orLike('nama_user', $keyword)->groupEnd()->countAllResults();
        } else {
            // Mengambil semua data user
            $data['all_siswa'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->where('jabatan', 2)->paginate(5, 'user');
            // Menghitung jumlah data yang ditemukan
            $data['jumlah_siswa'] = $this->UserModel->where('jabatan', 2)->countAllResults();
        }
        $data['title'] = 'User (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['pager'] = $this->UserModel->pager;
        $data['current_page'] = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_user', $data);
    }

    // Method untuk halaman penambahan data user (admin)
    public function addUser()
    {
        $data['title'] = 'Add User (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_adduser', $data);
    }

    // Method untuk menyimpan data user baru (admin)
    public function saveAddUser()
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            $rules = [
                // Validasi untuk form nis
                'nis' => [
                    'label' => 'Nomor Induk Siswa',
                    'rules' => 'required|numeric|exact_length[10]|is_unique[user.nis]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'numeric' => '{field} hanya boleh mengandung angka',
                        'exact_length' => '{field} harus 10 karakter',
                        'is_unique' => '{field} tersebut sudah digunakan',
                    ]
                ],
                // Validasi untuk form nama
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required|alpha_space|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'alpha_space' => '{field} hanya boleh mengandung huruf dan spasi',
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
                // Validasi untuk foto
                'foto' => [
                    'label' => 'Foto Siswa',
                    'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                        'is_image' => '{field} yang anda pilih bukanlah gambar',
                        'mime_in' => '{field} yang anda pilih bukanlah gambar',
                    ]
                ],
                // Validasi untuk form password
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|max_length[450]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek (min 8)',
                        'max_length' => '{field} terlalu panjang (max 450)',
                    ]
                ],
            ];
            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['title'] = 'Add User (Admin) - Nibiru Library';
                $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
                $data['validation'] = $this->validator;
                // Redirect ke halaman add user
                $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                return view('admin/v_adduser', $data);
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel $image yang menampung file foto yang dimasukkan oleh user
                $image = $this->request->getFile('foto');
                // Jika ada foto
                if ($image->getError() != 4) {
                    //Membuat nama random untuk foto
                    $name = $image->getRandomName();
                    // Memindahkan file foto yang diupload user ke dalam folder foto/fotoprofil
                    $image->move('foto/fotoprofil', $name);
                }

                // Membuat variabel data untuk menampung data baru
                $data = [
                    'nis' => htmlspecialchars($this->request->getVar('nis')),
                    'nama_user' => htmlspecialchars($this->request->getVar('nama')),
                    'tanggal_lahir' => htmlspecialchars($this->request->getVar('tanggal_lahir')),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'user-created_at' => $this->Waktu,
                    'user-updated_at' => $this->Waktu,
                ];

                // Jika ada foto maka tambahkan
                if ($image->getError() != 4) {
                    $data['foto_profil'] = $name;
                }

                // Menyimpan data baru
                $this->UserModel->insert($data);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Siswa berhasil ditambahkan.');
                // Arahkan ke admin
                return redirect()->to(base_url('user'));
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk halaman perubahan data user (admin)
    public function updateUser($nis)
    {
        // Mengambil data user yang akan diupdate
        $user_update = $this->UserModel->select('nis, nama_user, tanggal_lahir, foto_profil')->find($nis);
        // Jika user dengan nis tersebut tidak ada
        if ($user_update == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $data['title'] = 'Update User (Admin) - Nibiru Library';
            $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
            $data['user_update'] = $user_update;
            $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
            return view('admin/v_updateuser', $data);
        }
    }

    // Method untuk menyimpan perubahan data user (admin)
    public function saveUpdateUser($nis)
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Mengambil data user yang akan diupdate
            $user_update = $this->UserModel->select('nis, nama_user, tanggal_lahir, foto_profil')->find($nis);
            // Jika user dengan nis tersebut tidak ada
            if ($user_update == null) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            } else {
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
                ];
                // Jika foto ikut dirubah
                if ($this->request->getFile('foto')->getError() != 4) {
                    $rules['foto'] = [
                        // Validasi untuk foto
                        'label' => 'Foto Siswa',
                        'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                            'is_image' => '{field} yang anda pilih bukanlah gambar',
                            'mime_in' => '{field} yang anda pilih bukanlah gambar',
                        ],
                    ];
                }
                // Jika password ikut dirubah
                if ($this->request->getVar('password')) {
                    // Validasi untuk form password
                    $rules['password'] = [
                        'label' => 'Password',
                        'rules' => 'required|min_length[8]|max_length[450]',
                        'errors' => [
                            'required' => '{field} harus diisi',
                            'min_length' => '{field} terlalu pendek (min 8)',
                            'max_length' => '{field} terlalu panjang (max 450)',
                        ],
                    ];
                }
                // Jika terdapat kesalahan saat validasi
                if (!$this->validate($rules)) {
                    // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                    $data['title'] = 'Update User (Admin) - Nibiru Library';
                    $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
                    $data['user_update'] = $user_update;
                    $data['validation'] = $this->validator;
                    // Redirect ke halaman add user
                    $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                    return view('admin/v_updateuser', $data);
                }

                // Jika tidak terdapat kesalahan saat validasi
                else {
                    // Membuat variabel $image yang menampung file foto yang dimasukkan oleh user
                    $image = $this->request->getFile('foto');
                    // Jika ada foto
                    if ($image->getError() != 4) {
                        //Membuat nama random untuk foto
                        $name = $image->getRandomName();
                        // Mencari nama foto lama untuk dihapus nanti
                        $foto_lama = $this->UserModel->find($nis);
                        // Cek apakah foto lama berupa gambar default, ini agar gambar default tidak ikut terhapus
                        if ($foto_lama['foto_profil'] != 'default.png') {
                            // Menghapus foto yang lama
                            unlink('foto/fotoprofil/' . $foto_lama['foto_profil']);
                        }
                        // Memindahkan file foto yang diupload user ke dalam folder foto/fotoprofil
                        $image->move('foto/fotoprofil', $name);
                    }

                    // Membuat variabel data untuk menampung data baru
                    $data = [
                        'nis' => $nis,
                        'nama_user' => htmlspecialchars($this->request->getVar('nama')),
                        'tanggal_lahir' => htmlspecialchars($this->request->getVar('tanggal_lahir')),
                        'user-updated_at' => $this->Waktu,
                    ];

                    // Jika ada foto maka tambahkan
                    if ($image->getError() != 4) {
                        $data['foto_profil'] = $name;
                    }

                    // Jika password ikut diubah
                    if ($this->request->getVar('password')) {
                        $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                    }

                    // Menyimpan data baru
                    $this->UserModel->save($data);
                    // Membuat sebuah flash data pesan berhasil
                    session()->setFlashdata('success', 'Siswa berhasil diubah.');
                    // Arahkan ke admin
                    return redirect()->to(base_url('user'));
                }
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk menghapus data user (admin)
    public function deleteUser($nis)
    {
        // Mengambil user
        $user = $this->UserModel->find($nis);
        // Jika user dengan nis tersebut tidak ada
        if ($user == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            // Jika user tersebut masih meminjam buku dan belum mengembalikannya
            if ($this->BukupinjamModel->select('id_bukupinjam')->where(['nis_bukupinjam' => $user['nis'], 'status_bukupinjam' => 0])->first() != null) {
                // Membuat sebuah flash data pesan gagal
                session()->setFlashdata('danger', 'Siswa tersebut gagal dihapus karena masih memiliki pinjaman buku.');
                return redirect()->back();
            } else {
                // Cek apakah profil berupa gambar default, jika bukan maka profil akan terhapus
                if ($user['foto_profil'] != 'default.png') {
                    // Menghapus foto yang lama
                    unlink('foto/fotoprofil/' . $user['foto_profil']);
                }
                $this->UserModel->delete($nis);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Siswa berhasil dihapus.');
                return redirect()->back();
            }
        }
    }

    // Method untuk halaman book (admin)
    public function book()
    {
        // Jika terdapat request dengan nama kategori
        if ($this->request->getVar('kategori')) {
            if ($this->request->getVar('kategori') == 'Tidak') {
                session()->remove('kategori_book');
            } else {
                session()->set(['kategori_book' => $this->request->getVar('kategori')]);
            }
            return redirect()->back();
        }
        // Jika ada pencarian
        if ($this->request->getVar('keyword')) {
            // Menampung keyword
            $keyword = $this->request->getVar('keyword');
            // Jika ada filter kategori
            if (session()->get('kategori_book')) {
                // Mengambil semua data buku + join kategori
                $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->groupStart()->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->where('nama_kategori', session()->get('kategori_book'))->paginate(5, 'buku');
                // Menghitung jumlah
                $data['jumlah_buku'] = $this->BukuModel->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->groupStart()->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->where('nama_kategori', session()->get('kategori_book'))->countAllResults();
            } else {
                // Mengambil semua data buku + join kategori
                $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->paginate(5, 'buku');
                // Menghitung jumlah
                $data['jumlah_buku'] = $this->BukuModel->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->like('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->countAllResults();
            }
        } else if (session()->get('kategori_book')) {
            // Mengambil semua data buku + join kategori
            $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku')->where('nama_kategori', session()->get('kategori_book'))->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->paginate(5, 'buku');
            // Menghitung semua data buku yang ditemukan
            $data['jumlah_buku'] = $this->BukuModel->where('nama_kategori', session()->get('kategori_book'))->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->countAllResults();
        } else {
            // Mengambil semua data buku + join kategori
            $data['all_buku'] = $this->BukuModel->select('no_buku, nama_buku, sampul_buku, nama_kategori, status_buku')->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->paginate(5, 'buku');
            // Menghitung semua data buku yang ditemukan
            $data['jumlah_buku'] = $this->BukuModel->countAllResults();
        }
        $data['title'] = 'Buku (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['kategori'] = $this->KategoriModel->select('nama_kategori')->findAll();
        $data['pager'] = $this->BukuModel->pager;
        $data['current_page'] = $this->request->getVar('page_buku') ? $this->request->getVar('page_buku') : 1;
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_book', $data);
    }

    // Method untuk halaman penambahand data buku baru (admin)
    public function addBuku()
    {
        $data['title'] = 'Add Buku (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['kategori'] = $this->KategoriModel->select('nama_kategori')->findAll();
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_addbuku', $data);
    }

    // Method untuk menyimpan data buku baru (admin)
    public function saveAddBuku()
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            $rules = [
                // Validasi untuk form no_buku
                'no_buku' => [
                    'label' => 'No Buku',
                    'rules' => 'required|numeric|exact_length[10]|is_unique[buku.no_buku]|max_length[18]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'numeric' => '{field} hanya boleh mengandung angka',
                        'exact_length' => '{field} harus 10 karakter',
                        'is_unique' => '{field} tersebut sudah digunakan',
                        'max_length' => '{field} terlalu panjang (max 18)',
                    ]
                ],
                // Validasi untuk form nama
                'nama' => [
                    'label' => 'Nama Buku',
                    'rules' => 'required|max_length[150]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang (max 150)',
                    ]
                ],
                // Validasi untuk form pengarang
                'pengarang' => [
                    'label' => 'Pengarang',
                    'rules' => 'required|alpha_space|max_length[150]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'alpha_space' => '{field} hanya boleh mengandung huruf dan spasi',
                        'max_length' => '{field} terlalu panjang (max 150)',
                    ]
                ],
                // Validasi untuk form penerbit
                'penerbit' => [
                    'label' => 'Penerbit',
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang (max 100)',
                    ]
                ],
                // Validasi untuk sampul
                'sampul' => [
                    'label' => 'Sampul Buku',
                    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                        'is_image' => '{field} yang anda pilih bukanlah gambar',
                        'mime_in' => '{field} yang anda pilih bukanlah gambar'
                    ]
                ],
                // Validasi untuk form kategori
                'kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                // Validasi untuk form deskripsi
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'max_length[450]',
                    'errors' => [
                        'max_length' => '{field} terlalu panjang (max 450)',
                    ]
                ],
            ];
            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['title'] = 'Add Buku (Admin) - Nibiru Library';
                $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
                $data['kategori'] = $this->KategoriModel->select('nama_kategori')->findAll();
                $data['validation'] = $this->validator;
                // Redirect ke halaman add buku
                $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                return view('admin/v_addbuku', $data);
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel $image yang menampung file sampul yang dimasukkan oleh user
                $image = $this->request->getFile('sampul');
                // Jika ada sampul
                if ($image->getError() != 4) {
                    //Membuat nama random untuk sampul
                    $name = $image->getRandomName();
                    // Memindahkan file foto yang diupload user ke dalam folder foto/sampulbuku
                    $image->move('foto/sampulbuku', $name);
                }
                // Menentukan id kategori
                $kategori = $this->KategoriModel->select('id_kategori')->where('nama_kategori', $this->request->getVar('kategori'))->first();

                // Membuat variabel data untuk menampung data baru
                $data = [
                    'no_buku' => htmlspecialchars($this->request->getVar('no_buku')),
                    'nama_buku' => htmlspecialchars($this->request->getVar('nama')),
                    'pengarang_buku' => htmlspecialchars($this->request->getVar('pengarang')),
                    'penerbit_buku' => htmlspecialchars($this->request->getVar('penerbit')),
                    'kategori_buku' => $kategori,
                    'buku-created_at' => $this->Waktu,
                    'buku-updated_at' => $this->Waktu,
                ];

                // Jika ada sampul maka tambahkan
                if ($image->getError() != 4) {
                    $data['sampul_buku'] = $name;
                }

                // Jika ada deskripsi maka tambahkan
                if ($this->request->getVar('deskripsi')) {
                    $data['deskripsi_buku'] = nl2br(htmlspecialchars($this->request->getVar('deskripsi')));
                }

                // Menyimpan data baru
                $this->BukuModel->insert($data);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Buku berhasil ditambahkan.');
                // Arahkan ke book
                return redirect()->to(base_url('book'));
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk halaman perubahan data buku (admin)
    public function updateBuku($no_buku)
    {
        // Jika buku dengan no_buku tersebut tidak ada
        if ($this->BukuModel->select('no_buku')->find($no_buku) == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $data['title'] = 'Update Buku (Admin) - Nibiru Library';
            $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
            $data['buku_update'] = $this->BukuModel->select('no_buku, nama_buku, pengarang_buku, penerbit_buku, sampul_buku, nama_kategori, deskripsi_buku')->where('no_buku', $no_buku)->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->first();
            $data['kategori'] = $this->KategoriModel->select('nama_kategori')->findAll();
            $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
            return view('admin/v_updatebuku', $data);
        }
    }

    // Method untuk menyimpan perubahan data buku (admin)
    public function saveUpdateBuku($no_buku)
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Jika buku dengan no_buku tersebut tidak ada
            if ($this->BukuModel->select('no_buku')->find($no_buku) == null) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            } else {
                $rules = [
                    // Validasi untuk form nama
                    'nama' => [
                        'label' => 'Nama Buku',
                        'rules' => 'required|max_length[150]',
                        'errors' => [
                            'required' => '{field} harus diisi',
                            'max_length' => '{field} terlalu panjang (max 150)',
                        ]
                    ],
                    // Validasi untuk form pengarang
                    'pengarang' => [
                        'label' => 'Pengarang',
                        'rules' => 'required|alpha_space|max_length[150]',
                        'errors' => [
                            'required' => '{field} harus diisi',
                            'alpha_space' => '{field} hanya boleh mengandung huruf dan spasi',
                            'max_length' => '{field} terlalu panjang (max 150)',
                        ]
                    ],
                    // Validasi untuk form penerbit
                    'penerbit' => [
                        'label' => 'Penerbit',
                        'rules' => 'required|max_length[100]',
                        'errors' => [
                            'required' => '{field} harus diisi',
                            'max_length' => '{field} terlalu panjang (max 100)',
                        ]
                    ],
                    // Validasi untuk form kategori
                    'kategori' => [
                        'label' => 'Kategori',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} harus diisi',
                        ]
                    ],
                    // Validasi untuk form deskripsi
                    'deskripsi' => [
                        'label' => 'Deskripsi',
                        'rules' => 'max_length[450]',
                        'errors' => [
                            'max_length' => '{field} terlalu panjang (max 450)',
                        ]
                    ],
                ];
                // Jika sampul ikut diganti
                if ($this->request->getFile('sampul')->getError() != 4) {
                    // Validasi untuk sampul
                    $rules['sampul'] = [
                        'label' => 'Sampul Buku',
                        'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                            'is_image' => '{field} yang anda pilih bukanlah gambar',
                            'mime_in' => '{field} yang anda pilih bukanlah gambar'
                        ]
                    ];
                }
                // Jika terdapat kesalahan saat validasi
                if (!$this->validate($rules)) {
                    // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                    $data['title'] = 'Update Buku (Admin) - Nibiru Library';
                    $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
                    $data['buku_update'] = $this->BukuModel->select('no_buku, nama_buku, pengarang_buku, penerbit_buku, sampul_buku, nama_kategori, deskripsi_buku')->where('no_buku', $no_buku)->join('kategori', 'kategori.id_kategori = buku.kategori_buku')->first();
                    $data['kategori'] = $this->KategoriModel->select('nama_kategori')->findAll();
                    $data['validation'] = $this->validator;
                    // Redirect ke halaman add buku
                    $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                    return view('admin/v_updatebuku', $data);
                }

                // Jika tidak terdapat kesalahan saat validasi
                else {
                    // Membuat variabel $image yang menampung file sampul yang dimasukkan oleh user
                    $image = $this->request->getFile('sampul');
                    // Jika ada sampul
                    if ($image->getError() != 4) {
                        //Membuat nama random untuk sampul
                        $name = $image->getRandomName();
                        // Memindahkan file foto yang diupload user ke dalam folder foto/sampulbuku
                        $image->move('foto/sampulbuku', $name);
                    }
                    // Menentukan id kategori
                    $kategori = $this->KategoriModel->select('id_kategori')->where('nama_kategori', $this->request->getVar('kategori'))->first();

                    // Membuat variabel data untuk menampung data baru
                    $data = [
                        'no_buku' => $no_buku,
                        'nama_buku' => htmlspecialchars($this->request->getVar('nama')),
                        'pengarang_buku' => htmlspecialchars($this->request->getVar('pengarang')),
                        'penerbit_buku' => htmlspecialchars($this->request->getVar('penerbit')),
                        'kategori_buku' => $kategori,
                        'buku-updated_at' => $this->Waktu,
                    ];

                    // Jika ada sampul maka tambahkan
                    if ($image->getError() != 4) {
                        $data['sampul_buku'] = $name;
                    }

                    // Jika ada deskripsi maka tambahkan
                    if ($this->request->getVar('deskripsi')) {
                        $data['deskripsi_buku'] = nl2br(htmlspecialchars($this->request->getVar('deskripsi')));
                    }

                    // Menyimpan data baru
                    $this->BukuModel->save($data);
                    // Membuat sebuah flash data pesan berhasil
                    session()->setFlashdata('success', 'Buku berhasil diubah.');
                    // Arahkan ke book
                    return redirect()->to(base_url('book'));
                }
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk menghapus data buku (admin)
    public function deleteBuku($no_buku)
    {
        // Mengambil buku
        $buku = $this->BukuModel->find($no_buku);
        // Jika buku dengan no_buku tersebut tidak ada
        if ($buku == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            // Jika buku tersebut masih dipinjam oleh user dan belum dikembalikan
            if ($this->BukuModel->where(['no_buku' => $no_buku, 'status_buku' => 1])->find() != null) {
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('danger', 'Buku tersebut gagal dihapus karena masih ada Siswa yang meminjamnya.');
                return redirect()->back();
            } else {
                // Cek apakah sampul berupa gambar default, jika bukan maka sampul akan terhapus
                if ($buku['sampul_buku'] != 'default.png') {
                    // Menghapus sampul yang lama
                    unlink('foto/sampulbuku/' . $buku['sampul_buku']);
                }
                $this->BukuModel->delete($no_buku);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Buku berhasil dihapus.');
                return redirect()->back();
            }
        }
    }

    // Method untuk halaman kategori (admin)
    public function kategori()
    {
        // Jika ada pencarian
        if ($this->request->getVar('keyword')) {
            $keyword = $this->request->getVar('keyword');
            $data['all_kategori'] = $this->KategoriModel->select('id_kategori, nama_kategori, kategori-created_at')->like('nama_kategori', $keyword)->paginate(5, 'kategori');
            $data['jumlah_kategori'] = $this->KategoriModel->select('id_kategori')->like('nama_kategori', $keyword)->countAllResults();
        } else {
            $data['all_kategori'] = $this->KategoriModel->select('id_kategori, nama_kategori, kategori-created_at')->paginate(5, 'kategori');
            $data['jumlah_kategori'] = $this->KategoriModel->select('id_kategori')->countAllResults();
        }
        $data['title'] = 'Kategori (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['pager'] = $this->KategoriModel->pager;
        $data['current_page'] = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_kategori', $data);
    }

    // Method untuk halaman penambahan data kategori baru (admin)
    public function addKategori()
    {
        $data['title'] = 'Add Kategori (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_addkategori', $data);
    }

    // Method untuk menyimpan data kategori baru (admin)
    public function saveAddKategori()
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            $rules = [
                // Validasi untuk form nama
                'nama' => [
                    'label' => 'Nama Kategori',
                    'rules' => 'required|is_unique[kategori.nama_kategori]|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} tersebut sudah ada',
                        'max_length' => '{field} terlalu panjang (max 100)',
                    ]
                ],
            ];
            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['title'] = 'Add Kategori (Admin) - Nibiru Library';
                $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
                $data['validation'] = $this->validator;
                // Redirect ke halaman add buku
                $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                return view('admin/v_addkategori', $data);
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel data untuk menampung data baru
                $data = [
                    'nama_kategori' => htmlspecialchars($this->request->getVar('nama')),
                    'kategori-created_at' => $this->Waktu,
                    'kategori-updated_at' => $this->Waktu,
                ];

                // Menyimpan data baru
                $this->KategoriModel->save($data);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Kategori berhasil ditambahkan.');
                // Arahkan ke kategori
                return redirect()->to(base_url('kategori'));
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk halaman perubahan data kategori (admin)
    public function updateKategori($id_kategori)
    {
        // Mengambil kategori
        $kategori = $this->KategoriModel->select('id_kategori, nama_kategori')->find($id_kategori);
        // Jika buku dengan id_kategori tersebut tidak ada
        if ($kategori == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $data['title'] = 'Update Kategori (Admin) - Nibiru Library';
            $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
            $data['kategori_update'] = $kategori;
            $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
            return view('admin/v_updatekategori', $data);
        }
    }

    // Method untuk menyimpan perubahan data kategori (admin)
    public function saveUpdateKategori($id_kategori)
    {
        // Mengambil kategori
        $kategori = $this->KategoriModel->select('id_kategori, nama_kategori')->find($id_kategori);
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Jika buku dengan id_kategori tersebut tidak ada
            if ($kategori == null) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            } else {
                // Jika nama kategori tidak diganti
                $rules = [
                    'nama' => [
                        'label' => 'Nama Kategori',
                        'rules' => 'required|max_length[100]',
                        'errors' => [
                            'required' => '{field} harus diisi',
                            'max_length' => '{field} terlalu panjang (max 100)',
                        ]
                    ]
                ];
                // Jika nama kategori diganti
                if ($this->request->getVar('nama') != $this->request->getVar('nama_awal')) {
                    $rules = [
                        'nama' => [
                            'label' => 'Nama Kategori',
                            'rules' => 'required|is_unique[kategori.nama_kategori]|max_length[100]',
                            'errors' => [
                                'required' => '{field} harus diisi',
                                'is_unique' => '{field} tersebut sudah ada',
                                'max_length' => '{field} terlalu panjang (max 100)',
                            ]
                        ],
                    ];
                }
                // Jika terdapat kesalahan saat validasi
                if (!$this->validate($rules)) {
                    // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                    $data['title'] = 'Update Kategori (Admin) - Nibiru Library';
                    $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
                    $data['kategori_update'] = $kategori;
                    $data['validation'] = $this->validator;
                    // Redirect ke halaman update kategori
                    $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
                    return view('admin/v_updatekategori', $data);
                }

                // Jika tidak terdapat kesalahan saat validasi
                else {
                    // Membuat variabel data untuk menampung data baru
                    $data = [
                        'id_kategori' => $id_kategori,
                        'nama_kategori' => htmlspecialchars($this->request->getVar('nama')),
                        'kategori-updated_at' => $this->Waktu,
                    ];

                    // Menyimpan data baru
                    $this->KategoriModel->save($data);
                    // Membuat sebuah flash data pesan berhasil
                    session()->setFlashdata('success', 'Kategori berhasil diubah.');
                    // Arahkan ke kategori
                    return redirect()->to(base_url('kategori'));
                }
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    // Method untuk menghapus data kategori (admin)
    public function deleteKategori($id_kategori)
    {
        // Jika buku dengan id_kategori tersebut tidak ada
        if ($this->KategoriModel->select('id_kategori')->find($id_kategori) == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            // Mengecek apakah ada buku yang berelasi dengan kategori ini
            $free = $this->BukuModel->select('no_buku')->where('kategori_buku', $id_kategori)->first();
            // Jika ada yang berelasi
            if ($free != null) {
                // Membuat sebuah flash data pesan gagal
                session()->setFlashdata('danger', 'Kategori tersebut gagal dihapus karena masih ada buku yang menggunakannya.');
                return redirect()->back();
            } else {
                $this->KategoriModel->delete($id_kategori);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Kategori berhasil dihapus.');
                return redirect()->back();
            }
        }
    }

    // Method untuk halaman peminjaman (admin)
    public function peminjaman()
    {
        // Jika ada pencarian
        if ($this->request->getVar('keyword')) {
            // Mengambil keyword
            $keyword = $this->request->getVar('keyword');
            // Mencari buku
            $data['peminjaman'] = $this->BukupinjamModel->select('nama_user, foto_profil, nama_buku, sampul_buku, tanggal_pinjam, id_bukupinjam')->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->where('status_bukupinjam', 0)->groupStart()->like('nis', $keyword)->orLike('nama_user', $keyword)->orLike('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->orderBy('tanggal_pinjam', 'DESC')->paginate(5, 'bukupinjam');
            // Menghitung buku yang ditemukan
            $data['jumlah_peminjaman'] = $this->BukupinjamModel->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->where('status_bukupinjam', 0)->groupStart()->like('nis', $keyword)->orLike('nama_user', $keyword)->orLike('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->countAllResults();
        } else {
            $data['peminjaman'] = $this->BukupinjamModel->select('nama_user, foto_profil, nama_buku, sampul_buku, tanggal_pinjam, id_bukupinjam')->where('status_bukupinjam', 0)->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->orderBy('tanggal_pinjam', 'DESC')->paginate(5, 'bukupinjam');
            $data['jumlah_peminjaman'] = $this->BukupinjamModel->where('status_bukupinjam', 0)->countAllResults();
        }
        $data['title'] = 'Peminjaman (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['pager'] = $this->BukupinjamModel->pager;
        $data['current_page'] = $this->request->getVar('page_bukupinjam') ? $this->request->getVar('page_bukupinjam') : 1;
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_peminjaman', $data);
    }

    // Method untuk halaman pengembalian (admin)
    public function pengembalian()
    {
        // Jika ada pencarian
        if ($this->request->getVar('keyword')) {
            // Mengambil keyword
            $keyword = $this->request->getVar('keyword');
            // Mencari buku
            $data['pengembalian'] = $this->BukupinjamModel->select('nama_user, foto_profil, nama_buku, sampul_buku, tanggal_kembali, id_bukupinjam')->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->where('status_bukupinjam', 1)->groupStart()->like('nis', $keyword)->orLike('nama_user', $keyword)->orLike('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->orderBy('tanggal_kembali', 'DESC')->paginate(5, 'bukupinjam');
            // Menghitung buku yang ditemukan
            $data['jumlah_pengembalian'] = $this->BukupinjamModel->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->where('status_bukupinjam', 1)->groupStart()->like('nis', $keyword)->orLike('nama_user', $keyword)->orLike('no_buku', $keyword)->orLike('nama_buku', $keyword)->orLike('pengarang_buku', $keyword)->orLike('penerbit_buku', $keyword)->groupEnd()->countAllResults();
        } else {
            $data['pengembalian'] = $this->BukupinjamModel->select('nama_user, foto_profil, nama_buku, sampul_buku, tanggal_kembali, id_bukupinjam')->where('status_bukupinjam', 1)->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->orderBy('tanggal_kembali', 'DESC')->paginate(5, 'bukupinjam');
            $data['jumlah_pengembalian'] = $this->BukupinjamModel->where('status_bukupinjam', 1)->countAllResults();
        }
        $data['title'] = 'Pengembalian (Admin) - Nibiru Library';
        $data['user'] = $this->UserModel->select('nis, nama_user, foto_profil, jabatan')->find(session()->get('nis'));
        $data['pager'] = $this->BukupinjamModel->pager;
        $data['current_page'] = $this->request->getVar('page_bukupinjam') ? $this->request->getVar('page_bukupinjam') : 1;
        $data['kategori_footer'] = $this->KategoriModel->select('nama_kategori')->findAll(5);
        return view('admin/v_pengembalian', $data);
    }

    // Method untuk mencetak laporan peminjaman (admin)
    public function cetakLaporanPeminjaman($id_bukupinjam)
    {
        // Jika peminjaman tersebut tidak ada
        if ($this->BukupinjamModel->where(['id_bukupinjam' => $id_bukupinjam, 'status_bukupinjam' => 0])->find() == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $data['bukupinjam'] = $this->BukupinjamModel->where('id_bukupinjam', $id_bukupinjam)->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->find()[0];

            $html = view('print/v_print_peminjaman.php', $data);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Andry Pebrianto');
            $pdf->SetTitle('Cetak Laporan Peminjaman');
            $pdf->SetSubject('Cetak Laporan Peminjaman');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->AddPage();

            $pdf->writeHTML($html, true, false, true, false, '');
            $this->response->setContentType('application/pdf');
            $pdf->Output('laporan-peminjaman.pdf', 'I');
        }
    }

    // Method untuk mencetak laporan pengembalian (admin)
    public function cetakLaporanPengembalian($id_bukupinjam)
    {
        // Jika pengembalian tersebut tidak ada
        if ($this->BukupinjamModel->where(['id_bukupinjam' => $id_bukupinjam, 'status_bukupinjam' => 1])->find() == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            $data['bukupinjam'] = $this->BukupinjamModel->where('id_bukupinjam', $id_bukupinjam)->join('user', 'user.nis = bukupinjam.nis_bukupinjam')->join('buku', 'buku.no_buku = bukupinjam.no_bukupinjam')->find()[0];

            $html = view('print/v_print_pengembalian.php', $data);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Andry Pebrianto');
            $pdf->SetTitle('Cetak Laporan Pengembalian');
            $pdf->SetSubject('Cetak Laporan Pengembalian');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->AddPage();

            $pdf->writeHTML($html, true, false, true, false, '');
            $this->response->setContentType('application/pdf');
            $pdf->Output('laporan-pengembalian.pdf', 'I');
        }
    }
}
