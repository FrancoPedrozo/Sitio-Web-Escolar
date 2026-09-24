<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
    
    <!-- Importación de fuentes desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&family=Montserrat:wght@400;500;600;700;800;900&family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <?php if (isset($extra_css)) echo $extra_css; ?>
    <style>
        * {
            box-sizing: border-box;
        }

        .bar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            height: 80px !important;
            padding: 0 12% !important;
            margin: 0 !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            background-color: rgba(0, 0, 0, 0.9) !important;
            z-index: 9999 !important;
            box-sizing: border-box !important;
        }

        .logo-container {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            text-decoration: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .logo-img {
            height: 52px !important;
            width: auto !important;
            object-fit: contain !important;
        }

        .logo-texto {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
        }

        .titulo-escuela {
            color: #ffffff !important;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 18px !important;
            font-weight: 800 !important;
            line-height: 1 !important;
            letter-spacing: 1px !important;
        }

        .seccion-texto {
            color: #3dff67 !important;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: 1px !important;
            text-transform: uppercase !important;
            margin-top: 3px !important;
        }

        .nav-right-container {
            display: flex !important;
            align-items: center !important;
            gap: 15px !important;
            z-index: 10002 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .btn-perfil {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 35px !important;
            height: 35px !important;
            text-decoration: none !important;
        }

        .btn-perfil img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
        }

        .btn-menu {
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            width: 35px !important;
            height: 24px !important;
            cursor: pointer !important;
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            z-index: 10003 !important;
        }

        .btn-menu span {
            display: block !important;
            width: 100% !important;
            height: 3px !important;
            background-color: #ffffff !important;
            border-radius: 3px !important;
            transition: all 0.3s ease-in-out !important;
            transform-origin: center !important;
        }

        .menu-checkbox {
            display: none !important;
        }

        .menu-checkbox:checked ~ .nav-right-container .btn-menu span:nth-child(1) {
            transform: translateY(10.5px) rotate(45deg) !important;
        }

        .menu-checkbox:checked ~ .nav-right-container .btn-menu span:nth-child(2) {
            opacity: 0 !important;
        }

        .menu-checkbox:checked ~ .nav-right-container .btn-menu span:nth-child(3) {
            transform: translateY(-10.5px) rotate(-45deg) !important;
        }

        .menu-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            background: rgba(0, 0, 0, 0.5) !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transition: all 0.3s ease !important;
            z-index: 9998 !important;
        }

        .menu-checkbox:checked ~ .menu-overlay {
            opacity: 1 !important;
            visibility: visible !important;
        }

        .nav-container {
            position: fixed !important;
            top: 0 !important;
            right: 0 !important;
            left: auto !important;
            width: 400px !important;
            max-width: 85vw !important;
            height: 100vh !important;
            background-color: #01182e !important;
            padding: 100px 25px 40px 25px !important;
            transform: translateX(100%) !important;
            transition: transform 0.3s ease-in-out !important;
            z-index: 10000 !important;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.6) !important;
            display: flex !important;
            flex-direction: column !important;
            overflow-y: auto !important;
        }

        .menu-checkbox:checked ~ .nav-container {
            transform: translateX(0) !important;
        }

        .nav-links {
            list-style: none !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        .nav-links li {
            width: 100% !important;
        }

        .nav-links a {
            color: #ffffff !important;
            text-decoration: none !important;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            line-height: 1.35 !important;
            letter-spacing: 1px !important;
            text-transform: uppercase !important;
            display: block !important;
            width: 100% !important;
            padding: 10px 12px !important;
            border-radius: 4px !important;
            border-left: 3px solid transparent !important;
            transition: all 0.2s ease !important;
            white-space: normal !important;
            word-break: break-word !important;
        }

        .nav-links a:hover {
            color: #3dff67 !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-left: 3px solid #3dff67 !important;
        }

        .nav-links a.active {
            color: #3dff67 !important;
            font-weight: bold !important;
            border-left: 3px solid #3dff67 !important;
        }

        .nav-links a.link-admin {
            color: #ffcc00 !important;
            font-weight: bold !important;
        }

        .nav-links a.link-admin:hover {
            color: #ffee66 !important;
            border-left: 3px solid #ffcc00 !important;
        }

        @media screen and (max-width: 600px) {
            .bar {
                height: 70px !important;
                padding: 0 4% !important;
            }

            .logo-img {
                height: 42px !important;
            }

            .titulo-escuela {
                font-size: 15px !important;
            }

            .seccion-texto {
                font-size: 10px !important;
            }

            .nav-container {
                width: 85% !important;
                max-width: 340px !important;
                padding: 85px 16px 30px 16px !important;
            }

            .nav-links {
                gap: 8px !important;
            }

            .nav-links a {
                font-size: 13.5px !important;
                letter-spacing: 0.5px !important;
                padding: 8px 10px !important;
            }
        }
    </style>
</head>
<body>

<header class="bar">
    <a href="index.php" class="logo-container">
        <img src="imgs/logo.png" alt="logo escuela" class="logo-img">
        <div class="logo-texto">
            <span class="titulo-escuela">E.E.S.T N°3</span>
            <span class="seccion-texto"><?php echo $nombre_seccion; ?></span>
        </div>
    </a>

    <input type="checkbox" id="menu-toggle" class="menu-checkbox">

    <div class="nav-right-container">
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="cerrar_sesion.php" class="btn-perfil">
                <img src="imgs/perfil.png" alt="Perfil">
            </a>
        <?php else: ?>
            <a href="iniciarsesion.php" class="btn-perfil">
                <img src="imgs/perfil.png" alt="Perfil">
            </a>
        <?php endif; ?>

        <label for="menu-toggle" class="btn-menu">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <label for="menu-toggle" class="menu-overlay"></label>

    <nav class="nav-container">
        <ul class="nav-links">
            <li><a href="index.php" class="<?php echo ($pagina_actual == 'index.php') ? 'active' : ''; ?>">INICIO</a></li>
            <li><a href="noticias.php" class="<?php echo (in_array($pagina_actual, ['noticias.php', 'editar_noticia.php'])) ? 'active' : ''; ?>">NOTICIAS</a></li>
            <li><a href="especialidades.php" class="<?php echo (in_array($pagina_actual, ['especialidades.php', 'ciclo_tecnico.php'])) ? 'active' : ''; ?>">CICLOS TÉCNICOS PROFESIONALES</a></li>
            <li><a href="ciclo_basico.php" class="<?php echo ($pagina_actual == 'ciclo_basico.php') ? 'active' : ''; ?>">CICLO BÁSICO</a></li>
            <li><a href="historia.php" class="<?php echo ($pagina_actual == 'historia.php') ? 'active' : ''; ?>">¿QUIÉNES SOMOS?</a></li>
            <li><a href="directivos.php" class="<?php echo (in_array($pagina_actual, ['directivos.php', 'gestionar_directivos.php'])) ? 'active' : ''; ?>">EQUIPO DE CONDUCCIÓN</a></li>
            
            <?php if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1): ?>
                <li><a href="historial.php" class="<?php echo ($pagina_actual == 'historial.php') ? 'active' : ''; ?>" style="color: #3dff67;">REGISTRO DE CAMBIOS</a></li>
                <li><a href="admin.php" class="link-admin">PANEL ADMIN</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>