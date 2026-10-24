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
    <title>E.E.S.T N°3 | Noticias</title>
    <link rel="icon" href="imgs/logo.png">
    <link rel="stylesheet" href="noticias.css">
</head>
<body>

<style>
@import url('https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&family=Montserrat:wght@400;500;600;700;800&family=Oswald:wght@700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    color: inherit;
    user-select: none;
}
body {
    min-height: 100vh;
    background-color: #121518;
    font-family: 'Montserrat', sans-serif;
}
.check-menu, .check-creditos {
    display: none;
}
nav {
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    height: 9%;
    width: 100%;
    padding: 0 16%;
    background-color: rgba(0, 0, 0, 0);
    animation: fijarBarra linear both;
    animation-timeline: scroll(root);
    animation-range: 0px 300px;
    z-index: 999;
}
@keyframes fijarBarra {
    from {
        background-color: rgba(0, 0, 0, 0);
        padding: 0 16%;
    }
    to {
        background-color: black; 
        padding: 0 14%;
    }
}
.logo-seccion {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 15px;
    height: 100%;
}
.logo, .seccion {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.seccion {
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;
    font-style: normal;
    align-items: flex-start;
}
.seccion h1 {
    color: white;
    font-size: 18px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 1px;
    margin-bottom: 3px;
}
.seccion p {
    color: #3dff67;
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 1px;
}
.logo a {
    display: flex;
    align-items: center;
    height: 100%;
    width: auto;
}
.logo img {
    height: 60%;
    width: auto;
}
.login-opc {
    display: flex;
    align-items: center;
    gap: 20px;
    height: 100%;
}
.login {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
}
.login a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
.login img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    cursor: pointer;
}
.menu-btn {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 32px;
    height: 32px;
    cursor: pointer;
    padding: 4px 0;
}
.menu-btn .linea {
    width: 100%;
    height: 3px;
    background-color: white;
    border-radius: 2px;
}
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
    cursor: default;
}
.menu-lateral {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: 100%;
    background-color: #111;
    z-index: 1000;
    transition: right 0.3s ease;
    padding: 60px 30px;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.5);
    text-transform: uppercase;
}
.cerrar-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    color: white;
    font-size: 30px;
    cursor: pointer;
}
.menu-lateral ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 20px;
    font-family: 'Montserrat', sans-serif;
}
.menu-lateral ul li {
    display: flex;
}
.menu-lateral ul li a,
.btn-menu-creditos {
    text-decoration: none;
    color: white;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.35;
    transition: color 0.2s ease, border-color 0.2s ease;
    display: inline-block;
    border-bottom: 2px solid transparent;
    padding-bottom: 5px;
    cursor: pointer;
    word-break: break-word;
    white-space: normal;
    letter-spacing: 1px;
}
.menu-lateral ul li a:hover {
    color: #3dff67;
    border-bottom: 2px solid #3dff67;
}
.btn-menu-creditos:hover {
    color: #3dff67;
}
.menu-lateral ul li .activo {
    color: #3dff67;
    font-size: 18px;
    font-weight: 700;
    cursor: default;
    display: inline-block;
    border-bottom: 2px solid #3dff67;
    padding-bottom: 5px;
}
.check-menu:checked ~ .overlay {
    opacity: 1;
    visibility: visible;
}
.check-menu:checked ~ .menu-lateral {
    right: 0;
}
@media (max-width: 768px) {
    nav {
        padding: 0 6%;
    }
@keyframes fijarBarra {
        from {
            background-color: rgba(0, 0, 0, 0);
            padding: 0 6%; 
        }
        to {
            background-color: black; 
            padding: 0 4%; 
        }
    }
    .seccion h1 {
        font-size: 15px;
    }
    .seccion p {
        font-size: 12px;
    }
    .menu-lateral {
        width: 250px;
        right: -250px;
    }
}
.wallper {
    position: relative;
    height: 60vh;
    width: 100%;
    background-image: url(imgs/wallper5.png); 
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 1;
    display: flex;
    flex-direction: column;
}

.noticias-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    background-color: #121518;
    padding: 80px 11%;
    gap: 50px;
}

.noticias-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    width: 100%;
    max-width: 800px;
    gap: 15px;
}

.noticias-header h1 {
    color: white;
    font-family: "Oswald", sans-serif;
    font-size: clamp(2rem, 4vw, 3rem);
    letter-spacing: 1px;
    font-weight: 600;
    text-transform: uppercase;
    border-bottom: 2px solid #3dff67;
}

.noticias-header p {
    color: #cccccc;
    font-family: "Google Sans Flex", sans-serif;
    font-size: 16px;
    line-height: 1.6;
    font-weight: 400;

}

.btn-subir-noticia {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background-color: #3dff67;
    color: #000000;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-family: "Montserrat", sans-serif;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(61, 255, 103, 0.2);
    margin-top: 10px;
}

.btn-subir-noticia:hover {
    box-shadow: 0 6px 20px rgba(61, 255, 103, 0.4);
}

