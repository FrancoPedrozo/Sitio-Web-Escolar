<?php
session_start();
include("conexion.php");


if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 1) {
    header("Location: iniciarsesion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $categoria_id = intval($_POST['categoria_id']);
    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);

    
    $sql_conteo = "SELECT COUNT(*) as total FROM galeria_institucional WHERE categoria_id = $categoria_id";
    $resultado_conteo = mysqli_query($conexion, $sql_conteo);
    $fila = mysqli_fetch_assoc($resultado_conteo);

    if ($fila['total'] >= 10) {
        echo "<script>alert('Error: Esta tarjeta ya alcanzó el límite máximo de 10 fotos.'); window.history.back();</script>";
        exit;
    }

   
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $archivo_tmp = $_FILES['imagen']['tmp_name'];
        $nombre_archivo = 'img_' . uniqid() . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $carpeta_destino = 'uploads/';

        if (!file_exists($carpeta_destino)) {
            mkdir($carpeta_destino, 0777, true);
        }

        $ruta_final = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($archivo_tmp, $ruta_final)) {
            
            $sql = "INSERT INTO galeria_institucional (categoria_id, titulo, imagen_ruta) VALUES ($categoria_id, '$titulo', '$ruta_final')";
            
            if (mysqli_query($conexion, $sql)) {
                header("Location: subir_foto.php?exito=galeria");
                exit;
            } else {
                echo "Error al guardar en la base de datos: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al mover el archivo al servidor.";
        }
    } else {
        echo "No se ha seleccionado ninguna imagen válida.";
    }
}
?>