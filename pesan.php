<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_tiket"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$nama = $_POST['nama'];
$email = $_POST['email'];
$tanggal = $_POST['tanggal'];
$jumlah_peserta = $_POST['jumlah_peserta'];
$jumlah_hari = $_POST['jumlah_hari'];
$tujuan = $_POST['tujuan'];
$paket_perjalanan = $_POST['paket_perjalanan'];
$harga_paket = array(
    'standar' => 50000,
    'premium' => 100000,
    'VIP' => 150000
);

$total_harga = $jumlah_peserta * $jumlah_hari * $harga_paket[$paket_perjalanan];

$sql = "INSERT INTO tiket (nama, email, tanggal, jumlah_peserta, jumlah_hari, tujuan, paket_perjalanan, total_harga) 
        VALUES ('$nama', '$email', '$tanggal', '$jumlah_peserta', '$jumlah_hari', '$tujuan', '$paket_perjalanan', '$total_harga')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Terimakasih Telah Memesan Jasa Kami');window.location.href='tampil.php';</script>";
    } else {
    echo "<script>alert('Error: " . $conn->error . "');window.location.href='tampil.php';</script>";
}
$conn->close();
?>
