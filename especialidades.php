<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Especialidades</title>
    <link rel="icon" href="imgs/logo.png">
    <link rel="stylesheet" href="especialidades.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Oswald:wght@600&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Creditos Axel Perez 7°12 2026 -->
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
                <span class="item">ESPECIALIDADES</span>
                <li><a href="">HISTORIA</a></li>
                <li><a href="directivos.php">DIRECTIVOS</a></li>
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
            <h1>ESPECIALIDADES</h1>
        </div>
    </div>

    <div class="seccion-informacion">
        <div class="introduccion-texto">
            <p>Nuestra institución se destaca por ofrecer una sólida formación técnica en distintas orientaciones, preparando a nuestros estudiantes para los desafíos del mundo laboral y profesional con excelencia académica y talleres prácticos de vanguardia.</p>
        </div>

        <div class="cuadrícula-especialidades">
            
            <div class="tarjeta-orientacion">
                <div class="cabecera-tarjeta">
                    <h1>Informática</h1>
                </div>
                <div class="contenido-tarjeta">
                    <p class="subtitulo-detalle">Qué se aprende:</p>
                    <p class="descripcion-detalle">Programación, redes, hardware y desarrollo de software. Se adquieren habilidades para resolver problemas tecnológicos, crear soluciones digitales y trabajar con herramientas como HTML, C++, CSS y Java, además de bases de datos, sistemas operativos y seguridad informática.</p>
                    
                    <p class="subtitulo-detalle">Actividades:</p>
                    <p class="descripcion-detalle">Proyectos prácticos como desarrollo de páginas web y aplicaciones, armado y reparación de computadoras, configuración de redes y simulaciones de soporte técnico en laboratorio.</p>
                    
                    <p class="subtitulo-detalle">Salida laboral:</p>
                    <p class="descripcion-detalle">Soporte técnico, mantenimiento de equipos, redes, desarrollo web o programación inicial. También permite trabajar de forma independiente o continuar estudios en informática o sistemas.</p>
                </div>
            </div>

            <div class="tarjeta-orientacion">
                <div class="cabecera-tarjeta">
                    <h1>Electrónica</h1>
                </div>
                <div class="contenido-tarjeta">
                    <p class="subtitulo-detalle">Qué se aprende:</p>
                    <p class="descripcion-detalle">Circuitos, electrónica analógica y digital, automatización y programación de dispositivos. Se desarrollan habilidades para diseñar, reparar y entender sistemas electrónicos aplicados a robótica e industrias.</p>
                    
                    <p class="subtitulo-detalle">Actividades:</p>
                    <p class="descripcion-detalle">Proyectos como diseño de placas, armado de equipos, robótica, impresión 3D, domótica y trabajos con Arduino, aplicando lo aprendido de forma práctica.</p>
                    
                    <p class="subtitulo-detalle">Salida laboral:</p>
                    <p class="descripcion-detalle">Mantenimiento y reparación electrónica, automatización industrial, telecomunicaciones o proyectos tecnológicos. También permite emprender o continuar estudios en electrónica, ingeniería o robótica.</p>
                </div>
            </div>

            <div class="tarjeta-orientacion">
                <div class="cabecera-tarjeta">
                    <h1>Maestro Mayor de Obras</h1>
                </div>
                <div class="contenido-tarjeta">
                    <p class="subtitulo-detalle">Qué se aprende:</p>
                    <p class="descripcion-detalle">Construcción, diseño y planificación de obras. Interpretación de planos, cálculo básico, materiales y normativas para comprender todo el proceso constructivo.</p>
                    
                    <p class="subtitulo-detalle">Actividades:</p>
                    <p class="descripcion-detalle">Diseño de planos digitales y manuales, maquetas estructurales, cómputo y presupuesto de materiales, análisis de suelos y visitas guiadas a obras en construcción reales.</p>
                    
                    <p class="subtitulo-detalle">Salida laboral:</p>
                    <p class="descripcion-detalle">Planificación, dirección o dibujo técnico de proyectos de obras residenciales o comerciales de mediana escala. Trabajo en estudios de arquitectura, empresas constructoras o de forma independiente.</p>
                </div>
            </div>

            <div class="tarjeta-orientacion">
                <div class="cabecera-tarjeta">
                    <h1>Química</h1>
                </div>
                <div class="contenido-tarjeta">
                    <p class="subtitulo-detalle">Qué se aprende:</p>
                    <p class="descripcion-detalle">Análisis de sustancias, procesos químicos y trabajo de laboratorio. Uso de equipos, normas de seguridad, química orgánica, microbiología y control de calidad.</p>
                    
                    <p class="subtitulo-detalle">Actividades:</p>
                    <p class="descripcion-detalle">Experimentos, análisis de muestras, preparación de soluciones y proyectos como el estudio del agua, trabajando en laboratorio en grupos.</p>
                    
                    <p class="subtitulo-detalle">Salida laboral:</p>
                    <p class="descripcion-detalle">Laboratorios e industrias químicas, alimenticias o farmacéuticas, en control de calidad o análisis. También permite continuar estudios en química, bioquímica o áreas afines.</p>
                </div>
            </div>

            <div class="tarjeta-orientacion">
                <div class="cabecera-tarjeta">
                    <h1>Electromecánica</h1>
                </div>
                <div class="contenido-tarjeta">
                    <p class="subtitulo-detalle">Qué se aprende:</p>
                    <p class="descripcion-detalle">Electricidad y mecánica aplicadas a sistemas industriales. Diseño, mantenimiento y automatización de máquinas, incluyendo motores, PLC y procesos productivos.</p>
                    
                    <p class="subtitulo-detalle">Actividades:</p>
                    <p class="descripcion-detalle">Prácticas en taller con máquinas herramientas, trabajos de electricidad domiciliaria e industrial, proyectos como la construcción de un auto, salidas educativas y competencias técnicas.</p>
                    
                    <p class="subtitulo-detalle">Salida laboral:</p>
                    <p class="descripcion-detalle">Industrias, fábricas y mantenimiento técnico en áreas eléctricas o mecánicas. También permite trabajar de forma independiente o continuar estudios en ingeniería o carreras técnicas.</p>
                </div>
            </div>

            <div class="tarjeta-orientacion">
                <div class="cabecera-tarjeta">
                    <h1>Automotores</h1>
                </div>
                <div class="contenido-tarjeta">
                    <p class="subtitulo-detalle">Qué se aprende:</p>
                    <p class="descripcion-detalle">Diagnóstico, reparación y mantenimiento de vehículos. Funcionamiento de motores, sistemas mecánicos y electrónicos, y técnicas de análisis automotriz.</p>
                    
                    <p class="subtitulo-detalle">Actividades:</p>
                    <p class="descripcion-detalle">Prácticas en taller con herramientas profesionales, reparación de vehículos, uso de escáneres, pruebas de motores y experiencias en talleres y concesionarias.</p>
                    
                    <p class="subtitulo-detalle">Salida laboral:</p>
                    <p class="descripcion-detalle">Talleres mecánicos, concesionarias, mantenimiento de flotas o emprendimientos propios. También permite trabajar con GNC o continuar estudios en mecánica o ingeniería automotriz.</p>
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