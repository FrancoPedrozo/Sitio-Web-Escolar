<?php
include 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $clave_plana = $_POST['clave'];
    
    
    $clave_hash = password_hash($clave_plana, PASSWORD_DEFAULT);
    
   $id_tipo = 2;

    $sql = "INSERT INTO usuarios (usuario, Correo_usu, Clave_usu, Id_tipousu) 
            VALUES ('$usuario', '$correo', '$clave_hash', '$id_tipo')";

    if (mysqli_query($conexion, $sql)) {
header("Location: iniciarsesion.php");  
exit();
} else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>