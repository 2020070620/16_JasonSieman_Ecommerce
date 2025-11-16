<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href=".//assets/img/brand.png">

  <title>Admin | Data Akun & Transaksi</title>

  <!-- FEANE CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1b1b1b, #303030, #ffffff);
      background-size: 400% 400%;
      animation: bgMove 12s ease infinite;
    }

    @keyframes bgMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .admin-wrapper {
      margin-top: 120px;
      padding: 20px;
      max-width: 1250px;
      margin-left: auto;
      margin-right: auto;
    }

    .admin-box {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(14px);
      padding: 30px;
      border-radius: 18px;
      box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.25);
      border: 1px solid rgba(255, 255, 255, 0.25);
    }

    h1 {
      font-weight: 700;
      text-align: center;
      color: #fff;
      margin-bottom: 25px;
    }

    h2 {
      font-size: 22px;
      margin-top: 40px;
      color: #ffbe33;
      font-weight: 600;
      padding-left: 14px;
      border-left: 5px solid #ffbe33;
    }

    table {
      width: 100%;
      margin-top: 18px;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.35);
      backdrop-filter: blur(8px);
    }

    th {
      background: #ffbe33;
      color: #1b1b1b;
      padding: 12px;
      font-size: 15px;
      text-align: left;
    }

    td {
      padding: 11px;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
      font-size: 14px;
      color: #111;
      background: rgba(255, 255, 255, 0.55);
    }

    tr:hover td {
      background: rgba(255, 222, 150, 0.65);
    }

    @media (max-width: 768px) {
      table {
        font-size: 13px;
      }
      th, td {
        padding: 8px;
      }
    }
  </style>

</head>

<body class="sub_page">

  <!-- NAVBAR FEANE ORI – TIDAK DIUBAH -->
  <div class="hero_area">
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">

          <a class="navbar-brand" href="index.html">
            <span>Garlickoe Admin</span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item">
                <a class="nav-link" href="index.html">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="menu.html">Produk</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="transaksi.php">Transaksi</a>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="data.php">Admin</a>
              </li>

              <a href="login.html" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>

            </ul>
          </div>

        </nav>
      </div>
    </header>
  </div>

  <!-- CONTENT -->
  <div class="admin-wrapper">
    <div class="admin-box">

      <h1>📊 DATA PENGGUNA & TRANSAKSI</h1>

      <!-- DATA AKUN -->
      <h2>📌 Data Akun Terdaftar</h2>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nama</th>
            <th>Phone</th>
            <th>Address</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $akun = mysqli_query($koneksi, "SELECT * FROM register_login ORDER BY id ASC");
          while ($row = mysqli_fetch_assoc($akun)) {
            echo "
              <tr>
                  <td>{$row['id']}</td>
                  <td>{$row['username']}</td>
                  <td>{$row['password']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['phone']}</td>
                  <td>{$row['address']}</td>
              </tr>";
          }
          ?>
        </tbody>
      </table>

      <!-- DATA TRANSAKSI -->
      <h2>📌 Data Transaksi Masuk</h2>

      <table>
        <thead>
          <tr>
            <th>ID Transaksi</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Total (Rp)</th>
            <th>Metode</th>
            <th>Tanggal</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY transaksi_id DESC");
          while ($t = mysqli_fetch_assoc($transaksi)) {
            echo "
              <tr>
                  <td>{$t['transaksi_id']}</td>
                  <td>{$t['username']}</td>
                  <td>{$t['phone']}</td>
                  <td>{$t['address']}</td>
                  <td>{$t['product']}</td>
                  <td>{$t['jumlah']}</td>
                  <td>" . number_format($t['total'], 0, ',', '.') . "</td>
                  <td>{$t['payment_method']}</td>
                  <td>{$t['tanggal']}</td>
              </tr>";
          }
          ?>
        </tbody>
      </table>

    </div>
  </div>

  <!-- JS Bootstrap -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>

</body>
</html>
