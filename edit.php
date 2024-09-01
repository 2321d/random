<?php

$servername = "localhost";
$username = "root";
$password = "";    
$dbname = "db_tiket"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$harga_paket = array(
'standar' => 50000,
'premium' => 100000,
'VIP' => 150000
);

if (isset($_POST['update'])) {
$id = $conn->real_escape_string($_POST['id']);
$nama = $conn->real_escape_string($_POST['nama']);
$email = $conn->real_escape_string($_POST['email']);
$tanggal = $conn->real_escape_string($_POST['tanggal']);
$jumlah_peserta = $conn->real_escape_string($_POST['jumlah_peserta']);
$jumlah_hari = $conn->real_escape_string($_POST['jumlah_hari']);
$paket_perjalanan = $conn->real_escape_string($_POST['paket_perjalanan']);
$tujuan = $conn->real_escape_string($_POST['tujuan']);
    
$total_harga = $jumlah_peserta * $jumlah_hari * $harga_paket[$paket_perjalanan];
    
    $sql = "UPDATE tiket SET nama='$nama', email='$email', tanggal='$tanggal', jumlah_peserta='$jumlah_peserta', jumlah_hari='$jumlah_hari', tujuan='$tujuan', paket_perjalanan='$paket_perjalanan', total_harga='$total_harga' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!');window.location.href='tampil.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');window.location.href='tampil.php';</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM tiket WHERE id=$id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan!');window.location.href='tampil.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID tidak ditentukan!');window.location.href='tampil.php';</script>";
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        body{
            background: linear-gradient(to right, rgb(164, 161, 161), white)
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1{
            text-align: center;
        }
        footer {
            background-color: #191919;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        footer a {
            color: #fff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
          <a class="navbar-brand" href="beranda.html">HappyKet.Net</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="beranda.html">Beranda</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="pesan.html">Pesan tiket</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="tampil.php">Lihat Pesanan</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="kontak.html">Kontak</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  <br>
<div class="container mt-5">
    <div class="content">
    <h1>Edit Tiket</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Liburan</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($data['tanggal']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
            <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="<?php echo htmlspecialchars($data['jumlah_peserta']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_hari" class="form-label">Jumlah Hari</label>
            <input type="number" class="form-control" id="jumlah_hari" name="jumlah_hari" value="<?php echo htmlspecialchars($data['jumlah_hari']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan Liburan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?php echo htmlspecialchars($data['tujuan']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="paket_perjalanan" class="form-label">Paket Pelayanan</label><br>
            <input type="radio" id="paket1" name="paket_perjalanan" value="standar" <?php echo $data['paket_perjalanan'] == 'standar' ? 'checked' : ''; ?>>
            <label for="paket1">Paket Standar - Rp 50.000</label><br>
            <input type="radio" id="paket2" name="paket_perjalanan" value="premium" <?php echo $data['paket_perjalanan'] == 'premium' ? 'checked' : ''; ?>>
            <label for="paket2">Paket Premium - Rp 100.000</label><br>
            <input type="radio" id="paket3" name="paket_perjalanan" value="VIP" <?php echo $data['paket_perjalanan'] == 'VIP' ? 'checked' : ''; ?>>
            <label for="paket3">Paket VIP - Rp 150.000</label>
        </div>
        <button type="submit" class="btn btn-dark" name="update">Update Tiket</button>
    </form>
</div>
</div>
<br>
<footer>
        <p>&copy; 2024 HappyKet.Net. All rights reserved.</p>
        <p>Follow us on:
            <a href="#">Facebook</a> 
            <a href="#">Twitter</a> 
            <a href="#">Instagram</a>
        </p>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