.noticias-grid {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    align-items: start;
}

.noticia-card {
    display: flex;
    flex-direction: column;
    background-color: rgba(36, 35, 35, 0.4);
    backdrop-filter: blur(6px);
    border: 1.5px solid rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    text-align: left;
}

.noticia-card:hover {
    border-color: #3dff67;
}

.card-img-wrapper {
    position: relative;
    width: 100%;
    height: 200px;
}

.card-img {
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-color: #242323;
}

.card-info {
    padding: 25px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    cursor: pointer;
}

.fecha {
    color: #3dff67;
    font-family: "Google Sans Flex", sans-serif;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 12px;
}

.card-info h3 {
    color: white;
    font-family: "Montserrat", sans-serif;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.3;
    margin-top: 0;
    margin-bottom: 12px;
}

.card-info p {
    color: #a6a6a6;
    font-family: "Google Sans Flex", sans-serif;
    font-size: 13.5px;
    line-height: 1.5;
    margin-bottom: 15px;
    flex-grow: 1;
}

.admin-acciones {
    margin-top: auto;
    display: flex;
    gap: 12px;
    padding: 0 25px 25px 25px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 15px;
}

.btn-editar {
    background-color: rgba(255, 204, 0, 0.15);
    color: #ffcc00;
    border: 1px solid #ffcc00;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-family: "Montserrat", sans-serif;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 0.5px;
    transition: all 0.2s ease;
}

.btn-editar:hover {
    background-color: #ffcc00;
    color: #1b1a1a;
    transform: translateY(-1px);
}

.btn-borrar {
    background-color: rgba(255, 77, 77, 0.15);
    color: #ff4d4d;
    border: 1px solid #ff4d4d;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-family: "Montserrat", sans-serif;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 0.5px;
    transition: all 0.2s ease;
}

.btn-borrar:hover {
    background-color: #ff4d4d;
    color: white;
    transform: translateY(-1px);
}

.btn-ver-mas {
    display: inline-block;
    margin-top: 5px;
    color: #3dff67;
    font-size: 13px;
    font-weight: 600;
    font-family: "Google Sans Flex", sans-serif;
    transition: color 0.2s ease, transform 0.2s ease;
}

.card-info:hover .btn-ver-mas {
    color: #ffffff;
    text-decoration: underline;
}

.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(8px);
    z-index: 10000;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-content {
    background-color: #242323;
    border: 1.5px solid rgba(61, 255, 103, 0.3);
    border-radius: 20px;
    width: 100%;
    max-width: 700px;
    max-height: 85vh;
    overflow-y: auto;
    padding: 30px;
    color: white;
    position: relative;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
    animation: escalarModal 0.3s ease;
}

@keyframes escalarModal {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.modal-cerrar {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    color: #fff;
    font-size: 32px;
    cursor: pointer;
    transition: color 0.2s;
}

.modal-cerrar:hover {
    color: #3dff67;
}

#modalImg {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 20px;
}

.modal-fecha {
    font-size: 13px;
    color: #3dff67;
    font-family: "Google Sans Flex", sans-serif;
    display: block;
    margin-bottom: 8px;
}

#modalTitulo {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 15px;
    font-family: "Montserrat", sans-serif;
}

.modal-texto-completo {
    font-size: 16px;
    color: #e0e0e0;
    line-height: 1.6;
    font-family: "Google Sans Flex", sans-serif;
    user-select: text;
}

.enlaces-sociales {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 15px;
}

.boton-red {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease;
}

.boton-red:hover {
    transform: scale(1.1);
}

.boton-red svg {
    width: 28px;
    height: 28px;
}

@media (max-width: 992px) {
    .noticias-container {
        padding: 60px 5%;
    }
    .noticias-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .wallper {
        height: 50vh;
    }
    .noticias-grid {
        grid-template-columns: 1fr;
    }
    .btn-subir-noticia {
        width: 100%;
        max-width: 320px;
    }
}

