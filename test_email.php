<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tatianamarrugo1103@gmail.com';
    $mail->Password   = 'gcpdqxdmbjwhondx';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Remitente: debe coincidir con el Username
    $mail->setFrom('tatianamarrugo1103@gmail.com', 'One Click');

    // Destinatario real
    $mail->addAddress('barakacorporacion@gmail.com');

    $mail->Subject = 'Correo de prueba';
    $mail->Body    = 'Esto es un mensaje de prueba desde XAMPP';

    $mail->send();
    echo "✅ Correo enviado correctamente.";
} catch (Exception $e) {
    echo "❌ Error: {$mail->ErrorInfo}";
}
