<?php
// Controllers/ServiciosControllers.php

require_once __DIR__ . '/../Model/ServicioModel.php';

class ServiciosControllers {
    private $model;

    public function __construct() {
        $this->model = new ServicioModel();
    }

    // Listar (devuelve mysqli_result)
    public function listar($filtro = '') {
        return $this->model->obtenerServicios($filtro);
    }

    // Crear servicio
    public function crearServicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $n = trim($_POST['nombre_servicio']);
            $d = trim($_POST['descripcion']);
            $p = (float)$_POST['precio'];
            $pid = (int)$_POST['proveedor_id'];

            if ($this->model->crearServicio($n, $d, $p, $pid)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error al crear servicio.";
            }
        }
    }

    // Obtener datos para editar
    public function datosParaEditar($id) {
        return $this->model->obtenerPorId($id);
    }

    // Editar servicio
    public function editarServicio($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $n = trim($_POST['nombre_servicio']);
            $d = trim($_POST['descripcion']);
            $p = (float)$_POST['precio'];
            $pid = (int)$_POST['proveedor_id'];

            if ($this->model->actualizarServicio($id, $n, $d, $p, $pid)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error al actualizar servicio.";
            }
        }
    }

    // Eliminar servicio
    public function eliminarServicio($id) {
        if ($this->model->eliminarServicio($id)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error al eliminar servicio.";
        }
    }
}
?>
