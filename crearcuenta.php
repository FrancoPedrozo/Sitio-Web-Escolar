<?php
// Incluimos la conexión a la base de datos
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Crear Cuenta</title>
    <link rel="stylesheet" href="crearcuenta.css">
    <link rel="icon" href="imgs/logo.png">
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
                <li><a href="index.php">INICIO</a></li>
                <li><a href="">NOTICIAS</a></li>
                <li><a href="especialidades.php">ESPECIALIDADES</a></li>
                <li><a href="">HISTORIA</a></li>
                <li><a href="directivos.php">DIRECTIVOS</a></li>
            </ul>
        </nav>
    </header>

    <div class="wallper">
        <div class="filtro"></div>
        
        <div class="container-formulario">
            <form action="procesarregistro.php" method="POST" class="formulario-registro">
                <h1>Crear Cuenta</h1>
                <h2>Regístrate para solicitar acceso al sistema</h2>
                
                <div class="input-grupo">
                    <label>Usuario</label>
                    <input type="text" name="usuario" placeholder="Ej: Directora" required>
                </div>

                <div class="input-grupo">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" placeholder="ejemplo@correo.com" required>
                </div>
                
                <div class="input-grupo">
                    <label>Contraseña</label>
                    <input type="password" name="clave" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn-registrar">REGISTRARSE</button>
                
                <div class="login-link">
                    <p>¿Ya tienes una cuenta institucional? <a href="iniciarsesion.php">Iniciar sesión</a></p>
                </div>
            </form>
        </div>

        <footer>
            <div class="divisor"></div>      
            <div class="bloque-inferior">
                <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>