<?php
// Model/ProveedorModel.php

require_once __DIR__ . '/../conexion.php';

class ProveedorModel {
    public function crearProveedor($nombre, $correo, $telefono, $direccion, $tipo_servicio) {
        global $conn;
        $sql = "INSERT INTO proveedores (nombre, correo, telefono, direccion, tipo_servicio)
                VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $nombre, $correo, $telefono, $direccion, $tipo_servicio);
            $ok = $stmt->execute();
            $stmt->close();
            return $ok;
        }
        return false;
    }

    public function obtenerProveedores($filtro = '') {
        global $conn;
        if ($filtro !== '') {
            $sql = "SELECT * FROM proveedores WHERE nombre LIKE ? ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $like = "%{$filtro}%";
            $stmt->bind_param("s", $like);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        } else {
            return $conn->query("SELECT * FROM proveedores ORDER BY id DESC");
        }
    }

    public function obtenerPorId($id) {
        global $conn;
        $sql = "SELECT * FROM proveedores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res;
    }

    public function actualizarProveedor($id, $nombre, $correo, $telefono, $direccion, $tipo_servicio) {
        global $conn;
        $sql = "UPDATE proveedores
                SET nombre = ?, correo = ?, telefono = ?, direccion = ?, tipo_servicio = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $correo, $telefono, $direccion, $tipo_servicio, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function eliminarProveedor($id) {
        global $conn;
        $sql = "DELETE FROM proveedores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
