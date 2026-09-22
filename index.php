<?php
$page_title = "E.E.S.T N°3 - Inicio";
include 'header.php';
include 'conexion.php';
?>

    <div class="wallper">
        <div class="filtro"></div>
        <div class="titulo">
            <h1>E.E.S.T N°3</h1>
            <h2>Domingo Faustino Sarmiento</h2>
            <p class="lema-escuela" style="color: #00ff00; font-weight: 700; font-size: 1.2rem; margin-top: 5px; letter-spacing: 2px;">Patria, Trabajo y Cultura</p>
        </div>
       <div class="creditos">
            <span>Sitio web desarrollado por: <strong>Franco Pedrozo, Valentino Petovello, Axel Molina Perez y Raiquen Fernandez Farias</strong> (Curso: 7° - Año: 2026).</span>
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
                3 => "Entornos Formativos",
                4 => "Prácticas Profesionales",
                5 => "Novedades",
                6 => "Eventos y Actos"
            ];

            foreach ($categorias as $idCat => $nombreCat) {
                $query = "SELECT imagen_ruta FROM galeria_institucional WHERE categoria_id = $idCat ORDER BY id DESC";
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
                    <p><strong>Email:</strong> tecnica3gpueyrredon@abc.gob.ar</p>
                </div>
                <div class="info-grupo" style="margin-top: 20px;">
                    <h2>Nuestras Redes</h2>
                    <div class="enlaces-sociales" style="display: flex; gap: 15px; margin-top: 10px;">
                        <a href="https://whatsapp.com/channel/0029Vb4teaqDJ6GzPqMWcu04" target="_blank" class="boton-red" title="WhatsApp">
                            <svg viewBox="0 0 24 24" width="32" height="32"><path fill="#25D366" d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/p/Escuela-T%C3%A9cnica-3-Domingo-Faustino-Sarmiento-100057481507156/?locale=es_LA" target="_blank" class="boton-red" title="Facebook">
                            <svg viewBox="0 0 24 24" width="32" height="32"><path fill="#1877F2" d="M24 12a12 12 0 1 0-13.875 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385A12 12 0 0 0 24 12z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/@eest3domingofaustinosarmie948" target="_blank" class="boton-red" title="YouTube">
                            <svg viewBox="0 0 24 24" width="32" height="32"><path fill="#FF0000" d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.516 0-9.388.508a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.872.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
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