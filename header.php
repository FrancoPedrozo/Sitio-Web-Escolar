<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtener el nombre del archivo actual para definir el texto verde de la sección activa
$pagina_actual = basename($_SERVER['PHP_SELF']);
$nombre_seccion = "INICIO";

switch ($pagina_actual) {
    case 'noticias.php':
    case 'editar_noticia.php':
        $nombre_seccion = "NOTICIAS";
        break;
    case 'especialidades.php':
    case 'ciclo_tecnico.php':
        $nombre_seccion = "CICLOS TÉCNICOS PROFESIONALES";
        break;
    case 'ciclo_basico.php':
        $nombre_seccion = "CICLO BÁSICO";
        break;
    case 'historia.php':
        $nombre_seccion = "¿QUIÉNES SOMOS?";
        break;
    case 'directivos.php':
    case 'gestionar_directivos.php':
        $nombre_seccion = "EQUIPO DE CONDUCCIÓN";
        break;
    case 'historial.php':
        $nombre_seccion = "REGISTRO DE CAMBIOS";
        break;
    case 'admin.php':
        $nombre_seccion = "PANEL ADMIN";
        break;
    case 'iniciarsesion.php':
        $nombre_seccion = "LOGIN";
        break;
    case 'crearcuenta.php':
        $nombre_seccion = "REGISTRO";
        break;
    default:
        $nombre_seccion = "INICIO";
        break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "E.E.S.T N°3"; ?></title>
    <link rel="icon" href="imgs/logo.png">
    <link rel="stylesheet" href="style.css">
    <?php if (isset($extra_css)) echo $extra_css; ?>
    <style>
        .bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            padding: 0 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(8px);
            z-index: 9999;
        }

        .logo-img {
            height: 55px;
            width: auto;
            object-fit: contain;
        }

        .nav-right-container {
            display: flex;
            align-items: center;
            gap: 20px;
            z-index: 10001;
        }

        .seccion-indicador {
            color: #3dff67;
            font-family: 'Oswald', sans-serif;
            font-size: 16px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Botón de Hamburguesa / X */
        .menu-btn {
            display: flex;
            cursor: pointer;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            gap: 5px;
            z-index: 10002;
        }

        .menu-btn span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            border-radius: 2px;
            transition: all 0.3s ease;
            transform-origin: center;
        }

        /* Transición a 'X' cuando el menú está abierto */
        .menu-checkbox:checked ~ .nav-right-container .menu-btn span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .menu-checkbox:checked ~ .nav-right-container .menu-btn span:nth-child(2) {
            opacity: 0;
        }

        .menu-checkbox:checked ~ .nav-right-container .menu-btn span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        /* Botón de Sesión */
        .btn-sesion-header {
            cursor: pointer;
            height: 40px; 
            padding: 0 20px; 
            background-color: #01203c;
            color: white !important;
            border: 2px solid #01203c;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-sesion-header:hover {
            background-color: #3dff67;
            color: #1b1a1a !important;
            border-color: #3dff67;
            box-shadow: 0 0 12px rgba(61, 255, 103, 0.4);
        }

        /* Desplegable que cubre toda la pantalla */
        .nav-container {
            position: fixed;
            top: -100vh;
            left: 0;
            width: 100%;
            background-color: #01182e;
            padding: 100px 20px 40px 20px;
            transition: top 0.4s ease-in-out;
            z-index: 10000;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .menu-checkbox:checked ~ .nav-container {
            top: 0;
        }

        .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
            padding: 0;
            margin: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-family: 'Oswald', sans-serif;
            font-size: 18px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: #3dff67;
        }

        .nav-links a.link-admin {
            color: #ffcc00;
            font-weight: bold;
        }

        .nav-links a.link-admin:hover {
            color: #ffee66;
        }
    </style>
</head>
<body>

<header class="bar">
    <!-- Logo a la izquierda -->
    <a href="index.php">
        <img src="imgs/logo.png" alt="logo escuela" class="logo-img">
    </a>

    <!-- Input invisible para toggle del menú -->
    <input type="checkbox" id="menu-toggle" class="menu-checkbox" style="display: none;">

    <!-- Bloque de elementos alineados a la derecha -->
    <div class="nav-right-container">
        <!-- 1. Nombre de la sección actual (en verde) -->
        <span class="seccion-indicador"><?php echo $nombre_seccion; ?></span>

        <!-- 2. Botón de menú que cambia a 'X' -->
        <label for="menu-toggle" class="menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <!-- 3. Botón bien a la derecha -->
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="cerrar_sesion.php" class="btn-sesion-header">CERRAR SESIÓN</a>
        <?php else: ?>
            <a href="iniciarsesion.php" class="btn-sesion-header">INICIAR SESIÓN</a>
        <?php endif; ?>
    </div>

    <!-- Menú desplegable completo -->
    <nav class="nav-container">
        <ul class="nav-links">
            <li><a href="index.php">INICIO</a></li>
            <li><a href="noticias.php">NOTICIAS</a></li>
            <li><a href="especialidades.php">CICLOS TÉCNICOS PROFESIONALES</a></li>
            <li><a href="ciclo_basico.php">CICLO BÁSICO</a></li>
            <li><a href="historia.php">¿QUIÉNES SOMOS?</a></li>
            <li><a href="directivos.php">EQUIPO DE CONDUCCIÓN</a></li>
            
            <?php if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1): ?>
                <li><a href="historial.php" style="color: #3dff67;">REGISTRO DE CAMBIOS</a></li>
                <li><a href="admin.php" class="link-admin">PANEL ADMIN</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>   