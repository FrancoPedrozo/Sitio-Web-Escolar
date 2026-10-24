<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 1) {
    header("Location: iniciarsesion.php");
    exit();
}

$mensaje = "";

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
    <link rel="icon" href="imgs/logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&family=Montserrat:wght@500;600;700&family=Oswald:wght@600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            user-select: none;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1b1a1a;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background-color: rgba(17, 17, 17, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10%;
            z-index: 1000;
        }

        header h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 22px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-links a {
            font-family: 'Google Sans Flex', sans-serif;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
            background-color: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .nav-links a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .nav-links a.btn-logout {
            color: white;
            background-color: rgb(177, 19, 19);
        }


        .container {
            width: 100%;
            max-width: 680px;
            margin: 110px auto 50px auto;
            background-color: rgba(36, 35, 35, 0.65);
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 40px 35px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.7);
        }

        .alert-mensaje {
            background-color: rgba(61, 255, 103, 0.1);
            border: 1px solid #3dff67;
            color: #3dff67;
            padding: 14px 18px;
            border-radius: 8px;
            font-family: 'Google Sans Flex', sans-serif;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        h3 {
            font-family: 'Oswald', sans-serif;
            color: #3dff67;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h3::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 18px;
            background-color: #3dff67;
            border-radius: 2px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            font-family: 'Google Sans Flex', sans-serif;
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        input[type="text"], select, input[type="file"] {
            width: 100%;
            height: 46px;
            background-color: rgba(27, 26, 26, 0.8);
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            padding: 0 16px;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="file"] {
            padding: 8px 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        input[type="text"]:focus, select:focus, input[type="file"]:focus {
            border-color: #3dff67;
            box-shadow: 0 0 12px rgba(61, 255, 103, 0.2);
        }

        select option {
            background-color: #1b1a1a;
            color: #ffffff;
        }

        button {
            cursor: pointer;
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 8px;
            font-family: 'Google Sans Flex', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-top: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        button:active {
            transform: scale(0.98);
        }

        .btn-green {
            background-color: #3dff67;
            color: #1b1a1a;
        }

        .btn-green:hover {
            background-color: #ffffff;
            color: #000000;
        }

        .btn-blue {
            background-color: #00d2ff;
            color: #1b1a1a;
        }

        .btn-blue:hover {
            background-color: #ffffff;
            color: #000000;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.08);
            margin: 35px 0;
        }

        @media (max-width: 768px) {
            header {
                padding: 0 5%;
                height: auto;
                padding-top: 15px;
                padding-bottom: 15px;
                flex-direction: column;
                gap: 12px;
            }

            .container {
                margin-top: 140px;
                padding: 30px 20px;
                width: 92%;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            header h1 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Panel de Administración</h1>
        <div class="nav-links">
            <a href="index.php">Ver Inicio</a>
            <a href="noticias.php">Noticias</a>
            <a href="historial.php">Historial</a>
            <a href="cerrar_sesion.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <div class="container">
        <?php if (!empty($mensaje)): ?>
            <div class="alert-mensaje">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <h3 style="color: white;">Modificar Foto de Especialidad</h3>
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

            <button type="submit" name="actualizar_especialidad" class="btn-green">ACTUALIZAR ESPECIALIDAD</button>
        </form>

        <hr>

        <h3 style="color: white;">Subir Imagen a Galería Institucional</h3>
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

            <button type="submit" name="subir_galeria" class="btn-blue">SUBIR A LA GALERÍA</button>
        </form>
    </div>

</body>
</html>