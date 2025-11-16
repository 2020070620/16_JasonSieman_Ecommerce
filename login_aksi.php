<?php
session_start();
include "koneksi.php";

// pastikan method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.html");
    exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($username === '' || $password === '') {
    echo "<script>alert('Isi username dan password.'); window.location='login.html';</script>";
    exit;
}

// escape
$username_esc = mysqli_real_escape_string($koneksi, $username);

$q = mysqli_query($koneksi, "SELECT * FROM register_login WHERE username='$username_esc' LIMIT 1");

if (!$q) {
    echo "<script>alert('Kesalahan database.'); window.location='login.html';</script>";
    exit;
}

$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<script>alert('Username tidak ditemukan!'); window.location='login.html';</script>";
    exit;
}

if (!password_verify($password, $data['password'])) {
    echo "<script>alert('Password salah!'); window.location='login.html';</script>";
    exit;
}

// sukses — set session
$_SESSION['id'] = $data['id'];
$_SESSION['username'] = $data['username'];
$_SESSION['phone'] = $data['phone'];
$_SESSION['address'] = $data['address'];
$_SESSION['name'] = $data['name'];

// ✔ Redirect ke halaman yang ada
header("Location: index.html");
exit;
?>
