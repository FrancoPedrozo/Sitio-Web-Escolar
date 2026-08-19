<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="directivos.css">
    <link rel="icon" href="imgs/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Oswald:wght@600&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
    <title>E.E.S.T N°3 - Directivos</title>
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
                <li><a href="noticias.php">NOTICIAS</a></li>
                <li><a href="especialidades.php">ESPECIALIDADES</a></li>
                <li><a href="">HISTORIA</a></li>
                <span class="item">DIRECTIVOS</span>
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
        <div class="titulo">
            <h1>DIRECTIVOS</h1>
        </div>
    </div>

    <div class="directivos-container">
        <div class="directivos-titulo">
            <h1>Nuestro Equipo Directivo</h1>
            <p>Liderazgo comprometido con la excelencia educativa y la formación técnica de nuestros estudiantes.</p>
        </div>
        
        <div class="turno-seccion">
            <div class="turno-titulo"><h1>Turno Mañana</h1></div>
            <div class="tarjetas-container">
                <div class="tarjeta">
                    <div class="nombre"><p>Andrea Tucat</p></div>
                    <div class="cargo"><p>DIRECTORA</p></div>
                    <div class="descripcion"><p>Más de 10 años siendo directora de la institución de forma profesional.</p></div>
                </div>
                <div class="tarjeta">
                    <div class="nombre"><p>Marcela Elicabe</p></div>
                    <div class="cargo"><p>VICEDIRECTORA</p></div>
                    <div class="descripcion"><p>Especialista en gestión académica, coordina el cuerpo docente y el seguimiento pedagógico.</p></div>
                </div>
                <div class="tarjeta">
                    <div class="nombre"><p>Esteban Marione</p></div>
                    <div class="cargo"><p>JEFE DE ÁREA TÉCNICA</p></div>
                    <div class="descripcion"><p>Supervisa los laboratorios y talleres, asegurando la actualización tecnológica y la seguridad.</p></div>
                </div>
            </div>
        </div>

        <div class="turno-seccion">
            <div class="turno-titulo"><h1>Turno Tarde</h1></div>
            <div class="tarjetas-container">
                <div class="tarjeta">
                    <div class="nombre"><p>Andrea Tucat</p></div>
                    <div class="cargo"><p>DIRECTORA</p></div>
                    <div class="descripcion"><p>Más de 10 años siendo directora de la institución de forma profesional.</p></div>
                </div>
                <div class="tarjeta">
                    <div class="nombre"><p>Marcela Elicabe</p></div>
                    <div class="cargo"><p>VICEDIRECTORA</p></div>
                    <div class="descripcion"><p>Especialista en gestión académica, coordina el cuerpo docente y el seguimiento pedagógico.</p></div>
                </div>
                <div class="tarjeta">
                    <div class="nombre"><p>Esteban Marione</p></div>
                    <div class="cargo"><p>JEFE DE ÁREA TÉCNICA</p></div>
                    <div class="descripcion"><p>Supervisa los laboratorios y talleres, asegurando la actualización tecnológica y la seguridad.</p></div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="divisor-final"></div>
        <div class="bloque-inferior">
            <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
            <div class="enlaces-sociales">
                <a href="https://www.youtube.com/@eest3domingofaustinosarmie948" class="boton-red">
                    <svg viewBox="0 0 24 24"><path fill="#FF0000" d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.516 0-9.388.508a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.872.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="https://www.facebook.com/p/Escuela-T%C3%A9cnica-3-Domingo-Faustino-Sarmiento-100057481507156/?locale=es_LA" class="boton-red">
                    <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12a12 12 0 1 0-13.875 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385A12 12 0 0 0 24 12z"/></svg>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>