<?php
require 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Ejecutamos el borrado usando la columna Id_noticia
   registrarAccion($conexion, "Eliminó la noticia con ID: $id");    
    $conexion->query("DELETE FROM noticias WHERE Id_noticia = $id");
}

header("Location: noticias.php");
exit();
?>