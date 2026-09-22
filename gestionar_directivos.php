<?php
session_start();
include("conexion.php");

// Validar que sea administrador
if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 1) {
    header("Location: iniciarsesion.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

// NUEVO: Si la acción por URL es borrar, eliminamos directamente el registro
if ($accion === 'borrar' && $id > 0) {
    // Opcional: Obtener datos antes de borrar si se requiere para el historial de borrado
    $sql_borrar = "DELETE FROM directivos WHERE id = $id";
    if (mysqli_query($conexion, $sql_borrar)) {
        // Registrar acción en el historial de cambios si la función existe
        if (function_exists('registrarAccion')) {
            registrarAccion($conexion, "Eliminó al directivo con ID: $id");
        }
        header("Location: directivos.php");
        exit();
    } else {
        $error_borrar = "Error al eliminar el registro: " . mysqli_error($conexion);
    }
}

$turno = '';
$nombre = '';
$cargo = '';
$descripcion = '';
$accion_titulo = "Añadir Nuevo Directivo";

// Si viene un ID y no es para borrar, estamos editando -> cargamos los datos actuales
if ($id > 0 && $accion !== 'borrar') {
    $accion_titulo = "Editar Directivo";
    $query = mysqli_query($conexion, "SELECT * FROM directivos WHERE id = $id");
    if ($row = mysqli_fetch_assoc($query)) {
        $turno = $row['turno'];
        $nombre = $row['nombre'];
        $cargo = $row['cargo'];
        $descripcion = $row['descripcion'];
    }
}

// Procesar formulario al enviar (Guardar Cambios)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $turno_post = mysqli_real_escape_string($conexion, $_POST['turno']);
    $nombre_post = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cargo_post = mysqli_real_escape_string($conexion, $_POST['cargo']);
    $descripcion_post = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $id_post = intval($_POST['id_directivo']);

    if ($id_post > 0) {
        // Actualizar registro existente
        $sql = "UPDATE directivos SET turno = '$turno_post', nombre = '$nombre_post', cargo = '$cargo_post', descripcion = '$descripcion_post' WHERE id = $id_post";
    } else {
        // Insertar nuevo registro
        $sql = "INSERT INTO directivos (turno, nombre, cargo, descripcion) VALUES ('$turno_post', '$nombre_post', '$cargo_post', '$descripcion_post')";
    }

    if (mysqli_query($conexion, $sql)) {
        // Registrar acción en el historial de cambios de manera idéntica a editar_noticia.php
        if (function_exists('registrarAccion')) {
            if ($id_post > 0) {
                registrarAccion($conexion, "Editó el directivo con ID: $id_post (Nombre: '$nombre_post')");
            } else {
                registrarAccion($conexion, "Agregó un nuevo directivo: '$nombre_post'");
            }
        }

        header("Location: directivos.php");
        exit();
    } else {
        $error = "Error al guardar en la base de datos: " . mysqli_error($conexion);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $accion_titulo; ?> - E.E.S.T N°3</title>
    <link rel="icon" href="imgs/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="gestionar_directivos.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Oswald:wght@600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="form-card">
        <h2><?php echo $accion_titulo; ?></h2>

        <?php if (isset($error)): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (isset($error_borrar)): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error_borrar); ?></div>
        <?php endif; ?>

        <form action="gestionar_directivos.php<?php echo $id > 0 ? '?id=' . $id : ''; ?>" method="POST">
            <!-- Campo oculto para llevar el ID en caso de edición -->
            <input type="hidden" name="id_directivo" value="<?php echo $id; ?>">

            <div class="form-group">
                <label for="turno">Turno:</label>
                <select name="turno" id="turno" required>
                    <option value="Turno Mañana" <?php echo ($turno === 'Turno Mañana') ? 'selected' : ''; ?>>Turno Mañana</option>
                    <option value="Turno Tarde" <?php echo ($turno === 'Turno Tarde') ? 'selected' : ''; ?>>Turno Tarde</option>
                    <option value="Turno Noche" <?php echo ($turno === 'Turno Noche') ? 'selected' : ''; ?>>Turno Noche</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre y Apellido:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" placeholder="Ej: Juan Pérez" required>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($cargo); ?>" placeholder="Ej: DIRECTOR / COORDINADOR" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción / Breve Biografía:</label>
                <textarea name="descripcion" id="descripcion" placeholder="Detalles o trayectoria..."><?php echo htmlspecialchars($descripcion); ?></textarea>
            </div>

            <button type="submit" class="btn-guardar">Guardar Cambios</button>
        </form>

        <a href="directivos.php" class="volver-link">← Volver a Directivos</a>
    </div>

</body>
</html>