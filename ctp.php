<?php
session_start();
include 'conexion.php';

$sesionIniciada = isset($_SESSION['usuario']) || isset($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 | Ciclos Técnicos Profesionales</title>
    <link rel="icon" href="imgs/logo.png">
</head>
<body>
    
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

.ctp-seccion {
    width: 100%;
    padding: 60px 11% 80px 11%;
    background-color: #121518;
    color: #ffffff;
}

.ctp-intro {
    text-align: center;
    max-width: 950px;
    margin: 0 auto 50px auto;
}

.ctp-intro p {
    color: #d1d5db;
    font-size: 16px;
    line-height: 1.7;
    font-family: "Google Sans Flex", sans-serif;
}

.especialidades-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.tarjeta-especialidad {
    background-color: #1c1f23;
    border-radius: 10px;
    padding: 35px 30px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-left: 2px solid #3dff67;
}

.tarjeta-especialidad h2 {
    display: inline-block;
    align-self: flex-start;
    font-size: 28px;
    font-weight: 700;
    color: white;
    margin-bottom: 25px;
    border-bottom: 2px solid #3dff67;
    padding-bottom: 6px;
}

.bloque-info {
    margin-bottom: 22px;
}

.bloque-info:last-child {
    margin-bottom: 0;
}

.bloque-info h3 {
    font-size: 15px;
    font-weight: 800;
    color: white;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.bloque-info p {
    color: #d1d5db;
    font-size: 16px;
    line-height: 1.6;
    font-family: "Google Sans Flex", sans-serif;
}

@media (max-width: 992px) {
    .especialidades-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
}

@media (max-width: 768px) {
    .ctp-seccion {
        padding: 40px 5% 60px 5%;
    }
    .tarjeta-especialidad {
        padding: 25px 20px;
    }
    .tarjeta-especialidad h2 {
        font-size: 24px;
    }
}

footer {
    width: 100%;
    background-color: #121518;
    padding: 0 70px 40px 70px;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
}
.divisor-final {
    width: 100%;
    height: 1px;
    background-color: #242323;
    margin-bottom: 40px;
}
.bloque-inferior {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
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
@media (max-width: 768px) {
    footer {
        padding: 0 20px 30px 20px;
    }
    
    .divisor-final {
        margin-bottom: 30px;
    }
    
    .bloque-inferior p {
        font-size: 12px;
        padding: 0 10px;
    }
}
</style>

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
            <div class="seccion"><h1>E.E.S.T N°3</h1><p>CICLO TÉCNICOS PROFESIONALES</p></div>
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
            <li><a href="equipo.php">Equipo De Conducción</a></li>
            <li><a href="ciclobasico.php">Ciclo Básico</a></li>
            <li><span class="activo">Ciclos Técnicos Profesionales</span></li>
            <li><label for="check-creditos" class="btn-menu-creditos">Desarrolladores</label></li>
            <?php if ($sesionIniciada): ?>
            <li>
                <a href="admin.php">Panel</a>
            </li>

            <li>
                <a href="cerrar_sesion.php" class="cerrar-sesion" style="border-bottom: none; color: #ff4d4d;">
                    Cerrar Sesión
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </aside>

    <div class="wallper">
        <div class="filtro"></div>
        
        <div class="titulo">
            <h1>CICLO TÉCNICOS PROFESIONALES</h1>
        </div>

        <div class="creditos">
            <label for="check-creditos">sitio web desarrollado por estudiantes de la institución</label>
        </div>
    </div>

    <main class="ctp-seccion">
        <div class="ctp-intro">
            <p>Nuestra institución se destaca por ofrecer una sólida formación técnica en distintas orientaciones, preparando a nuestros estudiantes para los desafíos del mundo laboral y profesional con excelencia académica y talleres prácticos de vanguardia.</p>
        </div>

        <div class="especialidades-grid">
            <article class="tarjeta-especialidad">
                <h2>Informática</h2>
                <div class="bloque-info">
                    <h3>QUÉ SE APRENDE:</h3>
                    <p>Programación, redes, hardware y desarrollo de software. Se adquieren habilidades para resolver problemas tecnológicos, crear soluciones digitales y trabajar con herramientas como HTML, C++, CSS y Java, además de bases de datos, sistemas operativos y seguridad informática.</p>
                </div>
                <div class="bloque-info">
                    <h3>ACTIVIDADES:</h3>
                    <p>Proyectos prácticos como desarrollo de páginas web y aplicaciones, armado y reparación de computadoras, configuración de redes y simulaciones de soporte técnico en laboratorio.</p>
                </div>
                <div class="bloque-info">
                    <h3>SALIDA LABORAL:</h3>
                    <p>Soporte técnico, mantenimiento de equipos, redes, desarrollo web o programación inicial. También permite trabajar de forma independiente o continuar estudios en informática o sistemas.</p>
                </div>
            </article>

            <article class="tarjeta-especialidad">
                <h2>Electrónica</h2>
                <div class="bloque-info">
                    <h3>QUÉ SE APRENDE:</h3>
                    <p>Circuitos, electrónica analógica y digital, automatización y programación de dispositivos. Se desarrollan habilidades para diseñar, reparar y entender sistemas electrónicos aplicados a robótica e industrias.</p>
                </div>
                <div class="bloque-info">
                    <h3>ACTIVIDADES:</h3>
                    <p>Proyectos como diseño de placas, armado de equipos, robótica, impresión 3D, domótica y trabajos con Arduino, aplicando lo aprendido de forma práctica.</p>
                </div>
                <div class="bloque-info">
                    <h3>SALIDA LABORAL:</h3>
                    <p>Mantenimiento y reparación electrónica, automatización industrial, telecomunicaciones o proyectos tecnológicos. También permite emprender o continuar estudios en electrónica, ingeniería o robótica.</p>
                </div>
            </article>

            <article class="tarjeta-especialidad">
                <h2>Maestro Mayor de Obras</h2>
                <div class="bloque-info">
                    <h3>QUÉ SE APRENDE:</h3>
                    <p>Construcción, diseño y planificación de obras. Interpretación de planos, cálculo básico, materiales y normativas para comprender todo el proceso constructivo.</p>
                </div>
                <div class="bloque-info">
                    <h3>ACTIVIDADES:</h3>
                    <p>Diseño de planos digitales y manuales, maquetas estructurales, cómputo y presupuesto de materiales, análisis de suelos y visitas guiadas a obras en construcción reales.</p>
                </div>
                <div class="bloque-info">
                    <h3>SALIDA LABORAL:</h3>
                    <p>Planificación, dirección o dibujo técnico de proyectos de obras residenciales o comerciales de mediana escala. Trabajo en estudios de arquitectura, empresas constructoras o de forma independiente.</p>
                </div>
            </article>

            <article class="tarjeta-especialidad">
                <h2>Química</h2>
                <div class="bloque-info">
                    <h3>QUÉ SE APRENDE:</h3>
                    <p>Análisis de sustancias, procesos químicos y trabajo de laboratorio. Uso de equipos, normas de seguridad, química orgánica, microbiología y control de calidad.</p>
                </div>
                <div class="bloque-info">
                    <h3>ACTIVIDADES:</h3>
                    <p>Experimentos, análisis de muestras, preparación de soluciones y proyectos como el estudio del agua, trabajando en laboratorio en grupos.</p>
                </div>
                <div class="bloque-info">
                    <h3>SALIDA LABORAL:</h3>
                    <p>Laboratorios e industrias químicas, alimenticias o farmacéuticas, en control de calidad o análisis. También permite continuar estudios en química, bioquímica o áreas afines.</p>
                </div>
            </article>

            <article class="tarjeta-especialidad">
                <h2>Electromecánica</h2>
                <div class="bloque-info">
                    <h3>QUÉ SE APRENDE:</h3>
                    <p>Electricidad y mecánica aplicadas a sistemas industriales. Diseño, mantenimiento y automatización de máquinas, incluyendo motores, PLC y procesos productivos.</p>
                </div>
                <div class="bloque-info">
                    <h3>ACTIVIDADES:</h3>
                    <p>Prácticas en taller con máquinas herramientas, trabajos de electricidad domiciliaria e industrial, proyectos como la construcción de un auto, salidas educativas y competencias técnicas.</p>
                </div>
                <div class="bloque-info">
                    <h3>SALIDA LABORAL:</h3>
                    <p>Industrias, fábricas y mantenimiento técnico en áreas eléctricas o mecánicas. También permite trabajar de forma independiente o continuar estudios en ingeniería o carreras técnicas.</p>
                </div>
            </article>

            <article class="tarjeta-especialidad">
                <h2>Automotores</h2>
                <div class="bloque-info">
                    <h3>QUÉ SE APRENDE:</h3>
                    <p>Diagnóstico, reparación y mantenimiento de vehículos. Funcionamiento de motores, sistemas mecánicos y electrónicos, y técnicas de análisis automotriz.</p>
                </div>
                <div class="bloque-info">
                    <h3>ACTIVIDADES:</h3>
                    <p>Prácticas en taller con herramientas profesionales, reparación de vehículos, uso de escáneres, pruebas de motores y experiencias en talleres y concesionarias.</p>
                </div>
                <div class="bloque-info">
                    <h3>SALIDA LABORAL:</h3>
                    <p>Talleres mecánicos, concesionarias, mantenimiento de flotas o emprendimientos propios. También permite trabajar con GNC o continuar estudios en mecánica o ingeniería automotriz.</p>
                </div>
            </article>
        </div>
    </main>

    <footer>
        <div class="divisor-final"></div>       
        <div class="bloque-inferior">
            <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>