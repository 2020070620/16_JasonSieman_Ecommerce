<?php
include "koneksi.php";

// ambil input
$username = trim($_POST['username']);
$produk   = trim($_POST['produk']);
$jumlah   = (int)$_POST['jumlah'];
$metode   = trim($_POST['metode']);

if ($username === "" || $produk === "" || $jumlah <= 0 || $metode === "") {
    echo "<script>alert('Form tidak boleh kosong.'); window.location='transaksi.php';</script>";
    exit;
}

// cek username ada atau tidak
$cek = mysqli_query($koneksi, "SELECT * FROM register_login WHERE username='$username' LIMIT 1");

if (mysqli_num_rows($cek) == 0) {
    echo "<script>alert('Username tidak ditemukan!'); window.location='transaksi.php';</script>";
    exit;
}

$user = mysqli_fetch_assoc($cek);
$phone   = $user['phone'];
$address = $user['address'];
$name    = $user['name'];

// harga source of truth
$harga_list = [
    "Garlickoe Bawang Hitam Tunggal 250gr" => 89999,
    "Garlickoe Bawang Hitam Tunggal 1kg" => 360000,
    "Garlickoe Bawang Hitam Tunggal Kupas 275gr" => 64699,
    "Garlickoe Bawang Hitam Kating 250gr" => 60000,
    "Garlickoe Bawang Hitam Kating 1kg" => 180000,
    "Garlickoe Bawang Hitam Kating Kupas 275gr" => 50000,
];

$harga = $harga_list[$produk];
$total = $harga * $jumlah;

// simpan transaksi
$sql = "INSERT INTO transaksi (username, phone, address, product, jumlah, total, payment_method, tanggal)
        VALUES ('$username', '$phone', '$address', '$produk', $jumlah, $total, '$metode', NOW())";

$ok = mysqli_query($koneksi, $sql);

if ($ok) {
    echo "<script>alert('Transaksi berhasil!'); window.location='transaksi.php';</script>";
} else {
    echo "<script>alert('Gagal menyimpan transaksi: ".mysqli_error($koneksi)."'); window.location='transaksi.php';</script>";
}
?>
