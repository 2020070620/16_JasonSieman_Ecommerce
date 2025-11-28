<?php
include 'koneksi.php';

$id = $_GET['transaksi_id'];
mysqli_query($koneksi, "DELETE FROM transaksi WHERE transaksi_id='$id'");

header("Location: data.php");
exit;
?>
