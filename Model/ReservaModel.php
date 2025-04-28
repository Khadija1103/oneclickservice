<?php
// Model/ReservaModel.php

require_once __DIR__ . '/../conexion.php';

class ReservaModel {
    public function crearReserva($usuario_id, $servicio_id, $fecha_reserva, $estado) {
        global $conn;
        $sql = "INSERT INTO reservas (usuario_id, servicio_id, fecha_reserva, estado)
                VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iiss", $usuario_id, $servicio_id, $fecha_reserva, $estado);
            $ok = $stmt->execute();
            $stmt->close();
            return $ok;
        }
        return false;
    }

    public function obtenerReservas($filtro = '') {
        global $conn;
        if ($filtro !== '') {
            $sql = "SELECT r.id, u.nombre AS cliente, s.nombre_servicio AS servicio, r.fecha_reserva, r.estado
                    FROM reservas r
                    JOIN usuarios u ON r.usuario_id = u.id
                    JOIN servicios s ON r.servicio_id = s.id
                    WHERE u.nombre LIKE ? OR s.nombre_servicio LIKE ?
                    ORDER BY r.id DESC";
            $stmt = $conn->prepare($sql);
            $like = "%{$filtro}%";
            $stmt->bind_param("ss", $like, $like);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        }
        return $conn->query(
            "SELECT r.id, u.nombre AS cliente, s.nombre_servicio AS servicio, r.fecha_reserva, r.estado
             FROM reservas r
             JOIN usuarios u ON r.usuario_id = u.id
             JOIN servicios s ON r.servicio_id = s.id
             ORDER BY r.id DESC"
        );
    }

    public function obtenerPorId($id) {
        global $conn;
        $sql = "SELECT * FROM reservas WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res;
    }

    public function actualizarReserva($id, $usuario_id, $servicio_id, $fecha_reserva, $estado) {
        global $conn;
        $sql = "UPDATE reservas
                SET usuario_id = ?, servicio_id = ?, fecha_reserva = ?, estado = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissi", $usuario_id, $servicio_id, $fecha_reserva, $estado, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function eliminarReserva($id) {
        global $conn;
        $sql = "DELETE FROM reservas WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
?>
