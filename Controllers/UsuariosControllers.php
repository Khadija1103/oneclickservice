<?php
// Controllers/UsuariosControllers.php

require_once __DIR__ . '/../Model/UsuarioModel.php';

class UsuariosControllers {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    // Listar
    public function listar() {
        return $this->model->obtenerUsuarios();
    }

    // Crear
    public function crearUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre    = trim($_POST['nombre']);
            $correo    = trim($_POST['correo']);
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

            if ($this->model->crearUsuario($nombre, $correo, $contrasena)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error al crear usuario.";
            }
        }
    }

    // Datos para editar
    public function datosParaEditar($id) {
        return $this->model->obtenerPorId($id);
    }

    // Editar
    public function editarUsuario($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);

            if ($this->model->actualizarUsuario($id, $nombre, $correo)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error al actualizar usuario.";
            }
        }
    }

    // Eliminar
    public function eliminarUsuario($id) {
        if ($this->model->eliminarUsuario($id)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error al eliminar usuario.";
        }
    }
}
