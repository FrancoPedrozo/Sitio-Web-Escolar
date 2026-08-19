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
    <title>E.E.S.T N°3 - Inicio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/logo.png">
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
                <li><a href="#link-contacto">CONTACTO</a></li>
                <li><a href="noticias.php">NOTICIAS</a></li>
                <li><a href="especialidades.php">ESPECIALIDADES</a></li>
                <li><a href="">HISTORIA</a></li>
                <li><a href="directivos.php">DIRECTIVOS</a></li>
                
                <?php 
                
                if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1) {
                    echo '<li><a href="subir_foto.php" style="color: #ffcc00; font-weight: bold;">SUBIR FOTOS</a></li>';
                }
                ?>
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
            <h1>TECNICA 3</h1>
            <h2>Domingo Faustino Sarmiento</h2>
            <p class="frase">Construyendo el futuro desde la educación pública</p>
        </div>

        <div class="creditos">
            <span>Sitio web desarrollado por estudiantes de la institución</span>
        </div>
    </div>

    <div class="especialidades">
        <div class="flecha" id="redireccion-flecha">
            <a href="#redireccion-flecha">⇩</a>
        </div>
        <div class="especialidades-titulo">
            <h1>NUESTRAS ESPECIALIDADES</h1>
        </div>
        
        <div class="especialidades-grid">
            <?php
            include("conexion.php");
            $resultado_tarjetas = mysqli_query($conexion, "SELECT * FROM especialidades_img");

            while ($tarjeta = mysqli_fetch_assoc($resultado_tarjetas)) {
                $nombre = htmlspecialchars($tarjeta['nombre_especialidad']);
                $imagen = $tarjeta['imagen_ruta'];
                
                // Asignamos el texto directamente según el nombre de la especialidad
                switch ($tarjeta['nombre_especialidad']) {
                    case 'Química':
                        $descripcion = "Formacion en analisis de sustancias, procesos industriales laboratorio. Aprendes a trabajar con equipos quimicos, control de calidad y seguridad, preparandote para industrias, invetigacion o estudios superiores en quimica.";
                        break;
                    case 'Electrónica':
                        $descripcion = "Especializacion en circuitos, sistemas electronicos y automatizacion. Aprendes a diseñar, reparar y programar dispositivos electronicos, con aplicacion en robotica, telecomunicaciones e industrias tecnologicas.";
                        break;
                    case 'Informática':
                        $descripcion = "Aprendés programación, redes, hardware y desarrolo de software. Te formás para resolver problemas tecnológicos, crear soluciones digitales y trabajar en empresas, soporte técnico o continuar estudios en sistemas.";
                        break;
                    case 'Construcciones':
                        $descripcion = "Formación en construcción, diseño y planificación de obras. Aprendés a interpretar planos, dirigir proyectos y gestionar materiales, con salida laboral en obras, estudios técnicos o empredimientos en construcción.";
                        break;
                    case 'Electromecánica':
                        $descripcion = "Combina electricidad y mecánica para diseñar, mantener y reparar sistemas industriales, Aprendés sobre máquinas, automatización y procesos productivos, con salida laborar en fábricas, mantenimiento técnico y sectores industriales.";
                        break;
                    case 'Automotores':
                        $descripcion = "Especialización en diagnóstico, reparación y mantenimiento de vehículos. Trabajás con motores, sistemas electrónicos y mecánicos preparándote para talleres, concesionarias o empredimientos propios dentro del sector automotriz.";
                        break;
                    default:
                        $descripcion = "Especialización técnica orientada a la formación profesional y práctica en talleres y laboratorios institucionales.";
                }

                echo '<div class="tarjeta">';
                echo '<div class="tarjeta-fondo"><img src="' . $imagen . '" alt="' . $nombre . '"></div>';
                echo '<div class="tarjeta-filtro"></div>';
                echo '<div class="tarjeta-contenido">';
                echo '<div class="tarjeta-descripcion">';
                echo '<h1>' . $nombre . '</h1>';
                echo '<span>' . $descripcion . '</span>';
                echo '</div>';
                echo '<div class="tarjeta-boton"><a href="especialidades.php"><button>VER MÁS</button></a></div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

   
<section class="galeria-seccion">
    <div class="galeria-titulo-container">
        <h2 class="galeria-titulo">Galería de la Escuela</h2>
        <p class="galeria-subtitulo">Explora nuestras instalaciones y momentos destacados.</p>
    </div>

    <div class="galeria-grid">
        <?php
        
        $categorias = [
            1 => "Nuestra escuela",
            2 => "Proyectos",
            3 => "Talleres",
            4 => "Prácticas Profesionales",
            5 => "Laboratorios",
            6 => "Eventos y Actos"
        ];

        foreach ($categorias as $idCat => $nombreCat) {
            
            $query = "SELECT imagen_ruta FROM galeria_institucional WHERE categoria_id = $idCat ORDER BY id DESC LIMIT 10";
            $resultado = mysqli_query($conexion, $query);
        ?>
            <div class="galeria-card" data-card="<?php echo $idCat; ?>">
                <div class="carrusel-container">
                    <div class="carrusel-slides">
                        <?php 
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            $contador = 0;
                            while ($foto = mysqli_fetch_assoc($resultado)) {
                                $claseActive = ($contador === 0) ? 'slide active' : 'slide';
                                echo '<img src="' . htmlspecialchars($foto['imagen_ruta']) . '" class="' . $claseActive . '" alt="' . htmlspecialchars($nombreCat) . '">';
                                $contador++;
                            }
                        } else {
                           
                            echo '<img src="imgs/default-galeria.jpg" class="slide active" alt="' . htmlspecialchars($nombreCat) . '">';
                        }
                        ?>
                    </div>
                    
                    
                    <?php if ($resultado && mysqli_num_rows($resultado) > 1): ?>
                        <button class="carrusel-btn prev" onclick="cambiarSlide(<?php echo $idCat; ?>, -1)">&#10094;</button>
                        <button class="carrusel-btn next" onclick="cambiarSlide(<?php echo $idCat; ?>, 1)">&#10095;</button>
                    <?php endif; ?>
                </div>

                <div class="card-overlay">
                    <h3><?php echo htmlspecialchars($nombreCat); ?></h3>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<script>
function cambiarCardSlide(cardIndex, direction) {
    const card = document.querySelector(`.galeria-card[data-card="${cardIndex}"]`);
    if (!card) return;
    const slides = card.querySelectorAll('.slide');
    if (slides.length <= 1) return;
    
    let currentIndex = Array.from(slides).findIndex(slide => slide.classList.contains('active'));
    
    slides[currentIndex].classList.remove('active');
    currentIndex += direction;
    
    if (currentIndex < 0) {
        currentIndex = slides.length - 1;
    } else if (currentIndex >= slides.length) {
        currentIndex = 0;
    }
    
    slides[currentIndex].classList.add('active');
}

function cambiarSlide(cardNum, dir) {
    cambiarCardSlide(cardNum, dir);
}
</script>
    </div>

    <div id="link-contacto" class="contacto-maps">
        
        <div class="contacto-title">
            <h1>Formando futuros técnicos con pasión</h1>
        </div>

        <div class="maps-info">
            <div class="columna-mapa">
                <div class="maps">
                    <iframe src="https://maps.google.com/maps?q=Escuela%20Tecnica%203%20Domingo%20Faustino%20Sarmiento%20Mar%20del%20Plata&t=&z=16&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="direccion-bloque">
                    <h2>Nuestra Ubicación</h2>
                    <p>14 de Julio 2550, Mar del Plata, Buenos Aires</p>
                    <a href="https://maps.google.com/?q=Escuela+Tecnica+3+Mar+del+Plata" target="_blank" class="btn-google-maps">Ver ubicación en Google Maps</a>
                </div>
            </div>

            <div class="info">
                <div class="info-grupo">
                    <h1>Información de Contacto</h1>
                    <p><strong>Teléfono:</strong> +54 0223 495-0285</p>
                    <p><strong>Email:</strong> contacto@escolat3.edu.ar</p>
                </div>
                <div class="info-grupo">
                    <h2>Horarios de Atención</h2>
                    <p class="horario-texto">Lunes a Viernes: 08:00 - 18:00</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="divisor-final"></div>       
        <div class="bloque-inferior">
            <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>