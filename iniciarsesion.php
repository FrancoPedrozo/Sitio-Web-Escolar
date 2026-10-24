<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Iniciar Sesión</title>
    <link rel="icon" href="imgs/logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&family=Montserrat:wght@500;600;700&family=Oswald:wght@600&display=swap');

        * {
            margin: 0;
            padding: 0;
            color: inherit;
            box-sizing: border-box;
            user-select: none;
        }
        body {
            height: 100vh;
            font-family: "Montserrat", sans-serif;
            background-color: #1b1a1a;
            overflow-x: hidden;
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
            z-index: 999;
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
            font-weight: 600;
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
            z-index: 1001;
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
        .creditos-pantalla {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
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
            z-index: 2001;
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
            nav {
                padding: 0 6%;
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
        .wallper {
            position: relative;
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 80px 20px 0 20px;
        }
        .filtro {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(to bottom, #000000d8, #011120);
            z-index: 2;
        }
        .container-formulario {
            position: relative;
            z-index: 3;
            width: 100%;
            max-width: 440px;
            background-color: rgba(36, 35, 35, 0.65);
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 35px 30px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.7);
            margin: auto 0;
        }
        .formulario-login {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .formulario-login h1 {
            font-family: "Oswald", sans-serif;
            color: white;
            font-size: 32px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            text-align: center;
        }
        .formulario-login h2 {
            font-family: "Google Sans Flex", sans-serif;
            color: #a6a6a6;
            font-size: 13.5px;
            font-weight: 400;
            margin-bottom: 30px;
            text-align: center;
        }
        .input-grupo {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
            width: 100%;
        }
        .input-grupo label {
            font-family: "Google Sans Flex", sans-serif;
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .input-grupo input {
            width: 100%;
            height: 46px;
            background-color: rgba(27, 26, 26, 0.8);
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            padding: 0 16px;
            color: white;
            font-family: "Montserrat", sans-serif;
            font-size: 14px;
            outline: none;
            user-select: text;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .input-grupo input:focus {
            border-color: #3dff67;
            box-shadow: 0 0 12px rgba(61, 255, 103, 0.2);
        }
        .btn-ingresar {
            cursor: pointer;
            width: 100%;
            height: 46px;
            background-color: #3dff67;
            color: #1b1a1a;
            border: none;
            border-radius: 8px;
            font-family: "Google Sans Flex", sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-top: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }
        .btn-ingresar:hover {
            background-color: white;
            color: black;
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.2);
        }
        .btn-ingresar:active {
            transform: scale(0.98);
        }
        .registro-link {
            width: 100%;
            text-align: center;
        }
        .registro-link p {
            font-family: "Google Sans Flex", sans-serif;
            color: #8c8c8c;
            font-size: 13px;
        }
        .registro-link a {
            color: #3dff67;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        .registro-link a:hover {
            color: white;
            text-decoration: underline;
        }
        footer {
            position: relative;
            z-index: 3;
            width: 100%;
            padding: 20px 70px 25px 70px;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }
        .divisor, .divisor-final {
            width: 100%;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.06);
            margin-bottom: 20px;
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
            color: #737373;
            font-size: 13px;
            font-family: "Google Sans Flex", sans-serif;
            letter-spacing: 0.3px;
            line-height: 1.4;
            margin: 0;
        }
        @media (max-width: 768px) {
            nav {
                padding: 0 20px;
            }
            .container-formulario {
                padding: 30px 20px;
                max-width: 380px;
            }
            .formulario-login h1 {
                font-size: 26px;
            }
            footer {
                padding: 20px 20px 20px 20px;
            }
            .bloque-inferior p {
                font-size: 11px;
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
            <div class="logo"><a href="index.php"><img src="imgs/logo.png"></a></div>
            <div class="seccion"><h1>E.E.S.T N°3</h1><p>INICIAR SESIÓN</p></div>
        </div>
        <div class="login-opc">
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
            <li><a href="equipo.php">Equipo De Conducción</a></li>
            <li><a href="ciclobasico.php">Ciclo Básico</a></li>
            <li><a href="ctp.php">Ciclos Técnicos Profesionales</a></li>
            <li><label for="check-creditos" class="btn-menu-creditos">Desarrolladores</label></li>
        </ul>
    </aside>

    <div class="wallper">
        <div class="filtro"></div>
        
        <div class="container-formulario">
            <form action="validarlogin.php" method="POST" class="formulario-login">
                <h1>Iniciar Sesión</h1>
                <h2>Ingresa tus credenciales para acceder</h2>
                    
                <?php 
                if (isset($_GET['error']) && $_GET['error'] == 'datos_incorrectos') {
                    echo '<div style="background-color: rgba(255, 77, 77, 0.15); color: #ff4d4d; border: 1px solid #ff4d4d; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 0.9em; font-weight: 500;">Usuario o contraseña incorrectos.</div>';
                }
                ?>

                <div class="input-grupo">
                    <label>Usuario</label>
                    <input type="text" name="usuario" placeholder="Ej: Directora" required>
                </div>
                
                <div class="input-grupo">
                    <label>Contraseña</label>
                    <input type="password" name="clave" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn-ingresar">INGRESAR</button>
                
                <div class="registro-link">
                    <p>¿No tienes una cuenta institucional? <a href="crearcuenta.php">Crear cuenta</a></p>
                </div>
            </form>
        </div>

        <footer>
            <div class="divisor-final"></div>       
            <div class="bloque-inferior">
                <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

</body>
</html>