@media (max-width: 480px) {
    .noticias-container {
        padding: 40px 4%;
        gap: 30px;
    }
    .modal-content {
        padding: 20px;
    }
    #modalImg {
        height: 200px;
    }
}
.filtro {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: linear-gradient(to bottom, #1a5b0b79, #01203cd8);
    z-index: 2;
}
.titulo {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex-grow: 1;
    padding-left: 11%;
    padding-right: 11%;
    z-index: 3;
    color: white;
}
.titulo h1 {
    font-family: "Oswald", sans-serif;
    font-size: clamp(2.5rem, 6vw, 4.5rem);
    font-weight: 800;
    font-style: italic;
    letter-spacing: 1px;
    line-height: 1.1;
}
.creditos {
    position: absolute;
    bottom: 20px;
    right: 5%;
    z-index: 4;
    font-family: "Google Sans Flex", sans-serif;
}
.creditos label {
    font-size: 13px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.4);
    letter-spacing: 1.3px;
    text-transform: uppercase;
    transition: color 0.4s cubic-bezier(0.25, 1, 0.5, 1), text-shadow 0.4s cubic-bezier(0.25, 1, 0.5, 1);
    background-color: transparent;
    outline: none;
    border: none;
    cursor: pointer;
}
.creditos label:hover {
    color: #3dff67;
    text-shadow: 0 0 8px rgba(61, 255, 103, 0.6);
}
@media (max-width: 768px) {
    .creditos {
        right: 0;
        left: 0;
        bottom: 10px;
        text-align: center;
    }
    
    .creditos span {
        font-size: 9px;
        letter-spacing: 0.5px;
    }
}
.creditos-pantalla {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1001;
    visibility: hidden;
    opacity: 0;
    transition: all 0.3s ease;
}
.fondo-creditos {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    cursor: default;
}
.pantalla {
    position: relative;
    width: 90%;
    max-width: 500px;
    background-color: #111;
    border: 1px solid #3dff67;
    border-radius: 8px;
    padding: 30px 25px;
    z-index: 1002;
    box-shadow: 0 0 20px rgba(61, 255, 103, 0.2);
    font-family: 'Montserrat', sans-serif;
    color: white;
}
.cerrar-creditos {
    position: absolute;
    top: 15px;
    right: 20px;
    color: white;
    font-size: 28px;
    cursor: pointer;
    line-height: 1;
    transition: color 0.2s ease;
}
.cerrar-creditos:hover {
    color: #3dff67;
}
.pantalla h2 {
    font-size: 24px;
    font-weight: 700;
    color: white;
    margin-bottom: 5px;
    text-align: center;
}
.pantalla .subtitulo {
    font-size: 14px;
    color: #3dff67;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}
.lista-desarrolladores {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.desarrollador {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 5px;
    border-left: 3px solid #3dff67;
}
.desarrollador .nombre {
    font-size: 15px;
    font-weight: 500;
    color: white;
}
.desarrollador .rol {
    font-size: 12px;
    font-weight: 700;
    color: #3dff67;
    letter-spacing: 1px;
    background-color: rgba(61, 255, 103, 0.1);
    padding: 4px 8px;
    border-radius: 4px;
}
.check-creditos:checked ~ .creditos-pantalla {
    visibility: visible;
    opacity: 1;
}
@media (max-width: 768px) {
    .pantalla {
        width: 92%;
        padding: 25px 18px;
    }
    .pantalla h2 {
        font-size: 20px;
    }
    .pantalla .subtitulo {
        font-size: 13px;
        margin-bottom: 20px;
    }
    .desarrollador {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    .desarrollador .nombre {
        font-size: 14px;
    }
    .desarrollador .rol {
        font-size: 11px;
    }
}
footer {
    width: 100%;
    background-color: #121518;
    padding: 0 70px 40px 70px;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
}
.divisor-final {
    width: 100%;
    height: 1px;
    background-color: #242323;
    margin-bottom: 40px;
}
.bloque-inferior {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
    width: 100%;
    text-align: center;
}
.bloque-inferior p {
    color: #888888;
    font-size: 14px;
    font-family: "Google Sans Flex", sans-serif;
    letter-spacing: 0.3px;
    line-height: 1.5;
    margin: 0;
}
@media (max-width: 768px) {
    footer {
        padding: 0 20px 30px 20px;
    }
    
    .divisor-final {
        margin-bottom: 30px;
    }
    
    .bloque-inferior p {
        font-size: 12px;
        padding: 0 10px;
    }
}
</style>

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
            <div class="logo"><a href="index.php"><img src="imgs/logo.png" alt="Logo"></a></div>
            <div class="seccion"><h1>E.E.S.T N°3</h1><p>NOTICIAS</p></div>
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
            <li><a href="index.php">Inicio</a></li>
            <li><span class="activo">Noticias</span></li>
            <li><a href="quienessomos.php">¿Quiénes Somos?</a></li>
            <li><a href="equipo.php">Equipo De Conducción</a></li>
            <li><a href="ciclobasico.php">Ciclo Básico</a></li>
            <li><a href="ctp.php">Ciclos Técnicos Profesionales</a></li>
            <li><label for="check-creditos" class="btn-menu-creditos">Desarrolladores</label></li>
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
            <h1>NOTICIAS</h1>
        </div>

        <div class="creditos">
            <label for="check-creditos">sitio web desarrollado por estudiantes de la institución</label>
        </div>
    </div>

    <div class="noticias-container">
        <div class="noticias-header">
            <h1>Novedades Institucionales</h1>
            <p>Enterate de los últimos eventos, comunicados oficiales y actividades académicas.</p>
            <?php if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 1): ?>
                <a href="subir_noticia.php" class="btn-subir-noticia">SUBIR NUEVA NOTICIA</a>
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

    <footer>
        <div class="divisor-final"></div>       
        <div class="bloque-inferior">
            <p>© 2026 Escuela de Educación Secundaria Técnica N°3 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>