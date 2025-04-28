<?php
// View/usuarios/eliminar.php

require_once __DIR__ . '/../../Controllers/UsuariosControllers.php';
$ctrl = new UsuariosControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { 
  echo "ID inválido."; 
  exit; 
}

$ctrl->eliminarUsuario($id);

// Después de eliminar, redirigir automáticamente
header("Location: index.php?eliminado=1");
exit;
?>

