<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    
    $fecha_hora = date('Y-m-d H:i:s');
    $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : (isset($_SESSION['id']) ? $_SESSION['id'] : 1);

    $nombre_foto = $_FILES['foto']['name'];
    $ruta_temporal = $_FILES['foto']['tmp_name'];
    $ruta_destino = "uploads/" . $nombre_foto;

    if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
        $stmt = $conexion->prepare("INSERT INTO noticias (Titulo_noticia, Descripcion_noticia, Foto_noticia, Fecha_noticia, Id_usuario) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $titulo, $descripcion, $nombre_foto, $fecha_hora, $id_usuario);
        
        if ($stmt->execute()) {
            registrarAccion($conexion, "Creó una nueva noticia titulada: '$titulo'");
            header("Location: noticias.php");
            exit();
        } else {
            echo "Error al guardar en la base de datos.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>