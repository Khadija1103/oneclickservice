<?php
// Model/UsuarioModel.php

require_once __DIR__ . '/../conexion.php';

class UsuarioModel {
    // 1) Crear
    public function crearUsuario($nombre, $correo, $contrasena) {
        global $conn;
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $nombre, $correo, $contrasena);
            $ok = $stmt->execute();
            $stmt->close();
            return $ok;
        }
        return false;
    }

    // 2) Listar (sin filtro, o podrías añadir búsqueda)
    public function obtenerUsuarios() {
        global $conn;
        return $conn->query("SELECT id, nombre, correo FROM usuarios ORDER BY id DESC");
    }

    // 3) Obtener por ID
    public function obtenerPorId($id) {
        global $conn;
        $sql = "SELECT id, nombre, correo FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $u = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $u;
    }

    // 4) Actualizar
    public function actualizarUsuario($id, $nombre, $correo) {
        global $conn;
        $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $correo, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    // 5) Eliminar
    public function eliminarUsuario($id) {
        global $conn;
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

