<?php
// Controllers/ReservasControllers.php

require_once __DIR__ . '/../Model/ReservaModel.php';

class ReservasControllers {
    private $model;

    public function __construct() {
        $this->model = new ReservaModel();
    }

    public function listar($filtro = '') {
        return $this->model->obtenerReservas($filtro);
    }

    public function crearReserva() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $u = (int) $_POST['usuario_id'];
            $s = (int) $_POST['servicio_id'];
            $f = $_POST['fecha_reserva'];
            $e = $_POST['estado'];

            if ($this->model->crearReserva($u, $s, $f, $e)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error al crear reserva.";
            }
        }
    }

    public function datosParaEditar($id) {
        return $this->model->obtenerPorId($id);
    }

    public function editarReserva($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $u = (int) $_POST['usuario_id'];
            $s = (int) $_POST['servicio_id'];
            $f = $_POST['fecha_reserva'];
            $e = $_POST['estado'];

            if ($this->model->actualizarReserva($id, $u, $s, $f, $e)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error al actualizar reserva.";
            }
        }
    }

    public function eliminarReserva($id) {
        if ($this->model->eliminarReserva($id)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error al eliminar reserva.";
        }
    }
}
?>
