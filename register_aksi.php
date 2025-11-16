<?php
// register_aksi.php
include 'koneksi.php';

// Ambil data dari form (gunakan names yang sama seperti di register.html)
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$name     = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone    = isset($_POST['phone']) ? trim($_POST['phone']) : ''; // expected format: +62...
$address  = isset($_POST['address']) ? trim($_POST['address']) : '';
$birth    = isset($_POST['birth']) ? trim($_POST['birth']) : '';

// Basic required check
if ($email === '' || $username === '' || $password === '' || $name === '' || $phone === '' || $address === '' || $birth === '') {
    echo "<script>alert('Semua field wajib diisi!'); window.location='register.html';</script>";
    exit;
}

// Server-side PHONE validation: harus mulai +62 dan minimal 8 digit setelah +62
if (!preg_match('/^\+62[0-9]{8,15}$/', $phone)) {
    echo "<script>alert('Nomor telepon tidak valid. Format yang benar: +62 diikuti minimal 8 angka. Contoh: +62812345678'); window.location='register.html';</script>";
    exit;
}

// Validasi phone contains only digits after +62 (redundant, covered by regex)
// Validate email basic
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Format email tidak valid'); window.location='register.html';</script>";
    exit;
}

// Cek username / email unik di tabel register_login
$username_esc = mysqli_real_escape_string($koneksi, $username);
$email_esc = mysqli_real_escape_string($koneksi, $email);

$check = mysqli_query($koneksi, "SELECT id FROM register_login WHERE username='$username_esc' OR email='$email_esc' LIMIT 1");
if (!$check) {
    echo "<script>alert('Terjadi kesalahan database: ". mysqli_error($koneksi) ."'); window.location='register.html';</script>";
    exit;
}
if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Email atau username sudah digunakan.'); window.location='register.html';</script>";
    exit;
}

// Hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// Escape other fields and insert
$name_esc = mysqli_real_escape_string($koneksi, $name);
$address_esc = mysqli_real_escape_string($koneksi, $address);
$phone_esc = mysqli_real_escape_string($koneksi, $phone);
$birth_esc = mysqli_real_escape_string($koneksi, $birth);

$sql = "INSERT INTO register_login (email, username, password, name, phone, address, birth)
        VALUES ('$email_esc', '$username_esc', '$hash', '$name_esc', '$phone_esc', '$address_esc', '$birth_esc')";

$res = mysqli_query($koneksi, $sql);
if ($res) {
    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.html';</script>";
    exit;
} else {
    echo "<script>alert('Gagal menyimpan data: ". mysqli_error($koneksi) ."'); window.location='register.html';</script>";
    exit;
}
?>
