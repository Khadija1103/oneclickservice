<?php
// Controllers/AuthController.php

require_once __DIR__ . '/../conexion.php';
session_start();

class AuthController {
    public function iniciarSesion($correo, $contrasena) {
        global $conn;

        $correo = trim($correo);
        $contrasena = trim($contrasena);

        if (!$correo || !$contrasena) {
            echo "<p style='color:red;'>❌ Todos los campos son obligatorios.</p>";
            return;
        }

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            if (!$usuario['verificado']) {
                echo "<p style='color:orange;'>⚠️ Tu cuenta aún no está verificada. Revisa tu correo.</p>";
                return;
            }

            if (password_verify($contrasena, $usuario['contraseña'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol'];

                header("Location: ../dashboard.php");
                exit;
            } else {
                echo "<p style='color:red;'>❌ Contraseña incorrecta.</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ El usuario no existe.</p>";
        }

        $stmt->close();
    }
}
