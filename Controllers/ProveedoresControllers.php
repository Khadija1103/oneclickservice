<?php
// Controllers/ProveedoresControllers.php

require_once __DIR__ . '/../Model/ProveedorModel.php';

class ProveedoresControllers {
    private $model;

    public function __construct() {
        $this->model = new ProveedorModel();
    }

    // ESTE método debe llamarse crearProveedor() para que coincida con la vista
    public function crearProveedor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre        = trim($_POST['nombre']);
            $correo        = trim($_POST['correo']);
            $telefono      = trim($_POST['telefono']);
            $direccion     = trim($_POST['direccion']);
            $tipo_servicio = trim($_POST['tipo_servicio']);

            if (!$nombre || !$correo || !$telefono || !$direccion || !$tipo_servicio) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            if ($this->model->crearProveedor($nombre, $correo, $telefono, $direccion, $tipo_servicio)) {
                header('Location: ../index.php');
                exit;
            } else {
                echo "Error al crear proveedor.";
            }
        }
    }

    public function listar($filtro = '') {
        return $this->model->obtenerProveedores($filtro);
    }

    public function datosParaEditar($id) {
        return $this->model->obtenerPorId($id);
    }

    public function editarProveedor($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->actualizarProveedor(
                $id,
                trim($_POST['nombre']),
                trim($_POST['correo']),
                trim($_POST['telefono']),
                trim($_POST['direccion']),
                trim($_POST['tipo_servicio'])
            );
            header('Location: ../index.php');
            exit;
        }
    }

    public function eliminarProveedor($id) {
        $this->model->eliminarProveedor($id);
        header('Location: ../index.php');
        exit;
    }
}


