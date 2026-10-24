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
    <title>E.E.S.T N°3 | Inicio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="imgs/logo.png">
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
            <div class="logo">
                <a href="index.php">
                    <img src="imgs/logo.png">
                </a>
            </div>

            <div class="seccion">
                <h1>E.E.S.T N°3</h1>
                <p>INICIO</p>
            </div>
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
            <li>
                <span class="activo">Inicio</span>
            </li>

            <li>
                <a href="noticias.php">Noticias</a>
            </li>

            <li>
                <a href="quienessomos.php">¿Quiénes Somos?</a>
            </li>

            <li>
                <a href="equipo.php">Equipo De Conducción</a>
            </li>

            <li>
                <a href="ciclobasico.php">Ciclo Básico</a>
            </li>

            <li>
                <a href="ctp.php">Ciclos Técnicos Profesionales</a>
            </li>

            <li>
                <label for="check-creditos" class="btn-menu-creditos">
                    Desarrolladores
                </label>
            </li>

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
            <h1>E.E.S.T N°3</h1>
            <h2>Domingo Faustino Sarmiento</h2>
            <h3>Patria, Trabajo y Cultura</h3>
        </div>

        <div class="creditos">
            <label for="check-creditos">
                sitio web desarrollado por estudiantes de la institución
            </label>
        </div>
    </div>

    <section class="especialidades" id="especialidades">

        <div class="flecha" id="redireccion-flecha">
            <a href="#redireccion-flecha">⇩</a>
        </div>

        <div class="especialidades-header">
            <div class="contenedor-titulo">
                <h2>Nuestras Especialidades</h2>
                <div class="linea-decorativa"></div>
            </div>
        </div>

        <div class="especialidades-grid">
            <?php
            $resultado_tarjetas = mysqli_query($conexion, "SELECT * FROM especialidades_img");

            while ($tarjeta = mysqli_fetch_assoc($resultado_tarjetas)) {
                $nombre = htmlspecialchars($tarjeta['nombre_especialidad']);
                $imagen = $tarjeta['imagen_ruta'];
                
                switch ($tarjeta['nombre_especialidad']) {
                    case 'Química':
                        $descripcion = "Formacion en analisis de sustancias, procesos industriales laboratorio. Aprendes a trabajar con equipos quimicos, control de calidad y seguridad, preparandote para industrias, invetigacion o estudios superiores en quimica.";
                        break;
                    case 'Electrónica':
                        $descripcion = "Especializacion in circuitos, sistemas electronicos y automatizacion. Aprendes a diseñar, reparar y programar dispositivos electronicos, con aplicacion en robotica, telecomunicaciones e industrias tecnologicas.";
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

                echo '<article class="tarjeta-especialidad">';
                echo '<div class="tarjeta-imagen">';
                echo '<img src="' . $imagen . '" alt="' . $nombre . '" loading="lazy">';
                echo '</div>';
                echo '<div class="tarjeta-cuerpo">';
                echo '<h3>' . $nombre . '</h3>';
                echo '<p>' . $descripcion . '</p>';
                echo '<a href="ctp.php" class="btn-detalles">';
                echo '<span>Más información</span>';
                echo '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
                echo '<path d="M5 12h14M12 5l7 7-7 7"/>';
                echo '</svg>';
                echo '</a>';
                echo '</div>';
                echo '</article>';
            }
            ?>
        </div>
    </section>

    <section class="galeria" id="galeria">

        <div class="galeria-header">
            <div class="contenedor-titulo">
                <h2>Galería de la Escuela</h2>
                <div class="linea-decorativa"></div>
            </div>
        </div>

        <div class="galeria-grid">

            <?php
            $categorias = [
                1 => "Nuestra escuela",
                2 => "Proyectos",
                3 => "Entornos Formativos",
            ];

            foreach ($categorias as $idCat => $nombreCat) {
                $query = "SELECT imagen_ruta FROM galeria_institucional WHERE categoria_id = $idCat ORDER BY id DESC";
                $resultado = mysqli_query($conexion, $query);
            ?>

                <article class="tarjeta-galeria" data-card="<?php echo $idCat; ?>">

                    <div class="galeria-imagen">

                        <div class="carrusel-slides">

                            <?php
                            if ($resultado && mysqli_num_rows($resultado) > 0) {

                                $contador = 0;

                                while ($foto = mysqli_fetch_assoc($resultado)) {

                                    $claseActive = ($contador === 0) ? 'slide active' : 'slide';

                                    echo '<img src="' . htmlspecialchars($foto['imagen_ruta']) . '" class="' . $claseActive . '" alt="' . htmlspecialchars($nombreCat) . '" loading="lazy">';

                                    $contador++;
                                }

                            } else {

                                echo '<img src="imgs/default-galeria.jpg" class="slide active" alt="' . htmlspecialchars($nombreCat) . '" loading="lazy">';
                            }
                            ?>

                        </div>

                        <button type="button" class="control-galeria control-izq" aria-label="Imagen anterior" onclick="cambiarSlide(<?php echo $idCat; ?>, -1)">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2.5" fill="none">
                                <path d="M15 18l-6-6 6-6"/>
                            </svg>
                        </button>

                        <button type="button" class="control-galeria control-der" aria-label="Imagen siguiente" onclick="cambiarSlide(<?php echo $idCat; ?>, 1)">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2.5" fill="none">
                                <path d="M9 18l6-6-6-6"/>
                            </svg>
                        </button>

                        <div class="galeria-capa">
                            <h3><?php echo htmlspecialchars($nombreCat); ?></h3>
                        </div>

                    </div>

                </article>

            <?php } ?>

        </div>
    </section>

    <script>
    function cambiarSlide(cardNum, dir) {
        const card = document.querySelector('.tarjeta-galeria[data-card="' + cardNum + '"]');
        if (!card) return;

        const slides = card.querySelectorAll('.slide');
        if (slides.length <= 1) return;

        let currentIndex = -1;
        for (let i = 0; i < slides.length; i++) {
            if (slides[i].classList.contains('active')) {
                currentIndex = i;
                break;
            }
        }

        if (currentIndex === -1) currentIndex = 0;

        slides[currentIndex].classList.remove('active');

        let nextIndex = currentIndex + dir;
        if (nextIndex < 0) nextIndex = slides.length - 1;
        if (nextIndex >= slides.length) nextIndex = 0;

        slides[nextIndex].classList.add('active');
    }
    </script>

    <section id="link-contacto" class="contacto-maps">

        <div class="contacto-title">
            <div class="contenedor-titulo">
                <h2>Formando futuros técnicos con pasión</h2>
                <div class="linea-decorativa"></div>
            </div>
        </div>

        <div class="maps-info">

            <div class="columna-mapa">

                <div class="maps">
                    <iframe
                        src="https://maps.google.com/maps?q=Escuela%20Tecnica%203%20Domingo%20Faustino%20Sarmiento%20Mar%20del%20Plata&t=&z=16&ie=UTF8&iwloc=&output=embed"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="direccion-bloque">
                    <h2>Nuestra Ubicación</h2>
                    <p>14 de Julio 2550, Mar del Plata, Buenos Aires</p>

                    <a href="https://maps.google.com/?q=Escuela+Tecnica+3+Mar+del+Plata"
                       target="_blank"
                       class="btn-google-maps">
                        Ver ubicación en Google Maps
                    </a>
                </div>

            </div>

            <div class="info">

                <div class="info-grupo">
                    <h1>Información de Contacto</h1>
                    <p><strong>Email:</strong> contacto@escolat3.edu.ar</p>
                </div>

                <div class="info-grupo">
                    <h2>Horarios de Atención</h2>
                    <p class="horario-texto">Lunes a Viernes: 08:00 - 18:00</p>
                </div>

                <div class="social-seccion">

                    <span>Síguenos en redes sociales</span>

                    <div class="redes-sociales">

                        <a href="https://whatsapp.com/channel/0029Vb4teaqDJ6GzPqMWcu04"
                           target="_blank"
                           class="boton-red"
                           title="WhatsApp">

                            <svg viewBox="0 0 24 24" width="32" height="32">
                                <path fill="#25D366" d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>

                        </a>

                        <a href="https://www.youtube.com/@eest3domingofaustinosarmie948"
                           target="_blank"
                           class="social-icon">

                            <svg viewBox="0 0 24 24">
                                <path fill="#FF0000" d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.516 0-9.388.508a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.872.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>

                        </a>

                        <a href="https://www.facebook.com/p/Escuela-T%C3%A9cnica-3-Domingo-Faustino-Sarmiento-100057481507156/?locale=es_LA"
                           target="_blank"
                           class="social-icon">

                            <svg viewBox="0 0 24 24">
                                <path fill="#1877F2" d="M24 12a12 12 0 1 0-13.875 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385A12 12 0 0 0 24 12z"/>
                            </svg>

                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="divisor-final"></div>

        <div class="bloque-inferior">
            <p>
                © 2026 Escuela de Educación Secundaria Técnica N°3
                "Domingo Faustino Sarmiento". Todos los derechos reservados.
            </p>
        </div>
    </footer>

</body>
</html>