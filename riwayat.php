<?php
session_start();
include 'koneksi.php';

// FIX LOGIN LOOP
if (!isset($_SESSION['id'])) {
    header("Location: riwayat.php");
    exit();
}

$user_id = $_SESSION['id'];

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE user_id='$user_id' ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Riwayat Transaksi</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href=".//assets/img/brand.png">
<style>
    body {
        margin: 0;
        background-color: #0c0c0c;
        color: #fff;
        font-family: "Poppins", sans-serif;
    }

    .container {
        width: 90%;
        max-width: 1100px;
        margin: 40px auto;
        text-align: center;
    }

    h2 {
        color: #f1c40f;
        margin-bottom: 25px;
        font-size: 32px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .back-btn {
        display: inline-block;
        padding: 10px 18px;
        background: #f1c40f;
        color: #000;
        text-decoration: none;
        font-weight: 600;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(241, 196, 15, 0.6);
        transition: .3s;
        margin-bottom: 25px;
    }

    .back-btn:hover {
        background: #ffe27a;
        box-shadow: 0 0 20px rgba(241, 196, 15, 1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        background: #111;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.15);
    }

    th {
        background: #f1c40f;
        color: black;
        font-weight: 600;
        padding: 14px;
    }

    td {
        padding: 14px;
        border-bottom: 1px solid #222;
    }

    tr:hover {
        background: #1b1b1b;
    }

    .del-btn {
        background: #e74c3c;
        color: white;
        padding: 7px 12px;
        border-radius: 6px;
        text-decoration: none;
        transition: .3s;
        font-weight: 600;
    }

    .del-btn:hover {
        background: #ff6b5a;
        box-shadow: 0 0 10px rgba(255, 60, 60, .8);
    }
</style>
</head>

<body>

<div class="container">

    <a href="transaksi.php" class="back-btn">⟵ Kembali</a>

    <h2>Riwayat Transaksi</h2>

    <table>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?php echo $row['produk']; ?></td>
            <td>Rp <?php echo $row['harga']; ?></td>
            <td><?php echo $row['jumlah']; ?></td>
            <td>Rp <?php echo $row['total']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td>
                <a class="del-btn" 
                   href="delete_transaksi.php?id=<?php echo $row['transaksi_id']; ?>"
                   onclick="return confirm('Hapus transaksi ini?');">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
<footer class="footer_section">
  <div class="container">
    <div class="footer-info" style="text-align:center;">

      <p style="margin-bottom: 6px;">
        &copy; <span id="displayYear"></span> Garlickoe — All Rights Reserved
      </p>

      <p style="margin: 0; font-size: 15px; opacity: .85;">
        Website dibuat oleh <b style="color:#f1c40f;">Jason Sieman</b><br>
        Kelas <b>12.4</b>, Absen <b>16</b>, SMA Petra 1
      </p>

      <p style="margin-top: 8px; font-size: 14px; opacity: .8;">
        Bahasa pemrograman: <span style="color:#f1c40f;">HTML • CSS • PHP • SQL</span>
      </p>

      <p style="margin-top: 10px;">
        <a href="data.php" style="color:#f1c40f; text-decoration:none; font-weight:600;">
          Lihat Detail Pembuat →
        </a>
      </p>

    </div>
  </div>
</footer>

</html>
