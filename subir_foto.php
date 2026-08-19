<?php
session_start();
include("conexion.php");

// Validar que solo el administrador (id_tipo 1) pueda entrar a este panel
if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 1) {
    header("Location: iniciarsesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración | E.E.S.T. N°3</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <a href="index.php">Volver al sitio</a>
            <a href="cerrar_sesion.php">Cerrar Sesión</a>
        </nav>
    </header>

    <div class="container">
        <h3>Subir fotografía a Galería</h3>
        <form action="procesar_subida.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Seleccionar Categoría (Tarjeta)</label>
                <select name="categoria_id" required>
                    <option value="" disabled selected>Elige una tarjeta...</option>
                    <option value="1">1. Nuestra escuela</option>
                    <option value="2">2. Proyectos</option>
                    <option value="3">3. Talleres</option>
                    <option value="4">4. Prácticas Profesionales</option>
                    <option value="5">5. Laboratorios</option>
                    <option value="6">6. Eventos y Actos</option>
                </select>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" name="titulo" required placeholder="Título de la imagen">
            </div>
            <div class="form-group">
                <label>Seleccionar archivo (Máx. 10 fotos por tarjeta)</label>
                <input type="file" name="imagen" accept="image/*" required>
            </div>
            <button type="submit" class="btn-blue">Subir a Galería</button>
        </form>

        <hr>

        <h3>Actualizar Especialidades</h3>
        <form action="procesar_especialidad.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Especialidad</label>
                <select name="especialidad_id" required>
                    <?php
                    $query = mysqli_query($conexion, "SELECT id, nombre_especialidad FROM especialidades_img");
                    while($row = mysqli_fetch_assoc($query)) {
                        echo "<option value='".$row['id']."'>".$row['nombre_especialidad']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nueva Imagen</label>
                <input type="file" name="imagen" accept="image/*" required>
            </div>
            <button type="submit" class="btn-green">Actualizar Foto</button>
        </form>
    </div>

</body>
</html>