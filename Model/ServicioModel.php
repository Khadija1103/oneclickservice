<?php
// Model/ServicioModel.php

require_once __DIR__ . '/../conexion.php';

class ServicioModel {
    // 1. Crear servicio
    public function crearServicio($nombre, $descripcion, $precio, $proveedor_id) {
        global $conn;
        $sql = "INSERT INTO servicios (nombre_servicio, descripcion, precio, proveedor_id)
                VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $proveedor_id);
            $ok = $stmt->execute();
            $stmt->close();
            return $ok;
        }
        return false;
    }

    // 2. Listar servicios (con o sin búsqueda)
    public function obtenerServicios($filtro = '') {
        global $conn;
        if ($filtro !== '') {
            $sql = "SELECT s.id, s.nombre_servicio, s.descripcion, s.precio, p.nombre AS proveedor
                    FROM servicios s
                    JOIN proveedores p ON s.proveedor_id = p.id
                    WHERE s.nombre_servicio LIKE ? OR p.nombre LIKE ?
                    ORDER BY s.id DESC";
            $stmt = $conn->prepare($sql);
            $like = "%{$filtro}%";
            $stmt->bind_param("ss", $like, $like);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        } else {
            return $conn->query(
                "SELECT s.id, s.nombre_servicio, s.descripcion, s.precio, p.nombre AS proveedor
                 FROM servicios s
                 JOIN proveedores p ON s.proveedor_id = p.id
                 ORDER BY s.id DESC"
            );
        }
    }

    // 3. Obtener un servicio por ID
    public function obtenerPorId($id) {
        global $conn;
        $sql = "SELECT * FROM servicios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res;
    }

    // 4. Actualizar servicio
    public function actualizarServicio($id, $nombre, $descripcion, $precio, $proveedor_id) {
        global $conn;
        $sql = "UPDATE servicios
                SET nombre_servicio = ?, descripcion = ?, precio = ?, proveedor_id = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $proveedor_id, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    // 5. Eliminar servicio
    public function eliminarServicio($id) {
        global $conn;
        $sql = "DELETE FROM servicios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
?>
