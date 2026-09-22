<?php
session_start();
require 'conexion.php';

// Validar que sea administrador (ajusta la condición según tu sistema, ej: id_tipo == 1)
if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 1) {
    header("Location: iniciarsesion.php");
    exit();
}

$page_title = "E.E.S.T N°3 - Historial de Actividad";
$extra_css = '<style>
    .contenido-historial { padding: 120px 5% 50px 5%; max-width: 1200px; margin: 0 auto; color: white; font-family: "Montserrat", sans-serif; }
    h1 { color: #3dff67; font-family: "Oswald", sans-serif; margin-bottom: 25px; text-transform: uppercase; font-size: 28px; }
    .tabla-container { width: 100%; overflow-x: auto; background: rgba(36, 35, 35, 0.7); backdrop-filter: blur(8px); border-radius: 12px; border: 1.5px solid rgba(255, 255, 255, 0.05); padding: 20px; box-shadow: 0 20px 45px rgba(0, 0, 0, 0.7); }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { padding: 14px 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); text-align: left; font-size: 14px; }
    th { background: #01203c; color: #3dff67; font-weight: bold; font-family: "Google Sans Flex", sans-serif; }
    tr:hover { background: rgba(255, 255, 255, 0.02); }
    td { color: rgba(255, 255, 255, 0.9); }
    .btn-volver { display: inline-block; margin-bottom: 20px; color: #1b1a1a; background: #3dff67; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 13px; transition: background 0.3s; }
    .btn-volver:hover { background: white; }
</style>';

include 'header.php';

$resultado = $conexion->query("SELECT * FROM historial_cambios ORDER BY fecha DESC");
?>

<div class="contenido-historial">
    <a href="noticias.php" class="btn-volver">← Volver</a>
    <h1>Registro de Actividad Administrativa</h1>
    
    <div class="tabla-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Acción Realizada</th>
                <th>Fecha y Hora</th>
            </tr>
            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <?php while($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($row['accion']); ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center; color: #888;">No hay registros de actividad todavía.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>

</body>
</html>