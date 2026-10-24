<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Subir Noticia</title>
    <link rel="icon" href="imgs/logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&family=Montserrat:wght@500;600;700&family=Oswald:wght@600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            user-select: none;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1b1a1a;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background-color: rgba(17, 17, 17, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10%;
            z-index: 1000;
        }

        header h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 22px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-links a {
            font-family: 'Google Sans Flex', sans-serif;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
            background-color: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .nav-links a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .nav-links a.btn-logout {
            color: white;
            background-color: rgb(177, 19, 19);
        }

        .container {
            width: 100%;
            max-width: 680px;
            margin: 110px auto 50px auto;
            background-color: rgba(36, 35, 35, 0.65);
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 40px 35px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.7);
        }

        h3 {
            font-family: 'Oswald', sans-serif;
            color: #3dff67;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h3::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 18px;
            background-color: #3dff67;
            border-radius: 2px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            font-family: 'Google Sans Flex', sans-serif;
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            background-color: rgba(27, 26, 26, 0.8);
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            padding: 12px 16px;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"] {
            height: 46px;
        }

        textarea {
            resize: vertical;
            min-height: 140px;
        }

        input[type="file"] {
            height: 46px;
            padding: 8px 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        input[type="text"]:focus, textarea:focus, input[type="file"]:focus {
            border-color: #3dff67;
            box-shadow: 0 0 12px rgba(61, 255, 103, 0.2);
        }

        button {
            cursor: pointer;
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 8px;
            font-family: 'Google Sans Flex', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-top: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        button:active {
            transform: scale(0.98);
        }

        .btn-green {
            background-color: #3dff67;
            color: #1b1a1a;
        }

        .btn-green:hover {
            background-color: #ffffff;
            color: #000000;
        }

        @media (max-width: 768px) {
            header {
                padding: 0 5%;
                height: auto;
                padding-top: 15px;
                padding-bottom: 15px;
                flex-direction: column;
                gap: 12px;
            }

            .container {
                margin-top: 140px;
                padding: 30px 20px;
                width: 92%;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            header h1 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Panel de Administración</h1>
        <div class="nav-links">
            <a href="index.php">Ver Inicio</a>
            <a href="noticias.php">Noticias</a>
            <a href="historial.php">Historial</a>
            <a href="cerrar_sesion.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <div class="container">
        <h3 style="color: white;">Subir Noticia</h3>
        <form action="procesar_noticia.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título de la Noticia:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ej: Nueva tecnología en laboratorios" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción Detallada:</label>
                <textarea id="descripcion" name="descripcion" placeholder="Escribe el cuerpo de la novedad institucional..." required></textarea>
            </div>

            <div class="form-group">
                <label for="foto">Imagen Ilustrativa:</label>
                <input type="file" id="foto" name="foto" accept="image/*" required>
            </div>

            <button type="submit" class="btn-green">PUBLICAR NOTICIA</button>
        </form>
    </div>

</body>
</html>