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
// Tentukan harga per tiket (misalnya Rp 500.000 per tiket)

$harga_paket = array(
    'standar' => 200000,
    'premium' => 400000,
    'VIP' => 600000
);


// Handle Edit Form Submission
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

// Get the record to edit
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
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">HappyKet.Net</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="beranda.html">Beranda</a>
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
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="container mt-5">
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
            <label for="paket1">Paket Standar - Rp 200.000</label><br>
            <input type="radio" id="paket2" name="paket_perjalanan" value="premium" <?php echo $data['paket_perjalanan'] == 'premium' ? 'checked' : ''; ?>>
            <label for="paket2">Paket Premium - Rp 400.000</label><br>
            <input type="radio" id="paket3" name="paket_perjalanan" value="VIP" <?php echo $data['paket_perjalanan'] == 'VIP' ? 'checked' : ''; ?>>
            <label for="paket3">Paket VIP - Rp 600.000</label>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update Tiket</button>
    </form>
</div>
<br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Tutup koneksi
$conn->close();
?>
