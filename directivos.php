<?php
$page_title = "E.E.S.T N°3 - Cuerpo Directivo";
$extra_css = '<link rel="stylesheet" href="directivos.css">';
include 'header.php';
include("conexion.php");
$es_admin = (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1);
?>

    <div class="directivos-container" style="margin-top: 100px;">
        <div class="directivos-titulo">
            <h1>Cuerpo Directivo e Institucional</h1>
            <p>Conocé a las autoridades que coordinan y guían las actividades de nuestra institución en sus diferentes turnos.</p>
        </div>

        <?php if ($es_admin): ?>
            <div style="width: 100%; text-align: left;">
                <a href="gestionar_directivos.php?accion=nuevo" class="btn-agregar-general">+ Añadir Nuevo Directivo</a>
            </div>
        <?php endif; ?>

        <?php
        $turnos = ['Turno Mañana', 'Turno Tarde', 'Turno Noche'];
        
        foreach ($turnos as $turno) {
            $query = mysqli_query($conexion, "SELECT * FROM directivos WHERE turno = '$turno'");
            if (mysqli_num_rows($query) > 0) {
                echo '<div class="turno-seccion">';
                echo '<div class="turno-titulo"><h1>' . $turno . '</h1></div>';
                echo '<div class="tarjetas-container">';
                
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="tarjeta">';
                    echo '<div class="nombre"><p>' . htmlspecialchars($row['nombre']) . '</p></div>';
                    echo '<div class="cargo"><p>' . htmlspecialchars($row['cargo']) . '</p></div>';
                    echo '<div class="descripcion"><p>' . htmlspecialchars($row['descripcion']) . '</p></div>';
                    
                    if ($es_admin) {
                        echo '<div class="admin-acciones">';
                        echo '<a href="gestionar_directivos.php?accion=editar&id=' . $row['id'] . '" class="btn-editar">Editar</a>';
                        echo '<a href="gestionar_directivos.php?accion=borrar&id=' . $row['id'] . '" class="btn-borrar" onclick="return confirm(\'¿Estás seguro de eliminar este directivo?\');">Borrar</a>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                }
                
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
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
</body>
</html>