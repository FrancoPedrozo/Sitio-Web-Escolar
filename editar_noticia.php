<?php
session_start();
require 'conexion.php';

// Validar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener los datos actuales de la noticia
$stmt = $conexion->prepare("SELECT * FROM noticias WHERE Id_noticia = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$noticia = $resultado->fetch_assoc();

if (!$noticia) {
    header("Location: noticias.php");
    exit();
}

// Procesar la actualización al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $nombre_foto = $noticia['Foto_noticia']; // Mantener la foto actual por defecto

    // Si se subió una nueva imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nombre_foto = $_FILES['foto']['name'];
        $ruta_temporal = $_FILES['foto']['tmp_name'];
        $ruta_destino = "uploads/" . $nombre_foto;
        move_uploaded_file($ruta_temporal, $ruta_destino);
    }

    $stmt_update = $conexion->prepare("UPDATE noticias SET Titulo_noticia = ?, Descripcion_noticia = ?, Foto_noticia = ? WHERE Id_noticia = ?");
    $stmt_update->bind_param("sssi", $titulo, $descripcion, $nombre_foto, $id);

    if ($stmt_update->execute()) {
        // Registrar acción en el historial de cambios
        if (function_exists('registrarAccion')) {
            registrarAccion($conexion, "Editó la noticia con ID: $id (Título: '$titulo')");
        }
        header("Location: noticias.php");
        exit();
    }
}

$page_title = "Editar Noticia";
include 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-container {
            width: 100%;
            max-width: 550px;
            margin: 100px auto 40px auto;
            padding: 0 20px;
        }

        .card-form {
            background-color: #222222;
            border-radius: 12px;
            padding: 35px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .card-form h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 28px;
            text-align: center;
            margin-bottom: 25px;
            color: #ffffff;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #dddddd;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            background-color: #181818;
            border: 1px solid #333333;
            border-radius: 6px;
            color: #ffffff;
            font-size: 14px;
            font-family: inherit;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #3dff67;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 110px;
        }

        .preview-img-container {
            margin-top: 5px;
            margin-bottom: 12px;
        }

        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #444;
        }

        .btn-guardar {
            width: 100%;
            padding: 14px;
            background-color: #3dff67;
            color: #121212;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-guardar:hover {
            background-color: #32e057;
        }

        .btn-guardar:active {
            transform: scale(0.99);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #aaaaaa;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="card-form">
        <h1>Editar Noticia</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="titulo">Título de la Noticia:</label>
                <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo htmlspecialchars($noticia['Titulo_noticia']); ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control" required><?php echo htmlspecialchars($noticia['Descripcion_noticia']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Imagen Actual:</label>
                <div class="preview-img-container">
                    <img src="uploads/<?php echo htmlspecialchars($noticia['Foto_noticia']); ?>" alt="Foto actual" class="preview-img">
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Cambiar Imagen (Opcional):</label>
                <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn-guardar">Guardar Cambios</button>
            <a href="noticias.php" class="back-link">← Volver a Noticias</a>
            
        </form>
    </div>
</div>

</body>
</html>