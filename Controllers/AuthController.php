<?php
// Controllers/AuthController.php

require_once __DIR__ . '/../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre     = $_POST['nombre'] ?? '';
    $correo     = $_POST['correo'] ?? '';
    $rol        = $_POST['tipo_usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if ($nombre && $correo && $rol && $contrasena) {
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
    }
}

