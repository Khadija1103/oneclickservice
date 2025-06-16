<?php
// Controllers/AuthController.php

require_once __DIR__ . '/../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre     = trim($_POST['nombre'] ?? '');
    $correo     = trim($_POST['correo'] ?? '');
    $rol        = trim($_POST['tipo_usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');

    if ($nombre && $correo && $rol && $contrasena) {
        // 🛡 Validar formato de correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo "⚠️ El correo ingresado no tiene un formato válido.";
            $conn->close();
            exit;
        }

        // 🛡 Validar si ya existe el correo
        $sqlVerificacion = "SELECT id FROM usuarios WHERE correo = ?";
        $stmtVerificacion = $conn->prepare($sqlVerificacion);
        if ($stmtVerificacion) {
            $stmtVerificacion->bind_param("s", $correo);
            $stmtVerificacion->execute();
            $stmtVerificacion->store_result();

            if ($stmtVerificacion->num_rows > 0) {
                echo "⚠️ El correo ya está registrado.";
                $stmtVerificacion->close();
                $conn->close();
                exit;
            }

            $stmtVerificacion->close();
        } else {
            echo "❌ Error al preparar la verificación de correo.";
            $conn->close();
            exit;
        }

        // ✔ Continuar con el registro si pasa validación
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $nombre, $correo, $contrasenaHash, $rol);

            if ($stmt->execute()) {
                header("Location: ../index.php?registro=ok");
                exit;
            } else {
                echo "❌ Error al registrar: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "❌ Error preparando consulta SQL.";
        }

        $conn->close();
    } else {
        echo "⚠️ Todos los campos son obligatorios.";
        $conn->close();
        exit;
    }
}
?>
