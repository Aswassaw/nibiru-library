-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 10 Des 2020 pada 09.59
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nibiru_library`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `no_buku` varchar(20) NOT NULL,
  `nama_buku` varchar(200) NOT NULL,
  `pengarang_buku` varchar(200) NOT NULL,
  `penerbit_buku` varchar(100) NOT NULL,
  `sampul_buku` varchar(500) NOT NULL DEFAULT 'default.png',
  `kategori_buku` int(11) NOT NULL,
  `deskripsi_buku` varchar(500) NOT NULL DEFAULT '''Tidak ada deskripsi''',
  `status_buku` int(1) NOT NULL DEFAULT 0,
  `jumlah_dipinjam` int(11) NOT NULL,
  `love` int(11) NOT NULL,
  `buku-created_at` varchar(50) DEFAULT NULL,
  `buku-updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`no_buku`, `nama_buku`, `pengarang_buku`, `penerbit_buku`, `sampul_buku`, `kategori_buku`, `deskripsi_buku`, `status_buku`, `jumlah_dipinjam`, `love`, `buku-created_at`, `buku-updated_at`) VALUES
('1000000001', 'Bahasa Indonesia Kelas XII', 'Maman Suryaman', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', '1607094403_0288a63b019a875acbec.jpg', 1, 'Buku ini dipersiapkan untuk mendukung kebijakan Kurikulum 2013 yang tidak sekadar secara konstitusional mempertahankan bahasa Indonesia dalam daftar mata pelajaran di sekolah. Namun, Kurikulum terbaru ini mempertegaskan pentingnya keberadaan bahasa Indonesia sebagai penghela dan pembawa ilmu pengetahuan.', 0, 0, 2, 'Monday, 07-12-2020, 11:21:41', 'Wednesday, 09-12-2020, 22:36:12'),
('1000000002', 'Bahasa Inggris Kelas XII', 'Emi Emilia', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', '1607094792_248987c3e5c38fb72ded.jpg', 1, 'Buku ini dipersiapkan untuk membangun sikap, pengetahuan, dan keterampilan berkomunikasi siswa melalui pengalaman belajar yang berbentuk beragam kegiatan berkomunikasi aktif. Isi dan pengalaman yang telah dikembangkan dalam buku ini telah diupayakan agar dapat membantu siswa mencapaiempat kompetensi inti (KI) yang diamanahkan oleh Kurikulum 2013.', 0, 0, 2, 'Monday, 07-12-2020, 11:22:41', 'Wednesday, 09-12-2020, 22:40:23'),
('1000000003', 'Pemrograman Dasar Kelas X', 'Andi Novianto', 'Erlangga', '1607229240_b896cdf73bdfe31cc8fa.jpg', 1, 'Buku ini diperuntukkan untuk pemebelajaran mengenai Pemrograman Dasar. Siswa akan mendapatkan teori dan implementasi penggunaan dan kegunaan dari Pemrograman. Diharapkan kedepannya siswa dapat memantapkan keahliannya untuk menuju jenjang yang lebih tinggi lagi.', 1, 5, 4, 'Monday, 07-12-2020, 11:23:41', 'Wednesday, 09-12-2020, 22:51:12'),
('2000000001', 'Another Volume 1', 'Yukito Ayatsuji', 'Kadokawa Shoten', '1607187577_fffc57fd5dd888acd89b.jpeg', 2, 'Another dimulai dengan menceritakan seorang siswi berprestasi pada tahun 1972 di SMP Yomiyama Utara. Siswi yang sangat populer di kalangan guru-guru bahkan murid lainnya. Murid itu bernama Misaki dari kelas 3-3, tetapi ia meninggal secara tiba-tiba ketika pelajaran di sekolah tengah berlangsung. Hal itulah yang disayangkan oleh para murid dan guru di sana.', 0, 3, 9, 'Monday, 07-12-2020, 11:24:41', 'Wednesday, 09-12-2020, 23:04:31'),
('2000000002', 'Another Volume 2', 'Yukito Ayatsuji', 'Kadokawa Shoten', '1607187711_9a8684dff0e2ca9d064e.jpeg', 2, 'Another dimulai dengan menceritakan seorang siswi berprestasi pada tahun 1972 di SMP Yomiyama Utara. Siswi yang sangat populer di kalangan guru-guru bahkan murid lainnya. Murid itu bernama Misaki dari kelas 3-3, tetapi ia meninggal secara tiba-tiba ketika pelajaran di sekolah tengah berlangsung. Hal itulah yang disayangkan oleh para murid dan guru di sana.', 0, 1, 4, 'Monday, 07-12-2020, 11:25:41', 'Wednesday, 09-12-2020, 22:46:13'),
('2000000003', 'Yahari Ore no Seishun Love Comedy wa Machigatteiru Volume 12', 'Naomichi Io', 'Shogakukan', '1607188389_4916e255b41337220b93.jpg', 2, 'Bercerita tentang hachiman, sosok yang lebih memilih sendiri dari pada berbaur dengan lainnya. Suatu hari ketika disuruh menulis pandangan nya terhadap masa SMA dia dianggap aneh oleh guru nya.<br />\r\n<br />\r\nKemudian dia disuruh masuk ke klub relawan, sebuah klub yang siap membantu siapa saja murid yang memiliki masalah. disana dia bertemu dengan Yukinon, seorang siswi yang pintar, cantik namun memiliki sifat yang dingin.', 0, 0, 3, 'Monday, 07-12-2020, 11:26:41', 'Wednesday, 09-12-2020, 22:54:50'),
('2000000004', 'Yahari Ore no Seishun Love Comedy wa Machigatteiru Volume 11', 'Naomichi Io', 'Shogakukan', '1607189113_332ef0c63756d4bf9bcb.jpg', 2, 'Bercerita tentang hachiman, sosok yang lebih memilih sendiri dari pada berbaur dengan lainnya. Suatu hari ketika disuruh menulis pandangan nya terhadap masa SMA dia dianggap aneh oleh guru nya.<br />\r\n<br />\r\nKemudian dia disuruh masuk ke klub relawan, sebuah klub yang siap membantu siapa saja murid yang memiliki masalah. disana dia bertemu dengan Yukinon, seorang siswi yang pintar, cantik namun memiliki sifat yang dingin.', 0, 0, 2, 'Monday, 07-12-2020, 11:27:41', 'Wednesday, 09-12-2020, 22:44:59'),
('2000000005', 'Yahari Ore no Seishun Love Comedy wa Machigatteiru Volume 6', 'Naomichi Io', 'Shogakukan', '1607188605_d01025c627ffff2f9292.jpg', 2, 'Bercerita tentang hachiman, sosok yang lebih memilih sendiri dari pada berbaur dengan lainnya. Suatu hari ketika disuruh menulis pandangan nya terhadap masa SMA dia dianggap aneh oleh guru nya.<br />\r\n<br />\r\nKemudian dia disuruh masuk ke klub relawan, sebuah klub yang siap membantu siapa saja murid yang memiliki masalah. disana dia bertemu dengan Yukinon, seorang siswi yang pintar, cantik namun memiliki sifat yang dingin.', 0, 0, 3, 'Monday, 07-12-2020, 11:28:41', 'Wednesday, 09-12-2020, 22:53:03'),
('2000000006', 'Sebuah Seni Untuk Bersikap Bodo Amat', 'Mark Manson', 'HarperOne', '1607188928_ca3afd3d386882e33e35.jpg', 2, 'Novel yang berjudul Sebuah Seni Untuk Bersikap Bodo Amat bercerita tentang seseorang yang bernama Charles Bukowski yang mempunyai masa lalu yang kelam, suka mabuk-mabukan, berjudi, mempermainkan wanita, kasar, tukang utang dan seorang penyair. Dia bercita-cita menjadi seorang penulis terkenal namun karya-karyanya selalu ditolak oleh hampir disetiap majalah, jurnal-jurnal, surat kabar dan penerbit lainnya.', 1, 2, 7, 'Monday, 07-12-2020, 11:29:41', 'Wednesday, 09-12-2020, 22:51:26'),
('2000000007', 'Segala-Galanya Ambyar', 'Mark Manson', 'HarperOne', '1607189655_90b438667cbc40e2239b.jpg', 2, 'Novel yang berjudul Sebuah Seni Untuk Bersikap Bodo Amat bercerita tentang seseorang yang bernama Charles Bukowski yang mempunyai masa lalu yang kelam, suka mabuk-mabukan, berjudi, mempermainkan wanita, kasar, tukang utang dan seorang penyair. Dia bercita-cita menjadi seorang penulis terkenal namun karya-karyanya selalu ditolak oleh hampir disetiap majalah, jurnal-jurnal, surat kabar dan penerbit lainnya.', 0, 0, 1, 'Monday, 07-12-2020, 11:30:41', 'Wednesday, 09-12-2020, 22:42:09'),
('3000000001', 'Black Clover Volume 20', 'Yuki Tabata', 'Shueisha', '1607187902_4e9a894fe9e7be895541.png', 3, 'Asta dan Yuno sejak kecil telah ditinggalkan oleh orang tua mereka di sebuah gereja pada saat yang sama, sejak saat itu hingga kini mereka telah di besarkan oleh pemilik gereja. Mereka berdua selalu saja bersaing untuk menentukan siapa yang lebih hebat. Walaupun begitu, kini mulai terlihat jauh kemampuan diantara keduanya.', 0, 0, 2, 'Monday, 07-12-2020, 11:31:41', 'Wednesday, 09-12-2020, 22:55:07'),
('3000000002', 'Naruto Shippuden Volume 72', 'Masashi Kishimoto', 'Shonen Jump', '1607188805_45e71bf8c5d17792a089.jpg', 3, 'Komik ini menceritakan kisah lanjutan dari Naruto. Naruto kini telah beranjak dewasa begitu juga dengan teman – temannya. Naruto yang baru pulang dari latihannya bersama jiraiya pergi ketempat Tsunade dan bertemu dengan Sakura. Tsunade menyuruh mereka berdua untuk bertarung bersama Kakashi untuk mengukur seberapa jauh mereka berlatih dengan guru masing – masing.', 1, 1, 1, 'Monday, 07-12-2020, 11:32:41', 'Wednesday, 09-12-2020, 22:40:18'),
('3000000003', 'Shingeki No Kyojin Volume 19', 'Hajime Isayama', 'Shonen Jump', '1607189326_db3d336a380bcfb60677.jpg', 3, 'Bercerita tentang hachiman, sosok yang lebih memilih sendiri dari pada berbaur dengan lainnya. Suatu hari ketika disuruh menulis pandangan nya terhadap masa SMA dia dianggap aneh oleh guru nya.<br />\r\n<br />\r\nKemudian dia disuruh masuk ke klub relawan, sebuah klub yang siap membantu siapa saja murid yang memiliki masalah. disana dia bertemu dengan Yukinon, seorang siswi yang pintar, cantik namun memiliki sifat yang dingin.', 0, 4, 3, 'Monday, 07-12-2020, 11:33:41', 'Wednesday, 09-12-2020, 23:04:28'),
('3000000004', 'Yu-Gi-Oh 5DS Volume 4', 'Kazuki Takahashi', 'Shueisha', '1607229728_cc7a83232e9a2a97f025.jpg', 3, 'Yugioh 5d adalah seri baru setelah yugioh GX, pada zaman ini menceritakan dunia di masa depan dimana kota sebelumnya bernama Domino City menjadi Neo Domino City, di masa ini, begitu banyak teknologi yang sudah dikembangkan, salah satunya adalah Riding-Duel. Riding-duel adalah duel antara duelist dengan menggunakan motor berkecepatan tinggi. Ditambah lagi apabila orang ingin melakukan Riding Duel, mereka harus mengaktifkan kartu Spell Speed World.', 0, 0, 2, 'Monday, 07-12-2020, 11:34:41', 'Wednesday, 09-12-2020, 22:53:13'),
('3000000005', 'Fate Stay Night Heavens Feel Volume 1', 'Kinoko Nasu', 'Type Moon', '1607230269_78131edbc051b2302980.jpg', 3, 'Perang Cawan Suci, sebuah peperangan antar tujuh orang master dan servant mereka untuk memperebutkan cawan suci, perangkat mahakuasa yang bisa mengabulkan berbagai macam harapan. Sepuluh tahun lalu, perang cawan suci keempat telah meluluhlantakan kota Fuyuki dan menelan 500 korban jiwa.<br />\r\n<br />\r\nEmiya Shirou, pemuda yang selamat dari tragedi itu bercita-cita untuk menjadi pahlawan pembela kebenaran seperti ayah angkatnya, Emiya Kiritsugu.', 0, 0, 2, 'Monday, 07-12-2020, 11:35:41', 'Wednesday, 09-12-2020, 22:54:58'),
('3000000006', 'Fate Stay Night Heavens Feel Volume 2', 'Kinoko Nasu', 'Type Moon', '1607230349_b55372f53fc71b330bc8.jpg', 3, 'Perang Cawan Suci, sebuah peperangan antar tujuh orang master dan servant mereka untuk memperebutkan cawan suci, perangkat mahakuasa yang bisa mengabulkan berbagai macam harapan. Sepuluh tahun lalu, perang cawan suci keempat telah meluluhlantakan kota Fuyuki dan menelan 500 korban jiwa.<br />\r\n<br />\r\nEmiya Shirou, pemuda yang selamat dari tragedi itu bercita-cita untuk menjadi pahlawan pembela kebenaran seperti ayah angkatnya, Emiya Kiritsugu.', 1, 2, 5, 'Monday, 07-12-2020, 11:36:41', 'Wednesday, 09-12-2020, 22:54:45'),
('3000000007', 'Fate Stay Night Heavens Feel Volume 3', 'Kinoko Nasu', 'Type Moon', '1607230426_ffadf184da75b43b48f5.jpg', 3, 'Perang Cawan Suci, sebuah peperangan antar tujuh orang master dan servant mereka untuk memperebutkan cawan suci, perangkat mahakuasa yang bisa mengabulkan berbagai macam harapan. Sepuluh tahun lalu, perang cawan suci keempat telah meluluhlantakan kota Fuyuki dan menelan 500 korban jiwa.<br />\r\n<br />\r\nEmiya Shirou, pemuda yang selamat dari tragedi itu bercita-cita untuk menjadi pahlawan pembela kebenaran seperti ayah angkatnya, Emiya Kiritsugu.', 1, 2, 2, 'Monday, 07-12-2020, 11:37:41', 'Wednesday, 09-12-2020, 22:52:01'),
('3000000008', 'Fate Stay Night Heavens Feel Volume 8', 'Kinoko Nasu', 'Type Moon', '1607230520_71dc88dbffda52978f3f.jpg', 3, 'Perang Cawan Suci, sebuah peperangan antar tujuh orang master dan servant mereka untuk memperebutkan cawan suci, perangkat mahakuasa yang bisa mengabulkan berbagai macam harapan. Sepuluh tahun lalu, perang cawan suci keempat telah meluluhlantakan kota Fuyuki dan menelan 500 korban jiwa.<br />\r\n<br />\r\nEmiya Shirou, pemuda yang selamat dari tragedi itu bercita-cita untuk menjadi pahlawan pembela kebenaran seperti ayah angkatnya, Emiya Kiritsugu.', 0, 1, 3, 'Monday, 07-12-2020, 11:38:41', 'Wednesday, 09-12-2020, 22:48:04'),
('3000000009', 'One Punch Man Volume 1', 'One Sensei', 'Viz Media', '1607230691_4b8bffb4ed637ee9c88a.jpg', 3, 'Komik One Punch Man menceritakan seorang pemuda yang ingin menjadi pahlawan, ia bernama Saitama. Selama tiga tahun Saitama berlatih tanpa henti sampai-sampai ia kehilangan rambutnya sehingga menjadi Botak. Sekarang Saitama sangat kuat dan sudah siap untuk menjadi Pahlawan, begitu banyak musuh yang sudah dikalahkannya. Bahkan ia hanya mengalahkan musuhnya dengan hanya 1 kali pukulan (One Punch).', 0, 1, 3, 'Monday, 07-12-2020, 11:39:41', 'Wednesday, 09-12-2020, 22:45:56'),
('3000000010', 'One Punch Man Volume 2', 'One Sensei', 'Viz Media', '1607230781_dc4e8b36af8af0697c03.jpg', 3, 'Komik One Punch Man menceritakan seorang pemuda yang ingin menjadi pahlawan, ia bernama Saitama. Selama tiga tahun Saitama berlatih tanpa henti sampai-sampai ia kehilangan rambutnya sehingga menjadi Botak. Sekarang Saitama sangat kuat dan sudah siap untuk menjadi Pahlawan, begitu banyak musuh yang sudah dikalahkannya. Bahkan ia hanya mengalahkan musuhnya dengan hanya 1 kali pukulan (One Punch).', 0, 0, 1, 'Monday, 07-12-2020, 11:40:41', 'Wednesday, 09-12-2020, 22:41:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukupinjam`
--

CREATE TABLE `bukupinjam` (
  `id_bukupinjam` int(11) NOT NULL,
  `nis_bukupinjam` varchar(20) DEFAULT NULL,
  `no_bukupinjam` varchar(20) NOT NULL,
  `status_bukupinjam` int(1) NOT NULL DEFAULT 0,
  `tanggal_pinjam` varchar(50) NOT NULL,
  `tanggal_kembali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bukupinjam`
--

INSERT INTO `bukupinjam` (`id_bukupinjam`, `nis_bukupinjam`, `no_bukupinjam`, `status_bukupinjam`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(4, '0035000000', '3000000007', 1, 'Tuesday, 08-12-2020, 23:41:34', 'Wednesday, 09-12-2020, 11:35:24'),
(5, '0035000000', '1000000003', 1, 'Tuesday, 08-12-2020, 23:41:45', 'Wednesday, 09-12-2020, 22:40:01'),
(6, '0035000000', '2000000001', 1, 'Tuesday, 08-12-2020, 23:41:56', 'Wednesday, 09-12-2020, 02:26:31'),
(7, '0035000002', '3000000002', 0, 'Wednesday, 09-12-2020, 00:11:23', ''),
(8, '0035000002', '3000000006', 1, 'Wednesday, 09-12-2020, 02:10:53', 'Wednesday, 09-12-2020, 11:36:18'),
(13, '0035000003', '2000000001', 1, 'Wednesday, 09-12-2020, 22:36:58', 'Wednesday, 09-12-2020, 22:37:05'),
(14, '0035000003', '3000000006', 0, 'Wednesday, 09-12-2020, 22:37:18', ''),
(15, '0035000004', '3000000009', 1, 'Wednesday, 09-12-2020, 22:38:14', 'Wednesday, 09-12-2020, 22:38:22'),
(16, '0035000004', '2000000002', 1, 'Wednesday, 09-12-2020, 22:39:03', 'Wednesday, 09-12-2020, 22:39:08'),
(17, '0035000000', '2000000006', 1, 'Wednesday, 09-12-2020, 22:40:50', 'Wednesday, 09-12-2020, 22:40:56'),
(18, '0035000005', '3000000003', 1, 'Wednesday, 09-12-2020, 22:42:41', 'Wednesday, 09-12-2020, 22:42:45'),
(19, '0035000005', '1000000003', 1, 'Wednesday, 09-12-2020, 22:42:58', 'Wednesday, 09-12-2020, 22:43:02'),
(20, '0035000006', '3000000008', 1, 'Wednesday, 09-12-2020, 22:43:19', 'Wednesday, 09-12-2020, 22:43:25'),
(21, '0035000006', '3000000003', 1, 'Wednesday, 09-12-2020, 22:43:53', 'Wednesday, 09-12-2020, 22:43:59'),
(22, '0035000006', '2000000006', 0, 'Wednesday, 09-12-2020, 22:44:22', ''),
(23, '0035000007', '1000000003', 1, 'Wednesday, 09-12-2020, 22:45:19', 'Wednesday, 09-12-2020, 22:45:23'),
(24, '0035000009', '1000000003', 1, 'Wednesday, 09-12-2020, 22:47:23', 'Wednesday, 09-12-2020, 22:51:12'),
(25, '0035000009', '3000000003', 1, 'Wednesday, 09-12-2020, 22:47:31', 'Wednesday, 09-12-2020, 22:51:07'),
(26, '0035000009', '3000000007', 0, 'Wednesday, 09-12-2020, 22:48:20', ''),
(27, '0035000010', '2000000001', 1, 'Wednesday, 09-12-2020, 22:50:07', 'Wednesday, 09-12-2020, 23:04:31'),
(28, '0035000010', '3000000003', 1, 'Wednesday, 09-12-2020, 22:52:42', 'Wednesday, 09-12-2020, 23:04:28'),
(29, '0035000011', '1000000003', 0, 'Wednesday, 09-12-2020, 22:54:11', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `kategori-created_at` varchar(50) NOT NULL,
  `kategori-updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori-created_at`, `kategori-updated_at`) VALUES
(1, 'Buku Ajar', 'Monday, 07-12-2020, 14:21:41', 'Monday, 07-12-2020, 14:21:41'),
(2, 'Novel', 'Monday, 07-12-2020, 14:31:41', 'Monday, 07-12-2020, 14:31:41'),
(3, 'Komik', 'Monday, 07-12-2020, 14:51:41', 'Monday, 07-12-2020, 14:51:41'),
(10, 'Dongeng', 'Wednesday, 09-12-2020, 22:19:30', 'Wednesday, 09-12-2020, 22:19:30'),
(11, 'Non Fiksi', 'Wednesday, 09-12-2020, 22:19:47', 'Wednesday, 09-12-2020, 22:19:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likebuku`
--

CREATE TABLE `likebuku` (
  `id_likebuku` int(11) NOT NULL,
  `nis_likebuku` varchar(20) NOT NULL,
  `no_likebuku` varchar(20) NOT NULL,
  `likebuku-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `likebuku`
--

INSERT INTO `likebuku` (`id_likebuku`, `nis_likebuku`, `no_likebuku`, `likebuku-created_at`) VALUES
(7, '0035000001', '3000000009', 'Wednesday, 09-12-2020, 22:34:08'),
(8, '0035000001', '3000000008', 'Wednesday, 09-12-2020, 22:34:14'),
(9, '0035000001', '2000000001', 'Wednesday, 09-12-2020, 22:34:20'),
(10, '0035000002', '2000000001', 'Wednesday, 09-12-2020, 22:35:00'),
(11, '0035000002', '2000000003', 'Wednesday, 09-12-2020, 22:35:13'),
(12, '0035000002', '1000000001', 'Wednesday, 09-12-2020, 22:35:18'),
(13, '0035000002', '2000000006', 'Wednesday, 09-12-2020, 22:35:22'),
(14, '0035000002', '3000000003', 'Wednesday, 09-12-2020, 22:35:35'),
(15, '0035000003', '2000000001', 'Wednesday, 09-12-2020, 22:36:01'),
(16, '0035000003', '1000000001', 'Wednesday, 09-12-2020, 22:36:12'),
(17, '0035000003', '1000000002', 'Wednesday, 09-12-2020, 22:36:16'),
(18, '0035000003', '1000000003', 'Wednesday, 09-12-2020, 22:36:20'),
(19, '0035000003', '2000000006', 'Wednesday, 09-12-2020, 22:36:28'),
(20, '0035000003', '3000000003', 'Wednesday, 09-12-2020, 22:36:40'),
(21, '0035000004', '3000000009', 'Wednesday, 09-12-2020, 22:38:15'),
(22, '0035000004', '1000000003', 'Wednesday, 09-12-2020, 22:38:32'),
(23, '0035000004', '2000000001', 'Wednesday, 09-12-2020, 22:38:42'),
(24, '0035000004', '2000000002', 'Wednesday, 09-12-2020, 22:39:01'),
(25, '0035000000', '1000000003', 'Wednesday, 09-12-2020, 22:40:08'),
(26, '0035000000', '3000000002', 'Wednesday, 09-12-2020, 22:40:18'),
(27, '0035000000', '1000000002', 'Wednesday, 09-12-2020, 22:40:23'),
(28, '0035000000', '2000000005', 'Wednesday, 09-12-2020, 22:40:37'),
(29, '0035000000', '2000000004', 'Wednesday, 09-12-2020, 22:40:43'),
(30, '0035000000', '2000000006', 'Wednesday, 09-12-2020, 22:40:51'),
(31, '0035000005', '3000000010', 'Wednesday, 09-12-2020, 22:41:29'),
(32, '0035000005', '3000000009', 'Wednesday, 09-12-2020, 22:41:36'),
(33, '0035000005', '2000000001', 'Wednesday, 09-12-2020, 22:41:41'),
(34, '0035000005', '1000000003', 'Wednesday, 09-12-2020, 22:41:48'),
(35, '0035000005', '2000000002', 'Wednesday, 09-12-2020, 22:41:55'),
(36, '0035000005', '2000000005', 'Wednesday, 09-12-2020, 22:42:00'),
(37, '0035000005', '2000000007', 'Wednesday, 09-12-2020, 22:42:09'),
(38, '0035000005', '3000000003', 'Wednesday, 09-12-2020, 22:42:18'),
(39, '0035000006', '3000000008', 'Wednesday, 09-12-2020, 22:43:17'),
(40, '0035000006', '2000000001', 'Wednesday, 09-12-2020, 22:43:34'),
(41, '0035000006', '2000000006', 'Wednesday, 09-12-2020, 22:43:44'),
(43, '0035000007', '2000000001', 'Wednesday, 09-12-2020, 22:44:49'),
(44, '0035000007', '2000000002', 'Wednesday, 09-12-2020, 22:44:54'),
(45, '0035000007', '2000000004', 'Wednesday, 09-12-2020, 22:44:59'),
(46, '0035000007', '2000000003', 'Wednesday, 09-12-2020, 22:45:03'),
(47, '0035000007', '2000000006', 'Wednesday, 09-12-2020, 22:45:12'),
(50, '0035000008', '2000000006', 'Wednesday, 09-12-2020, 22:46:08'),
(51, '0035000008', '2000000002', 'Wednesday, 09-12-2020, 22:46:13'),
(52, '0035000008', '3000000007', 'Wednesday, 09-12-2020, 22:46:33'),
(53, '0035000008', '3000000001', 'Wednesday, 09-12-2020, 22:46:46'),
(54, '0035000008', '3000000006', 'Wednesday, 09-12-2020, 22:46:51'),
(56, '0035000009', '2000000001', 'Wednesday, 09-12-2020, 22:47:36'),
(57, '0035000009', '3000000004', 'Wednesday, 09-12-2020, 22:47:47'),
(58, '0035000009', '3000000005', 'Wednesday, 09-12-2020, 22:47:52'),
(60, '0035000009', '3000000008', 'Wednesday, 09-12-2020, 22:48:04'),
(61, '0035000009', '3000000006', 'Wednesday, 09-12-2020, 22:48:10'),
(62, '0035000010', '2000000001', 'Wednesday, 09-12-2020, 22:49:45'),
(63, '0035000009', '2000000006', 'Wednesday, 09-12-2020, 22:51:26'),
(64, '0035000009', '3000000007', 'Wednesday, 09-12-2020, 22:52:01'),
(65, '0035000010', '2000000005', 'Wednesday, 09-12-2020, 22:53:03'),
(66, '0035000010', '3000000004', 'Wednesday, 09-12-2020, 22:53:13'),
(67, '0035000010', '3000000006', 'Wednesday, 09-12-2020, 22:53:24'),
(68, '0035000011', '3000000006', 'Wednesday, 09-12-2020, 22:53:52'),
(69, '0035000001', '3000000006', 'Wednesday, 09-12-2020, 22:54:45'),
(70, '0035000001', '2000000003', 'Wednesday, 09-12-2020, 22:54:50'),
(71, '0035000001', '3000000005', 'Wednesday, 09-12-2020, 22:54:58'),
(72, '0035000001', '3000000001', 'Wednesday, 09-12-2020, 22:55:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `nis` varchar(20) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `password` varchar(500) NOT NULL,
  `foto_profil` varchar(500) NOT NULL DEFAULT 'default.png',
  `deskripsi` varchar(500) NOT NULL DEFAULT 'Tidak ada deskripsi',
  `jabatan` int(11) NOT NULL DEFAULT 2,
  `user-created_at` varchar(50) DEFAULT NULL,
  `user-updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`nis`, `nama_user`, `tanggal_lahir`, `password`, `foto_profil`, `deskripsi`, `jabatan`, `user-created_at`, `user-updated_at`) VALUES
('0035000000', 'Andry Pebrianto', '2003-02-27', '$2y$10$UyIM4w.ueB6Aj1uYyvLxp.VU7T52zZgHcWj0PMr/V6woPZvm0wCHi', '1607413722_5fa63fb669066fa639b2.png', 'Nama saya adalah Andry Pebrianto. Usia saya 17 Tahun. Saat ini saya sedang bersekolah di SMKN 2 Trenggalek dengan mengambil jurusan Rekayasa Perangkat Lunak.', 2, 'Monday, 07-12-2020, 15:20:41', 'Wednesday, 09-12-2020, 21:42:14'),
('0035000001', 'User Percobaan Satu', '2003-02-01', '$2y$10$gMGo8i5jkTYmS13xRs2F3.Hu4DoR92tzr99hL6TxghWtXHm4nrdh2', '1607527423_9ddcad65129dea43d8bd.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:23:43', 'Wednesday, 09-12-2020, 22:23:43'),
('0035000002', 'User Percobaan Dua', '2003-02-02', '$2y$10$74NChwHTspn9atjc5OnUJutJgnSrUYOrMbhr51wCXSaEdceiF5YWu', '1607523605_550c53981385a319cb7b.png', 'Tidak ada deskripsi', 2, 'Monday, 07-12-2020, 18:26:37', 'Wednesday, 09-12-2020, 22:22:16'),
('0035000003', 'User Percobaan Tiga', '2003-02-03', '$2y$10$XitDWjU8tyYssCI/D1.JiOPwgDpTFPHI/WgKYwuxsSr7Sc5CfSVQ.', '1607523674_74c7d886acea66da436c.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 21:21:14', 'Wednesday, 09-12-2020, 21:21:14'),
('0035000004', 'User Percobaan Empat', '2003-02-04', '$2y$10$L6owcmvGeqSCDYrwwlMicuHr95qcS3.Y9caZHuhseLuU3dpS98thC', '1607523766_30ee08624135d4547aff.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 21:22:46', 'Wednesday, 09-12-2020, 21:22:46'),
('0035000005', 'User Percobaan Lima', '2003-02-05', '$2y$10$SVhfANhSoyH9ojP59p9PK.7XRyD6PzU7y1krS.Gsvl2hXUgjlgl7i', '1607527477_4a0531a73f79f5bee12d.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:24:37', 'Wednesday, 09-12-2020, 22:24:37'),
('0035000006', 'User Percobaan Enam', '2003-02-06', '$2y$10$AtTJ5bcR0Hok5mJF1rnx6uf.PxnCj0s0pQVJWiKCY.34976muIl32', '1607527550_061ddf3f627ffcacc248.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:25:50', 'Wednesday, 09-12-2020, 22:25:50'),
('0035000007', 'User Percobaan Tujuh', '2003-02-07', '$2y$10$GTHCOreIL42vVlYhtIRD9eNiTwncnFcxlqieEFI4BOSa.Bb6DOr7C', '1607527844_ca6daaa44a18eb530fe3.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:30:44', 'Wednesday, 09-12-2020, 22:30:44'),
('0035000008', 'User Percobaan Delapan', '2003-02-08', '$2y$10$KSTU5OtgeW7ipeVAg.zwPOskfYtbjMHru2WPwX2RzBWjmMg1Kr3zy', '1607527846_3523c2c7e7625b47db9f.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:30:46', 'Wednesday, 09-12-2020, 22:30:46'),
('0035000009', 'User Percobaan Sembilan', '2003-02-09', '$2y$10$GYsSIQPiJIucS1p72t2XK./5e01D4B5ezwXUxv/dj/GDvSCIRfKlu', '1607527848_80b5e62223ff80d193dc.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:30:48', 'Wednesday, 09-12-2020, 22:30:48'),
('0035000010', 'User Percobaan Sepuluh', '2003-02-10', '$2y$10$kskD6HM9Ermkj8H7DQsCIu8dIbP6hi7s5Cs.F1qiVT7.SZ5R8wlly', '1607527850_8abc0a5c3622380d2d34.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:30:50', 'Wednesday, 09-12-2020, 22:49:20'),
('0035000011', 'User Percobaan Sebelas', '2003-02-11', '$2y$10$2pIcmi5XEZ9mzYxwxicjyeoUXbH4ZDkkRgKitwe4O4ZeN0XRAXswO', '1607527852_501d080b9602fa9b1ce9.png', 'Tidak ada deskripsi', 2, 'Wednesday, 09-12-2020, 22:30:52', 'Wednesday, 09-12-2020, 22:49:36'),
('1234567890', 'Admin Petugas Tertinggi', '2000-01-01', '$2y$10$F8dlTDHCIoWhFnz1KepxK.HLyNqIiMhCnM7hgjQb1VNMYnBnZYd7i', '1607010406_39d04efab1344b7c82dd.png', 'Akun ini adalah akun petugas yang paling berkuasa terhadap aplikasi ini. Akun ini bisa melakukan berbagai macam hal yang tidak bisa dilakukan oleh user, seperti menambahkan user baru, menambahkan buku baru, dll.', 1, 'Monday, 07-12-2020, 11:20:41', 'Wednesday, 09-12-2020, 23:09:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`no_buku`),
  ADD KEY `buku+kategori=id_kategori` (`kategori_buku`);

--
-- Indeks untuk tabel `bukupinjam`
--
ALTER TABLE `bukupinjam`
  ADD PRIMARY KEY (`id_bukupinjam`),
  ADD KEY `bukupinjam+buku=no_buku` (`no_bukupinjam`),
  ADD KEY `bukupinjam+user=nis` (`nis_bukupinjam`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `likebuku`
--
ALTER TABLE `likebuku`
  ADD PRIMARY KEY (`id_likebuku`),
  ADD KEY `likebuku+buku=no_buku` (`no_likebuku`),
  ADD KEY `likebuku+user=nis` (`nis_likebuku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukupinjam`
--
ALTER TABLE `bukupinjam`
  MODIFY `id_bukupinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `likebuku`
--
ALTER TABLE `likebuku`
  MODIFY `id_likebuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku+kategori=id_kategori` FOREIGN KEY (`kategori_buku`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bukupinjam`
--
ALTER TABLE `bukupinjam`
  ADD CONSTRAINT `bukupinjam+buku=no_buku` FOREIGN KEY (`no_bukupinjam`) REFERENCES `buku` (`no_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bukupinjam+user=nis` FOREIGN KEY (`nis_bukupinjam`) REFERENCES `user` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likebuku`
--
ALTER TABLE `likebuku`
  ADD CONSTRAINT `likebuku+buku=no_buku` FOREIGN KEY (`no_likebuku`) REFERENCES `buku` (`no_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likebuku+user=nis` FOREIGN KEY (`nis_likebuku`) REFERENCES `user` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
