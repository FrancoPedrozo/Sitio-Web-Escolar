<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Iniciar Sesión</title>
    <link rel="stylesheet" href="iniciarsesion.css">
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
            <div class="divisor"></div>     
            <div class="bloque-inferior">
                <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>