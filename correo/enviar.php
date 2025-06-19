<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function enviarCorreoRecuperacion($correo, $nombre, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tatianamarrugo1103@gmail.com';
        $mail->Password   = 'gcpdqxdmbjwhondx'; // Contraseña de aplicación Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Opciones para entorno local (ignora certificado autofirmado)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->setFrom('tatianamarrugo1103@gmail.com', 'ONE CLICK SERVICE');
        $mail->addAddress($correo, $nombre);

        $mail->isHTML(true);
        $mail->Subject = 'Restablece tu contraseña';
        $mail->Body = "
            <h3>Hola, $nombre</h3>
            <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
            <p><a href='http://localhost/oneclickservice-master/auth/nueva_contrasena.php?token=$token'>Haz clic aquí para crear una nueva contraseña</a></p>
            <p>Si no solicitaste este cambio, simplemente ignora este mensaje.</p>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Puedes habilitar esto para depuración si lo necesitas
        // echo "Error al enviar correo: {$mail->ErrorInfo}";
        return false;
    }
}
