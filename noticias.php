<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Noticias</title>
    <link rel="icon" href="imgs/logo.png">
    <link rel="stylesheet" href="noticias.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Oswald:wght@600&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="bar">
        <img src="imgs/logo.png" alt="logo escuela" class="logo-img">
        <input type="checkbox" id="menu-toggle" class="menu-checkbox">
        <label for="menu-toggle" class="menu-btn">
            <span></span><span></span><span></span>
        </label>
        <nav class="nav-container">
            <ul class="nav-links">
                <li><a href="index.php">INICIO</a></li>
                <span class="item">NOTICIAS</span>
                <li><a href="especialidades.php">ESPECIALIDADES</a></li>
                <li><a href="">HISTORIA</a></li>
                <li><a href="directivos.php">DIRECTIVOS</a></li>
                
                <!-- Botón condicional para Subir Noticia idéntico al de Subir Fotos -->
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li><a href="subir_noticia.php" style="color: #ffcc00; font-weight: bold;">SUBIR NOTICIA</a></li>
                <?php endif; ?>
            </ul>

            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="cerrar_sesion.php"><button class="btn-sesion">CERRAR SESIÓN</button></a>
            <?php else: ?>
                <a href="iniciarsesion.php"><button class="btn-sesion">INICIAR SESIÓN</button></a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="wallper">
        <div class="filtro"></div>
        <div class="titulo"><h1>NOTICIAS</h1></div>
    </div>

    <div class="noticias-container">
        <div class="noticias-header">
            <h1>Novedades Institucionales</h1>
            <p>Enterate de los últimos eventos, comunicados oficiales y actividades académicas.</p>
        </div>

        <div class="noticias-grid">
            <?php
            
            $resultado = $conexion->query("SELECT * FROM noticias ORDER BY Fecha_noticia DESC");
            if ($resultado && $resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
            ?>
            <div class="noticia-card">
                <div class="card-img-wrapper">
                    <div class="card-img" style="background-image: url('uploads/<?php echo $row['Foto_noticia']; ?>');"></div>
                </div>
                <div class="card-info">
                    <span class="fecha"><?php echo date('d \d\e F, Y - H:i', strtotime($row['Fecha_noticia'])); ?> hs</span>
                    <h3><?php echo $row['Titulo_noticia']; ?></h3>
                    <p><?php echo $row['Descripcion_noticia']; ?></p>
                </div>
            </div>
            <?php 
                }
            } else {
                echo '<p style="color: #888; grid-column: 1 / -1; text-align: center; padding: 40px;">No hay noticias cargadas todavía.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>