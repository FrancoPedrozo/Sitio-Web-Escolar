<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}

require 'conexion.php';

$resultado = $conexion->query("SELECT * FROM historial_cambios ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N°3 - Historial de Actividad</title>
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
            max-width: 1000px;
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
            color: white;
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

        .tabla-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: rgba(17, 17, 17, 0.8);
            color: #3dff67;
            font-family: 'Google Sans Flex', sans-serif;
            font-size: 13px;
            font-weight: 700;
            padding: 14px 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.08);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.02);
            color: #ffffff;
        }

        .sin-registros {
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            padding: 25px;
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
                padding: 25px 18px;
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

            th, td {
                padding: 10px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Panel de Administración</h1>
        <div class="nav-links">
            <a href="index.php">Ver Inicio</a>
            <a href="admin.php">Volver al Panel</a>
            <a href="noticias.php">Noticias</a>
            <a href="cerrar_sesion.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <div class="container">
        <h3>Historial de Actividad</h3>
        <div class="tabla-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Acción Realizada</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
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
                            <td colspan="4" class="sin-registros">No hay registros de actividad todavía.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>