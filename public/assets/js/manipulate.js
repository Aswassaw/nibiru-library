// Merubah nama di kanan atas navbar menjadi singkatan
let nama_awal = document.getElementById('nav-name');
// Jika nama_awal tidak null
if (nama_awal !== null) {
    manipulateName(nama_awal.textContent);
    // Fungsi untuk memanipulasi nama
    function manipulateName(nama) {
        let nama_array = nama.split(' '), singkatan, singkatan_array = [];
        for (let i = 0; i < nama_array.length - 1; i++) {
            singkatan = nama_array[i + 1].slice(0, 1);
            singkatan_array.push(singkatan);
        }
        let nama_akhir = `${nama_array[0] + ' ' + singkatan_array.join(' ')}`;
        nama_awal.innerText = nama_akhir;
    }
}

// Merubah text validation buku ketika ada error karena di display:inline tetap tidak mempan, sialan
let validation_awal = document.getElementById('foto-validation');
// Jika ada pesan kesalahan
if (validation_awal !== null) {
    document.getElementsByClassName('alert-danger')[0].innerText = validation_awal.textContent.trim();
}