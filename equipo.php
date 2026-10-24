<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexion.php';

$sesionIniciada = isset($_SESSION['usuario']) || isset($_SESSION['id']);
$es_admin = isset($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 | Equipo De Conducción</title>
    <link rel="icon" href="imgs/logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&family=Montserrat:wght@400;500;600;700;800&family=Oswald:wght@700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: inherit;
            user-select: none;
        }
        body {
            min-height: 100vh;
            background-color: #121518;
            font-family: 'Montserrat', sans-serif;
        }
        .check-menu, .check-creditos {
            display: none;
        }
        nav {
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            height: 9%;
            width: 100%;
            padding: 0 16%;
            background-color: rgba(0, 0, 0, 0);
            animation: fijarBarra linear both;
            animation-timeline: scroll(root);
            animation-range: 0px 300px;
            z-index: 999;
        }
        @keyframes fijarBarra {
            from {
                background-color: rgba(0, 0, 0, 0);
                padding: 0 16%;
            }
            to {
                background-color: black; 
                padding: 0 14%;
            }
        }
        .logo-seccion {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 15px;
            height: 100%;
        }
        .logo, .seccion {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .seccion {
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            font-style: normal;
            align-items: flex-start;
        }
        .seccion h1 {
            color: white;
            font-size: 18px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }
        .seccion p {
            color: #3dff67;
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: 1px;
        }
        .logo a {
            display: flex;
            align-items: center;
            height: 100%;
            width: auto;
        }
        .logo img {
            height: 60%;
            width: auto;
        }
        .login-opc {
            display: flex;
            align-items: center;
            gap: 20px;
            height: 100%;
        }
        .login {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }
        .login a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        .login img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: pointer;
        }
        .menu-btn {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 32px;
            height: 32px;
            cursor: pointer;
            padding: 4px 0;
        }
        .menu-btn .linea {
            width: 100%;
            height: 3px;
            background-color: white;
            border-radius: 2px;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            cursor: default;
        }
        .menu-lateral {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: #111;
            z-index: 1000;
            transition: right 0.3s ease;
            padding: 60px 30px;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
        }
        .cerrar-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }
        .menu-lateral ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
            font-family: 'Montserrat', sans-serif;
        }
        .menu-lateral ul li {
            display: flex;
        }
        .menu-lateral ul li a,
        .btn-menu-creditos {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.35;
            transition: color 0.2s ease, border-color 0.2s ease;
            display: inline-block;
            border-bottom: 2px solid transparent;
            padding-bottom: 5px;
            cursor: pointer;
            word-break: break-word;
            white-space: normal;
            letter-spacing: 1px;
        }
        .menu-lateral ul li a:hover {
            color: #3dff67;
            border-bottom: 2px solid #3dff67;
        }
        .btn-menu-creditos:hover {
            color: #3dff67;
        }
        .menu-lateral ul li .activo {
            color: #3dff67;
            font-size: 18px;
            font-weight: 700;
            cursor: default;
            display: inline-block;
            border-bottom: 2px solid #3dff67;
            padding-bottom: 5px;
        }
        .check-menu:checked ~ .overlay {
            opacity: 1;
            visibility: visible;
        }
        .check-menu:checked ~ .menu-lateral {
            right: 0;
        }
        @media (max-width: 768px) {
            nav {
                padding: 0 6%;
            }
            @keyframes fijarBarra {
                from {
                    background-color: rgba(0, 0, 0, 0);
                    padding: 0 6%; 
                }
                to {
                    background-color: black; 
                    padding: 0 4%; 
                }
            }
            .seccion h1 {
                font-size: 15px;
            }
            .seccion p {
                font-size: 12px;
            }
            .menu-lateral {
                width: 250px;
                right: -250px;
            }
        }
        .wallper {
            position: relative;
            height: 60vh;
            width: 100%;
            background-image: url(imgs/wallper5.png); 
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            z-index: 1;
            display: flex;
            flex-direction: column;
        }
        .filtro {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(to bottom, #1a5b0b79, #01203cd8);
            z-index: 2;
        }
        .titulo {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex-grow: 1;
            padding-left: 11%;
            padding-right: 11%;
            z-index: 3;
            color: white;
        }
        .titulo h1 {
            font-family: "Oswald", sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800;
            font-style: italic;
            letter-spacing: 1px;
            line-height: 1.1;
        }
        .creditos {
            position: absolute;
            bottom: 20px;
            right: 5%;
            z-index: 4;
            font-family: "Google Sans Flex", sans-serif;
        }
        .creditos label {
            font-size: 13px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 1.3px;
            text-transform: uppercase;
            transition: color 0.4s cubic-bezier(0.25, 1, 0.5, 1), text-shadow 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            background-color: transparent;
            outline: none;
            border: none;
            cursor: pointer;
        }
        .creditos label:hover {
            color: #3dff67;
            text-shadow: 0 0 8px rgba(61, 255, 103, 0.6);
        }
        @media (max-width: 768px) {
            .creditos {
                right: 0;
                left: 0;
                bottom: 10px;
                text-align: center;
            }
            
            .creditos span {
                font-size: 9px;
                letter-spacing: 0.5px;
            }
        }
        .creditos-pantalla {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1001;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
        }
        .fondo-creditos {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            cursor: default;
        }
        .pantalla {
            position: relative;
            width: 90%;
            max-width: 500px;
            background-color: #111;
            border: 1px solid #3dff67;
            border-radius: 8px;
            padding: 30px 25px;
            z-index: 1002;
            box-shadow: 0 0 20px rgba(61, 255, 103, 0.2);
            font-family: 'Montserrat', sans-serif;
            color: white;
        }
        .cerrar-creditos {
            position: absolute;
            top: 15px;
            right: 20px;
            color: white;
            font-size: 28px;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s ease;
        }
        .cerrar-creditos:hover {
            color: #3dff67;
        }
        .pantalla h2 {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
            text-align: center;
        }
        .pantalla .subtitulo {
            font-size: 14px;
            color: #3dff67;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .lista-desarrolladores {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .desarrollador {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
            border-left: 3px solid #3dff67;
        }
        .desarrollador .nombre {
            font-size: 15px;
            font-weight: 500;
            color: white;
        }
        .desarrollador .rol {
            font-size: 12px;
            font-weight: 700;
            color: #3dff67;
            letter-spacing: 1px;
            background-color: rgba(61, 255, 103, 0.1);
            padding: 4px 8px;
            border-radius: 4px;
        }
        .check-creditos:checked ~ .creditos-pantalla {
            visibility: visible;
            opacity: 1;
        }
        @media (max-width: 768px) {
            .pantalla {
                width: 92%;
                padding: 25px 18px;
            }
            .pantalla h2 {
                font-size: 20px;
            }
            .pantalla .subtitulo {
                font-size: 13px;
                margin-bottom: 20px;
            }
            .desarrollador {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            .desarrollador .nombre {
                font-size: 14px;
            }
            .desarrollador .rol {
                font-size: 11px;
            }
        }

        .directivos-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 1% 80px 1%;
            display: flex;
            flex-direction: column;
            gap: 50px;
        }

        .directivos-intro {
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 25px;
        }

        .directivos-intro p {
            color: rgba(255, 255, 255, 0.75);
            font-family: 'Google Sans Flex', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .btn-agregar {
            display: inline-block;
            background-color: #3dff67;
            color: #1b1a1a;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.5px;
            margin-top: 15px;
            transition: all 0.2s ease;
        }

        .btn-agregar:hover {
            background-color: #ffffff;
        }

        .turno-seccion {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .turno-titulo {
            border-left: 4px solid #3dff67;
            padding-left: 12px;
        }

        .turno-titulo h2 {
            color: #ffffff;
            font-family: 'Oswald', sans-serif;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .tarjetas-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .tarjeta {
            background-color: rgba(36, 35, 35, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 32px 25px;
            min-height: 240px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .tarjeta-nombre {
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .tarjeta-cargo {
            color: #3dff67;
            font-family: 'Google Sans Flex', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .tarjeta-desc {
            color: #b0b0b0;
            font-family: 'Google Sans Flex', sans-serif;
            font-size: 13.5px;
            line-height: 1.5;
        }

        .admin-acciones {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .btn-editar {
            background-color: rgba(255, 204, 0, 0.15);
            color: #ffcc00;
            border: 1px solid #ffcc00;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
        }

        .btn-borrar {
            background-color: rgba(255, 77, 77, 0.15);
            color: #ff4d4d;
            border: 1px solid #ff4d4d;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
        }

        footer {
            width: 100%;
            background-color: #121518;
            padding: 0 10% 40px 10%;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .divisor-final {
            width: 100%;
            height: 1px;
            background-color: #242323;
            margin-bottom: 30px;
        }

        .bloque-inferior {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-align: center;
        }

        .bloque-inferior p {
            color: #888888;
            font-size: 14px;
            font-family: "Google Sans Flex", sans-serif;
            letter-spacing: 0.3px;
            line-height: 1.5;
            margin: 0;
        }

        @media (max-width: 992px) {
            nav {
                padding: 0 8%;
            }

            .tarjetas-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            nav {
                padding: 0 5%;
            }

            .seccion h1 {
                font-size: 15px;
            }

            .seccion p {
                font-size: 12px;
            }

            .menu-lateral {
                width: 280px;
                right: -280px;
            }

            .titulo {
                padding: 0 5%;
            }

            .creditos {
                right: 0;
                left: 0;
                bottom: 12px;
                text-align: center;
            }

            .creditos label {
                font-size: 10px;
                letter-spacing: 0.8px;
            }

            .pantalla {
                width: 92%;
                padding: 25px 18px;
            }

            .pantalla h2 {
                font-size: 20px;
            }

            .pantalla .subtitulo {
                font-size: 13px;
                margin-bottom: 20px;
            }

            .directivos-container {
                padding: 30px 5% 60px 5%;
            }

            .tarjetas-grid {
                grid-template-columns: 1fr;
            }

            footer {
                padding: 0 20px 30px 20px;
            }

            .divisor-final {
                margin-bottom: 25px;
            }

            .bloque-inferior p {
                font-size: 12px;
                padding: 0 10px;
            }
        }
    </style>
</head>
<body>

    <input type="checkbox" id="check-creditos" class="check-creditos">

    <div class="creditos-pantalla">
        <label for="check-creditos" class="fondo-creditos"></label>
        <div class="pantalla">
            <label for="check-creditos" class="cerrar-creditos">&times;</label>
            <h2>Créditos</h2>
            <p class="subtitulo">Estudiantes de 7°12 2026</p>
            <div class="lista-desarrolladores">
                <div class="desarrollador">
                    <span class="nombre">Axel Joaquin Molina Perez</span>
                </div>
                <div class="desarrollador">
                    <span class="nombre">Franco Ezequiel Pedrozo</span>
                </div>
                <div class="desarrollador">
                    <span class="nombre">Raiquen Fernandez Farias</span>
                </div>
                <div class="desarrollador">
                    <span class="nombre">Valentino Stefano Petovello</span>
                </div>
            </div>
        </div>
    </div>

    <input type="checkbox" id="check-menu" class="check-menu">

    <nav>
        <div class="logo-seccion">
            <div class="logo"><a href="index.php"><img src="imgs/logo.png" alt="Logo"></a></div>
            <div class="seccion"><h1>E.E.S.T N°3</h1><p>EQUIPO DE CONDUCCIÓN</p></div>
        </div>
        <div class="login-opc">
            <?php if (!$sesionIniciada): ?>
                <div class="login">
                    <a href="iniciarsesion.php">
                        <img src="imgs/login.png" alt="Perfil">
                    </a>
                </div>
            <?php endif; ?>

            <label for="check-menu" class="menu-btn">
                <span class="linea"></span>
                <span class="linea"></span>
                <span class="linea"></span>
            </label>
        </div>
    </nav>

    <label for="check-menu" class="overlay"></label>

    <aside class="menu-lateral">
        <label for="check-menu" class="cerrar-btn">&times;</label>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="noticias.php">Noticias</a></li>
            <li><a href="quienessomos.php">¿Quiénes Somos?</a></li>
            <li><span class="activo">Equipo De Conducción</span></li>
            <li><a href="ciclobasico.php">Ciclo Básico</a></li>
            <li><a href="ctp.php">Ciclos Técnicos Profesionales</a></li>
            <li><label for="check-creditos" class="btn-menu-creditos">Desarrolladores</label></li>
            <?php if ($sesionIniciada): ?>
            <li>
                <a href="admin.php">Panel</a>
            </li>

            <li>
                <a href="cerrar_sesion.php" style="border-bottom: none; color: #ff4d4d;">
                    Cerrar Sesión
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </aside>

    <div class="wallper">
        <div class="filtro"></div>
        
        <div class="titulo">
            <h1>EQUIPO DE CONDUCCIÓN</h1>
        </div>

        <div class="creditos">
            <label for="check-creditos">sitio web desarrollado por estudiantes de la institución</label>
        </div>
    </div>

    <div class="directivos-container">
        <div class="directivos-intro">
            <p>Conocé a las autoridades e integrantes del equipo directivo que coordinan y orientan las actividades educativas de nuestra institución en sus distintos turnos.</p>
            <?php if ($es_admin): ?>
                <a href="gestionar_directivos.php?accion=nuevo" class="btn-agregar">+ Añadir Directivo</a>
            <?php endif; ?>
        </div>

        <?php
        $turnos = ['Turno Mañana', 'Turno Tarde', 'Turno Noche'];
        foreach ($turnos as $turno) {
            $query = mysqli_query($conexion, "SELECT * FROM directivos WHERE turno = '$turno'");
            if ($query && mysqli_num_rows($query) > 0) {
                echo '<div class="turno-seccion">';
                echo '<div class="turno-titulo"><h2>' . htmlspecialchars($turno) . '</h2></div>';
                echo '<div class="tarjetas-grid">';
                
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="tarjeta">';
                    echo '<div>';
                    echo '<div class="tarjeta-nombre">' . htmlspecialchars($row['nombre']) . '</div>';
                    echo '<div class="tarjeta-cargo">' . htmlspecialchars($row['cargo']) . '</div>';
                    echo '<div class="tarjeta-desc">' . htmlspecialchars($row['descripcion']) . '</div>';
                    echo '</div>';
                    
                    if ($es_admin) {
                        echo '<div class="admin-acciones">';
                        echo '<a href="gestionar_directivos.php?accion=editar&id=' . $row['id'] . '" class="btn-editar">Editar</a>';
                        echo '<a href="gestionar_directivos.php?accion=borrar&id=' . $row['id'] . '" class="btn-borrar" onclick="return confirm(\'¿Eliminar este directivo?\');">Borrar</a>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                }
                
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <footer>
        <div class="divisor-final"></div>       
        <div class="bloque-inferior">
            <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>