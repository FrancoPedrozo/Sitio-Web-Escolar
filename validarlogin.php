<?php
session_start();
include 'conexion.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];


$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql);

if ($fila = mysqli_fetch_assoc($resultado)) {
    if (password_verify($clave, $fila['Clave_usu'])) {
        
        $_SESSION['user_id'] = $fila['Id_usuario'];
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['tipo'] = $fila['Id_tipousu']; 
        $_SESSION['id_tipo'] = $fila['Id_tipousu']; 
        
        if ($_SESSION['tipo'] == 1) {
            header("Location: index.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        
        header("Location: iniciarsesion.php?error=datos_incorrectos");
        exit();
    }
} else {
   
    header("Location: iniciarsesion.php?error=datos_incorrectos");
    exit();
}
?>