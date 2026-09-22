<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "tecnica3";

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function registrarAccion($conexion, $descripcion_accion) {
    // Tomamos el usuario de la sesión
    $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Administrador Anónimo';
    
    // Usamos consultas preparadas para mayor seguridad al registrar la acción
    $stmt = $conexion->prepare("INSERT INTO historial_cambios (usuario, accion) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $usuario, $descripcion_accion);
        $stmt->execute();
        $stmt->close();
    }
}
?>