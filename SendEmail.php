<?php
// Memuat file PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Pastikan Anda sudah menginstal PHPMailer menggunakan Composer

// Mengambil data JSON yang dikirim dari front-end
$data = json_decode(file_get_contents("php://input"), true);

// Memastikan data diterima dengan benar
$name = isset($data['name']) ? $data['name'] : '';
$email = isset($data['email']) ? $data['email'] : '';
$message = isset($data['message']) ? $data['message'] : '';

// Mengecek jika ada data yang kosong
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Semua field harus diisi.']);
    exit;
}

$mail = new PHPMailer(true);

try {
    // Pengaturan server SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-email@gmail.com'; // Ganti dengan email Anda
    $mail->Password   = 'your-email-password'; // Ganti dengan password atau App Password Anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Penerima
    $mail->setFrom('your-email@gmail.com', 'Nama Anda');  // Ganti dengan email Anda
    $mail->addAddress('recipient@example.com', 'Nama Penerima'); // Ganti dengan email penerima

    // Konten Email
    $mail->isHTML(true);
    $mail->Subject = 'Pesan dari: ' . $name;
    $mail->Body    = "<p><strong>Nama:</strong> $name</p>
                      <p><strong>Email:</strong> $email</p>
                      <p><strong>Pesan:</strong></p>
                      <p>$message</p>";
    $mail->AltBody = "Nama: $name\nEmail: $email\nPesan: $message";

    // Mengirim email
    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Pesan terkirim dengan sukses.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => "Pesan tidak dapat dikirim. Error: {$mail->ErrorInfo}"]);
}
?>
