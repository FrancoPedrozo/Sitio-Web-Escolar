<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Subir Noticia</title>
    <link rel="icon" href="imgs/logo.png">
    <link rel="stylesheet" href="noticias.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
        }
        .form-container {
            max-width: 650px;
            
            margin: 110px auto 50px auto; 
            background: #181818;
            padding: 35px;
            border-radius: 12px;
            border: 1px solid #333;
            box-shadow: 0 10px 25px rgba(0,0,0,0.6);
        }
        .form-container h2 {
            color: #fff;
            font-family: 'Oswald', sans-serif;
            margin-bottom: 25px;
            text-align: center;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            color: #bbb;
            margin-bottom: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
        }
        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px;
            background: #222;
            border: 1px solid #444;
            color: #fff;
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
            height: 140px;
        }
        .btn-enviar {
            background-color: #00ff00;
            color: #000;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }
        .btn-enviar:hover {
            background-color: #00cc00;
        }
    </style>
</head>
<body>
     <header class="bar">
        <img src="imgs/logo.png" alt="logo escuela" class="logo-img">
        
        <input type="checkbox" id="menu-toggle" class="menu-checkbox">
        <label for="menu-toggle" class="menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav class="nav-container">
            <ul class="nav-links">
                <li><a href="index.php#link-contacto">CONTACTO</a></li>
                <li><a href="noticias.php">NOTICIAS</a></li>
                <li><a href="especialidades.php">CICLOS TECNICOS PROFESIONALES</a></li>
                <li><a href="historia.php">¿QUIENES SOMOS?</a></li>
                <li><a href="directivos.php">EQUIPO DE CONDUCCION</a></li>
                
                <?php 
                if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1) {
                    echo '<li><a href="subir_noticia.php" style="color: #ffcc00; font-weight: bold;">PANEL ADMIN</a></li>';
                }
                ?>
            </ul>

            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="cerrar_sesion.php"><button class="btn-sesion">CERRAR SESIÓN</button></a>
            <?php else: ?>
                <a href="iniciarsesion.php"><button class="btn-sesion">INICIAR SESIÓN</button></a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="form-container">
        <h2>PANEL DE ADMINISTRACIÓN - SUBIR NOTICIA</h2>
        <form action="procesar_noticia.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Título de la noticia:</label>
                <input type="text" name="titulo" placeholder="Ej: Nueva tecnología en laboratorios" required>
            </div>
            <div class="form-group">
                <label>Descripción detallada:</label>
                <textarea name="descripcion" placeholder="Escribe el cuerpo de la novedad institucional..." required></textarea>
            </div>
            <div class="form-group">
                <label>Imagen ilustrativa:</label>
                <input type="file" name="foto" required>
            </div>
            <button type="submit" class="btn-enviar">Publicar Noticia</button>
        </form>
    </div>
</body>
</html>