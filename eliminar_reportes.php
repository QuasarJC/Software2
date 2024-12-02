<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once "conexion.php";

$id = intval($_GET['id']);

$sql_delete = "DELETE FROM reportes WHERE id = $id";

if ($conexion->query($sql_delete) === TRUE) {
    header("Location: ver reportes.php");
    exit();
} else {
    echo "Error al eliminar el reporte: " . $conexion->error;
}
?>