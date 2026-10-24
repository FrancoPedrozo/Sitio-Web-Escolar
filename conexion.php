<?php
$host = "localhost";
$usuario = "root";
$clave = "";
$base_de_datos = "tecnica3";

$conexion = mysqli_connect($host, $usuario, $clave, $base_de_datos);

if (!$conexion) {
    die("Error de conexión local: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");

// Agregar esta función aquí para que la reconozcan los procesadores
if (!function_exists('registrarAccion')) {
    function registrarAccion($conexion, $accion) {
        $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Sistema';
        $id_usuario = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
        
        $stmt = $conexion->prepare("INSERT INTO historial_cambios (usuario, id_usuario, accion) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sis", $usuario, $id_usuario, $accion);
            $stmt->execute();
            $stmt->close();
        }
    }
}
?>