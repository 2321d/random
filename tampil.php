<?php
// Konfigurasi database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = "";     // Ganti dengan password database Anda
$dbname = "db_tiket"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data
$sql = "SELECT * FROM tiket";
$result = $conn->query($sql);

if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pemesanan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    footer {
            background-color: #191919;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
          <a class="navbar-brand" href="#">HappyKet.Net</a>
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
                      <a class="nav-link active" href="tampil.php">Lihat Pesanan</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="kontak.html">Kontak</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
<br>
<br>
<br>
<div class="container mt-5">
    <h1 class="mb-4">Data Pemesanan Tiket Liburan</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Tanggal Liburan</th>
                <th>Jumlah peserta</th>
                <th>Jumlah Hari</th>
                <th>Tujuan Liburan</th>
                <th>Paket Perjalanan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tanggal"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["jumlah_peserta"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["jumlah_hari"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tujuan"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row['paket_perjalanan']) . "</td>";
                    echo "<td>" . number_format($row["total_harga"], 0, ',', '.') . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . urlencode($row["id"]) . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete.php?id=" . urlencode($row["id"]) . "' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="text-end mt-4">
        <a class="btn btn-dark" href="pesan.html">Pesan Tiket Lagi</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<br><br><br><br><br><br><br><br><br><br><br>
<footer>
          <p>&copy; 2024 HappyKet.Net. All rights reserved.</p>
          <p>Follow us on:
              <a href="#" class="text-white">Facebook</a> |
              <a href="#" class="text-white">Twitter</a> |
              <a href="#" class="text-white">Instagram</a>
          </p>
        </footer>
</body>
</html>
<?php
// Tutup koneksi
$conn->close();
?>