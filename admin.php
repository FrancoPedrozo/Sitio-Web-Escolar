<?php
session_start();
include("conexion.php");

// Validar que sea administrador (id_tipo == 1)
if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 1) {
    header("Location: iniciarsesion.php");
    exit();
}

$mensaje = "";

// 1. Lógica para actualizar la imagen de una especialidad
if (isset($_POST['actualizar_especialidad'])) {
    $id_esp = intval($_POST['id_especialidad']);
    
    if (isset($_FILES['nueva_imagen_esp']) && $_FILES['nueva_imagen_esp']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['nueva_imagen_esp']['tmp_name'];
        $fileName = $_FILES['nueva_imagen_esp']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = 'esp_' . $id_esp . '_' . uniqid() . '.' . $fileExtension;
            $uploadFileDir = 'uploads/';
            
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            
            $dest_path = $uploadFileDir . $newFileName;
            
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $stmt = $conexion->prepare("UPDATE especialidades_img SET imagen_ruta = ? WHERE id = ?");
                $stmt->bind_param("si", $dest_path, $id_esp);
                if ($stmt->execute()) {
                    $mensaje = "¡Imagen de especialidad actualizada con éxito!";
                } else {
                    $mensaje = "Error al actualizar la base de datos.";
                }
                $stmt->close();
            } else {
                $mensaje = "Error al mover el archivo subido.";
            }
        } else {
            $mensaje = "Formato de imagen no permitido (solo JPG, PNG, WEBP).";
        }
    } else {
        $mensaje = "Por favor, seleccione una imagen válida para la especialidad.";
    }
}

// 2. Lógica para subir una nueva foto a la galería institucional
if (isset($_POST['subir_galeria'])) {
    $titulo = trim($_POST['titulo_galeria']);
    $categoria_id = intval($_POST['categoria_id']);
    $fecha_subida = date('Y-m-d H:i:s');
    
    if (!empty($titulo) && isset($_FILES['imagen_galeria']) && $_FILES['imagen_galeria']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagen_galeria']['tmp_name'];
        $fileName = $_FILES['imagen_galeria']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = 'img_' . uniqid() . '.' . $fileExtension;
            $uploadFileDir = 'uploads/';
            
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            
            $dest_path = $uploadFileDir . $newFileName;
            
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $stmt = $conexion->prepare("INSERT INTO galeria_institucional (titulo, imagen_ruta, fecha_subida, categoria_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $titulo, $dest_path, $fecha_subida, $categoria_id);
                if ($stmt->execute()) {
                    $mensaje = "¡Foto agregada a la galería institucional con éxito!";
                } else {
                    $mensaje = "Error al registrar la foto en la base de datos.";
                }
                $stmt->close();
            } else {
                $mensaje = "Error al mover el archivo de la galería.";
            }
        } else {
            $mensaje = "Formato de imagen no permitido.";
        }
    } else {
        $mensaje = "Complete todos los campos de la galería y seleccione una imagen.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - E.E.S.T N°3</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <header>
        <h1>Panel de Administración</h1>
        <div>
            <a href="index.php">Ver Sitio</a>
            <a href="directivos.php">Directivos</a>
            <a href="cerrar_sesion.php" style="color: var(--accent-green);">Cerrar Sesión</a>
        </div>
    </header>

    <div class="container">
        <?php if (!empty($mensaje)): ?>
            <div style="background-color: var(--input-bg); border-left: 4px solid var(--accent-green); padding: 12px; margin-bottom: 20px; border-radius: 4px;">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <!-- SECCIÓN 1: MODIFICAR FOTOS DE ESPECIALIDADES -->
        <h3>Modificar Foto de Especialidad</h3>
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_especialidad">Seleccionar Especialidad:</label>
                <select name="id_especialidad" id="id_especialidad" required>
                    <option value="">-- Elija una especialidad --</option>
                    <?php
                    $res_esp = mysqli_query($conexion, "SELECT id, nombre_especialidad FROM especialidades_img");
                    while ($row_esp = mysqli_fetch_assoc($res_esp)) {
                        echo '<option value="' . $row_esp['id'] . '">' . htmlspecialchars($row_esp['nombre_especialidad']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nueva_imagen_esp">Nueva Imagen (JPG, PNG, WEBP):</label>
                <input type="file" name="nueva_imagen_esp" id="nueva_imagen_esp" accept="image/*" required>
            </div>

            <button type="submit" name="actualizar_especialidad" class="btn-green">Actualizar Especialidad</button>
        </form>

        <hr>

        <!-- SECCIÓN 2: AGREGAR FOTOS A LA GALERÍA INSTITUCIONAL -->
        <h3>Subir Imagen a Galería Institucional</h3>
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo_galeria">Título de la Imagen:</label>
                <input type="text" name="titulo_galeria" id="titulo_galeria" placeholder="Ej: Nuestra escuela 8" required>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select name="categoria_id" id="categoria_id" required>
                    <option value="1">1 - Nuestra Escuela</option>
                    <option value="2">2 - Proyectos</option>
                    <option value="3">3 - Talleres</option>
                </select>
            </div>

            <div class="form-group">
                <label for="imagen_galeria">Archivo de Imagen:</label>
                <input type="file" name="imagen_galeria" id="imagen_galeria" accept="image/*" required>
            </div>

            <button type="submit" name="subir_galeria" class="btn-blue">Subir a la Galería</button>
        </form>
    </div>

</body>
</html>