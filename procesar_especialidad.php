<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 1) {
    exit("Acceso denegado");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_especialidad = intval($_POST['especialidad_id']);
    
    $archivoNombre = $_FILES['imagen']['name'];
    $archivoTmp = $_FILES['imagen']['tmp_name'];
    $archivoError = $_FILES['imagen']['error'];
    
    if ($archivoError === 0) {
        $extension = pathinfo($archivoNombre, PATHINFO_EXTENSION);
        $nombreUnico = "esp_" . $id_especialidad . "_" . uniqid() . "." . $extension;
        $carpetaDestino = "uploads/";
        
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
        
        $rutaFinal = $carpetaDestino . $nombreUnico;
        
        if (move_uploaded_file($archivoTmp, $rutaFinal)) {
           
            $sql = "UPDATE especialidades_img SET imagen_ruta = '$rutaFinal' WHERE id = $id_especialidad";
            
            if (mysqli_query($conexion, $sql)) {
                header("Location: subir_foto.php?exito_esp=1");
                exit();
            } else {
                echo "Error al actualizar la base de datos: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al mover el archivo al servidor.";
        }
    } else {
        echo "Error en la subida del archivo.";
    }
}
?>