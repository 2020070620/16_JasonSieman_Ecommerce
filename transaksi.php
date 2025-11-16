<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Transaksi | Garlickoe</title>
  <link rel="icon" type="image/x-icon" href=".//assets/img/brand.png">

  <!-- Feane CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />

  <style>
    .transaksi-container {
      max-width: 650px;
      margin: 160px auto 40px;
      background: #fff;
      padding: 25px 30px;
      border-radius: 14px;
      box-shadow: 0px 3px 12px rgba(0, 0, 0, 0.15);
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .btn-submit {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      border-radius: 6px;
      border: none;
      background: #ffbe33;
      font-size: 18px;
      color: white;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-submit:hover {
      background: #d89d1f;
    }
  </style>
</head>

<body class="sub_page">

  <!-- ================= NAVBAR FEANE ORIGINAL ================= -->
  <div class="hero_area">
    <div class="bg-box">
      <img src=".//assets/img/bawang tunggal product preview.jpg" alt="">
    </div>

    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">

          <!-- LOGO -->
          <a class="navbar-brand" href="index.html">
            <span>Garlickoe</span>
          </a>

          <!-- TOGGLER -->
          <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
          </button>

          <!-- NAV MENU -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mx-auto ">
              <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="menu.html">Products</a></li>
              <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
              <li class="nav-item"><a class="nav-link" href="book.html">Order</a></li>
            </ul>

            <!-- RIGHT ICONS -->
            <div class="user_option">
              <a href="login.html" class="user_link"><i class="fa fa-user"></i></a>
              <a class="cart_link" href="transaksi.php"><i class="fa fa-shopping-cart"></i></a>
              <a href="data.php" class="order_online">Admin</a>
            </div>

          </div>
        </nav>
      </div>
    </header>
  </div>
  <!-- ================= END NAVBAR ================= -->



  <!-- ================= FORM TRANSAKSI ================= -->
  <div class="transaksi-container">

    <h2 class="text-center mb-4">Form Transaksi</h2>

    <form action="transaksi_aksi.php" method="POST">

      <label>Username</label>
      <input type="text" name="username" required placeholder="contoh: jason123">

      <label>Pilih Produk</label>
      <select name="produk" id="produk" required onchange="updateHarga()">
        <option value="">-- Pilih Produk --</option>

        <option value="Garlickoe Bawang Hitam Tunggal 250gr" data-harga="89999">Tunggal 250gr — Rp 89.999</option>
        <option value="Garlickoe Bawang Hitam Tunggal 1kg" data-harga="360000">Tunggal 1kg — Rp 360.000</option>
        <option value="Garlickoe Bawang Hitam Tunggal Kupas 275gr" data-harga="64699">Tunggal Kupas 275gr — Rp 64.699</option>
        <option value="Garlickoe Bawang Hitam Kating 250gr" data-harga="60000">Kating 250gr — Rp 60.000</option>
        <option value="Garlickoe Bawang Hitam Kating 1kg" data-harga="180000">Kating 1kg — Rp 180.000</option>
        <option value="Garlickoe Bawang Hitam Kating Kupas 275gr" data-harga="50000">Kating Kupas 275gr — Rp 50.000</option>
      </select>

      <label>Harga</label>
      <input type="text" id="harga" readonly>

      <label>Jumlah</label>
      <input type="number" name="jumlah" id="jumlah" value="1" min="1" required oninput="hitungTotal()">

      <label>Metode Pembayaran</label>
      <select name="metode" required>
        <option value="COD">COD</option>
        <option value="Transfer Bank">Transfer Bank</option>
        <option value="Kartu Kredit">Kartu Kredit</option>
        <option value="Dana">Dana</option>
        <option value="OVO">OVO</option>
        <option value="Gopay">Gopay</option>
        <option value="ShopeePay">ShopeePay</option>
      </select>

      <label>Total</label>
      <input type="text" id="total_display" readonly>

      <button type="submit" class="btn-submit">Kirim Transaksi</button>
      <a href="riwayat.php" class="btn btn-warning mt-3">Lihat Riwayat Transaksi</a>


    </form>

  </div>

  <!-- ================= FEANE JS ================= -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>

  <script>
    function updateHarga() {
      const sel = document.getElementById('produk');
      const harga = sel.options[sel.selectedIndex].getAttribute('data-harga') || 0;
      document.getElementById('harga').value = harga;
      hitungTotal();
    }

    function hitungTotal() {
      const harga = parseInt(document.getElementById('harga').value) || 0;
      const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
      document.getElementById('total_display').value = harga * jumlah;
    }
  </script>

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
