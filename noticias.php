<?php
$page_title = "E.E.S.T N°3 - Noticias";
$extra_css = '<link rel="stylesheet" href="noticias.css">';
include 'header.php';
require 'conexion.php';
?>

    <div class="wallper">
        <div class="filtro"></div>
        <div class="titulo"><h1>NOTICIAS</h1></div>
    </div>

    <div class="noticias-container">
        <div class="noticias-header">
            <h1>Novedades Institucionales</h1>
            <p>Enterate de los últimos eventos, comunicados oficiales y actividades académicas.</p>
            <?php if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1): ?>
                <a href="subir_noticia.php" class="btn-subir-noticia">+ SUBIR NUEVA NOTICIA</a>
            <?php endif; ?>
        </div>

        <div class="noticias-grid">
            <?php
            $resultado = $conexion->query("SELECT * FROM noticias ORDER BY Fecha_noticia DESC");
            if ($resultado && $resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $id_noticia = $row['Id_noticia'];
                    $fecha_formateada = date('d \d\e F, Y - H:i', strtotime($row['Fecha_noticia'])) . ' hs';
                    $imagen_ruta = 'uploads/' . $row['Foto_noticia'];
                    
                    $texto_completo = $row['Descripcion_noticia'];
                    $limite = 150;
                    $es_largo = mb_strlen($texto_completo) > $limite;
                    $texto_mostrado = $es_largo ? mb_substr($texto_completo, 0, $limite) . '...' : $texto_completo;
            ?>
            <div class="noticia-card">
                <div class="card-img-wrapper">
                    <div class="card-img" style="background-image: url('<?php echo $imagen_ruta; ?>');"></div>
                </div>
                
                <div class="card-info" 
                     onclick="abrirModal(this)"
                     data-titulo="<?php echo htmlspecialchars($row['Titulo_noticia'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-texto="<?php echo htmlspecialchars($texto_completo, ENT_QUOTES, 'UTF-8'); ?>"
                     data-fecha="<?php echo htmlspecialchars($fecha_formateada, ENT_QUOTES, 'UTF-8'); ?>"
                     data-imagen="<?php echo htmlspecialchars($imagen_ruta, ENT_QUOTES, 'UTF-8'); ?>">
                    <span class="fecha"><?php echo $fecha_formateada; ?></span>
                    <h3><?php echo htmlspecialchars($row['Titulo_noticia'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($texto_mostrado, ENT_QUOTES, 'UTF-8')); ?></p>
                    
                    <?php if ($es_largo): ?>
                        <span class="btn-ver-mas">Ver más</span>
                    <?php endif; ?>
                </div>

                <?php if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1): ?>
                    <div class="admin-acciones">
                        <a href="editar_noticia.php?id=<?php echo $id_noticia; ?>" class="btn-editar">Editar</a>
                        <a href="procesar_eliminar_noticia.php?id=<?php echo $id_noticia; ?>" class="btn-borrar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta noticia?');">Borrar</a>
                    </div>
                <?php endif; ?>
            </div>
            <?php 
                }
            } else {
                echo '<p style="color: #888; grid-column: 1 / -1; text-align: center; padding: 40px;">No hay noticias cargadas todavía.</p>';
            }
            ?>
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
                <a href="https://whatsapp.com/channel/0029Vb4teaqDJ6GzPqMWcu04" target="_blank" class="boton-red" title="WhatsApp">
                    <svg viewBox="0 0 24 24" width="32" height="32"><path fill="#25D366" d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                </a>
            </div>
        </div>
    </footer>

    <div id="modalNoticia" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-cerrar" onclick="cerrarModal()">&times;</button>
            <img id="modalImg" src="" alt="Imagen de la noticia">
            <span id="modalFecha" class="modal-fecha"></span>
            <h2 id="modalTitulo"></h2>
            <div id="modalTexto" class="modal-texto-completo"></div>
        </div>
    </div>

    <script>
        function abrirModal(elemento) {
            const info = elemento.querySelector('.card-info') || elemento;
            
            const titulo = info.getAttribute('data-titulo');
            const texto = info.getAttribute('data-texto');
            const fecha = info.getAttribute('data-fecha');
            const imagen = info.getAttribute('data-imagen');

            document.getElementById('modalTitulo').innerText = titulo;
            document.getElementById('modalTexto').innerText = texto;
            document.getElementById('modalFecha').innerText = fecha;
            document.getElementById('modalImg').src = imagen;

            document.getElementById('modalNoticia').style.display = 'flex';
        }

        function cerrarModal() {
            document.getElementById('modalNoticia').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalNoticia');
            if (event.target === modal) {
                cerrarModal();
            }
        }
    </script>
</body>
</html>