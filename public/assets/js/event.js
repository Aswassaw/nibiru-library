// Event ketika show password di klik
let show_pass = document.getElementById('show-password');
// Jika element show_pass ada
if (show_pass !== null) {
    show_pass.addEventListener('change', () => showPassword());
    // Jika ada element tombol reset
    if (document.getElementsByClassName('reset')[0] != null) {
        document.getElementsByClassName('reset')[0].addEventListener('click', () => {
            // Jika checkbox show password telah tercentang
            if (show_pass.classList.contains('check')) {
                showPassword();
            }
        })
    }
    // Fungsi untuk menampilkan password
    function showPassword() {
        // Jika user mencentang show password
        if (show_pass.nextElementSibling.getElementsByTagName('i')[0].classList.contains('fa-eye-slash')) {
            show_pass.classList.replace('check', 'no-check');
            show_pass.nextElementSibling.innerHTML = '';
            show_pass.nextElementSibling.insertAdjacentHTML('beforeend', `<i class="fas fa-eye"></i> Show Password`);
            document.getElementById('password').setAttribute('type', 'password');
        }
        // Jika user tidak mencentang show password
        else {
            show_pass.classList.replace('no-check', 'check');
            show_pass.nextElementSibling.innerHTML = '';
            show_pass.nextElementSibling.insertAdjacentHTML('beforeend', `<i class="fas fa-eye-slash"></i> Hide Password`);
            document.getElementById('password').setAttribute('type', 'text');
        }
    }
}

// Event ketika kategori buku diganti
let kategori = document.getElementById('kategori');
// Jika elemen kategori ada
if (kategori !== null) {
    kategori.addEventListener('change', () => document.getElementById('ketegori-submit').click());
}

// Fungsi untuk mode gelap dan mode terang
let tema_mode = document.getElementById('tema-mode');
// Jika button darkmode ada
if(tema_mode != null){
    // Jika pada local storage telah terdapat sebuah item dengan nama tema yang isinya adalah dark
    if (localStorage.getItem('tema') === 'dark') {
        document.body.classList.toggle('dark');
        tema_mode.setAttribute('checked', 'checked');
        tema_mode.nextElementSibling.innerText = "Dark";
        // Tooggle untuk menambahkan class bernama bg-dark pada elemen dengan class card
        document.querySelectorAll('.card').forEach(index => index.classList.toggle('card-dark'));
    }
    // Ketika terdapat perubahan pada tema-mode, maka jalankan fungsi setDarkMode
    tema_mode.addEventListener('change', setDarkMode);
    // Fungsi untuk darkmode
    function setDarkMode() {
        // Jika pada local storage telah terdapat sebuah item dengan nama tema yang isinya adalah dark
        if (localStorage.getItem('tema') === 'dark') {
            // Hapus item dengan nama tema
            localStorage.removeItem('tema');
            tema_mode.nextElementSibling.innerText = "Light";
        }
        // Jika tidak ada
        else {
            // Tambahkan item bernama tema dengan isi dark
            localStorage.setItem('tema', 'dark');
            tema_mode.nextElementSibling.innerText = "Dark";
        }
        // Toggle untuk menambahkan class bernama dark pada body
        document.body.classList.toggle('dark');
        // Tooggle untuk menambahkan class bernama bg-dark pada elemen dengan class card
        document.querySelectorAll('.card').forEach(index => index.classList.toggle('card-dark'));
    }
}