<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}

$page_title = "E.E.S.T N°3 - Subir Noticia";

ob_start();
?>
<style>
    body {
        background-color: #121212;
    }
    .form-container {
        max-width: 650px;
        margin: 120px auto 50px auto; 
        background: #181818;
        padding: 35px;
        border-radius: 12px;
        border: 1px solid #333;
        box-shadow: 0 10px 25px rgba(0,0,0,0.6);
    }
    .form-container h2 {
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 25px;
        text-align: center;
        letter-spacing: 1px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        color: #bbb;
        margin-bottom: 8px;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
    }
    .form-group input[type="text"],
    .form-group textarea,
    .form-group input[type="file"] {
        width: 100%;
        padding: 12px;
        background: #222;
        border: 1px solid #444;
        color: #fff;
        border-radius: 6px;
        font-family: 'Montserrat', sans-serif;
        box-sizing: border-box;
    }
    .form-group textarea {
        resize: vertical;
        height: 140px;
    }
    .btn-enviar {
        background-color: #3dff67;
        color: #000;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        transition: background 0.3s ease;
    }
    .btn-enviar:hover {
        background-color: #2ecc52;
    }
</style>
<?php
$extra_css = ob_get_clean();
include 'header.php';
?>

<div class="form-container">
    <h2>PANEL DE ADMINISTRACIÓN - SUBIR NOTICIA</h2>
    <form action="procesar_noticia.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Título de la noticia:</label>
            <input type="text" name="titulo" placeholder="Ej: Nueva tecnología en laboratorios" required>
        </div>
        <div class="form-group">
            <label>Descripción detallada:</label>
            <textarea name="descripcion" placeholder="Escribe el cuerpo de la novedad institucional..." required></textarea>
        </div>
        <div class="form-group">
            <label>Imagen ilustrativa:</label>
            <input type="file" name="foto" required>
        </div>
        <button type="submit" class="btn-enviar">Publicar Noticia</button>
    </form>
</div>
</body>
</html>