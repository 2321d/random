<?php
// Mengambil data dari formulir
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validasi data
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    die('Semua kolom harus diisi.');
}

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Alamat email tidak valid.');
}

// Pengaturan email
$to = 'drackojunaidi@gmail.com'; // Ganti dengan email tujuan Anda
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Mengirim email
$mail_sent = mail($to, $subject, $message, $headers);

// Cek apakah email berhasil dikirim
if ($mail_sent) {
    echo '<p>Email Anda telah dikirim. Terima kasih!</p>';
} else {
    echo '<p>Terjadi kesalahan saat mengirim email. Silakan coba lagi nanti.</p>';
}
?>
