<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Peminjaman</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 style="font-size:25px;" align="center">
        Laporan Peminjaman
    </h1>

    <br>

    <hr>
    <strong>Tanggal Peminjaman:</strong> <?= $bukupinjam['tanggal_pinjam'] ?>
    <hr>

    <p>Detail Siswa:</p>
    <table cellpadding="6">
        <tr style="background-color: #dddddd;">
            <th><strong>NIS</strong></th>
            <th><strong>Nama Siswa</strong></th>
            <th><strong>Foto Siswa</strong></th>
            <th><strong>Tanggal Lahir</strong></th>
        </tr>
        <tr>
            <td><?= $bukupinjam['nis'] ?></td>
            <td><?= $bukupinjam['nama_user'] ?></td>
            <td><img height="90px" width="90px" src="foto/fotoprofil/<?= $bukupinjam['foto_profil'] ?>"></td>
            <td><?= $bukupinjam['tanggal_lahir'] ?></td>
        </tr>
    </table>

    <br>

    <p>Detail Buku:</p>
    <table cellpadding="6">
        <tr style="background-color: #dddddd;">
            <th><strong>No Buku</strong></th>
            <th><strong>Nama Buku</strong></th>
            <th><strong>Pengarang Buku</strong></th>
            <th><strong>Sampul Buku</strong></th>
        </tr>
        <tr>
            <td><?= $bukupinjam['no_buku'] ?></td>
            <td><?= $bukupinjam['nama_buku'] ?></td>
            <td><?= $bukupinjam['pengarang_buku'] ?></td>
            <td><img height="90px" width="65pxpx" src="foto/sampulbuku/<?= $bukupinjam['sampul_buku'] ?>"></td>
        </tr>
    </table>
</body>

</html>