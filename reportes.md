# Reportes de falla

## Noticias: se puede borrar una noticia sin iniciar sesión, solo con la URL

- **Reporta:** Equipo entero (Raiquen, Valentino, Axel y Franco)
- **Escalón:** 1 · rompe datos
- **Pasos:**
  1. Con la sesión cerrada, abrir `http://localhost/tecnica3/tecnica3/noticias.php` y anotar el `Id_noticia` de una noticia de prueba en phpMyAdmin (tabla `noticias`, por ejemplo 8).
  2. En la barra de direcciones escribir `http://localhost/tecnica3/tecnica3/procesar_eliminar_noticia.php?id=8`.
  3. Presionar Enter y volver a `noticias.php`.
- **Esperado:** rechaza el pedido y manda a iniciar sesión ya que solo el administrador puede borrar.
- **Obtenido:** borra la noticia 8 sin pedir sesión y vuelve a Noticias.
- **Evidencia:** `procesar_eliminar_noticia.php`, líneas 2 a 8: no hay `session_start()` ni control de rol, y borra por GET.
- **Estado:** abierta

## Noticias: un alumno puede editar noticias escribiendo la URL

- **Reporta:** Equipo entero (Raiquen, Valentino, Axel y Franco)
- **Escalón:** 1 · rompe datos
- **Pasos:**
  1. Desde «Crear cuenta», registrar el usuario `alumno1` (queda con rol alumno) e iniciar sesión con esa cuenta.
  2. Abrir `http://localhost/tecnica3/tecnica3/editar_noticia.php?id=1`.
  3. Cambiar el título a «Prueba alumno» y tocar «Guardar Cambios».
- **Esperado:** rechaza el pedido porque solo administradores pueden editar.
- **Obtenido:** guarda el cambio y Noticias muestra «Prueba alumno».
- **Evidencia:** `editar_noticia.php` línea 6: solo verifica `$_SESSION['usuario']`, no `id_tipo == 1`.
- **Estado:** abierta

## Equipo de conducción: un alumno ve botones de administración que no funcionan

- **Reporta:** Equipo entero (Raiquen, Valentino, Axel y Franco)
- **Escalón:** 2 · engaña
- **Pasos:**
  1. Iniciar sesión como `alumno1`.
  2. Abrir Equipo de conducción desde el menú.
  3. Tocar «Añadir» (o «Editar» en una tarjeta).
- **Esperado:** el alumno no ve los botones de administración.
- **Obtenido:** los ve, y al tocarlos lo manda a «Iniciar sesión» estando ya logueado.
- **Evidencia:** `equipo.php` línea 8: `$es_admin = isset($_SESSION['usuario'])` (vale para cualquier usuario logueado). `noticias.php` línea 935 sí verifica `id_tipo == 1`.
- **Estado:** abierta

## Crear cuenta: un usuario repetido muestra un error técnico de MySQL

- **Reporta:** Equipo entero (Raiquen, Valentino, Axel y Franco)
- **Escalón:** 3 · molesta
- **Pasos:**
  1. Con la sesión cerrada, abrir «Crear cuenta».
  2. Usuario `admin` (ya existe), un correo cualquiera y una clave.
  3. Enviar el formulario.
- **Esperado:** un aviso claro, por ejemplo «Ese usuario ya existe».
- **Obtenido:** `Error: Duplicate entry 'admin' for key 'usuario'` (o un error fatal, según la versión de PHP).
- **Evidencia:** `procesarregistro.php` línea 21 imprime `mysqli_error()`; `tecnica3.sql` línea 284 define `UNIQUE KEY usuario`.
- **Estado:** abierta

## Panel de administración: recargar la página duplica la imagen subida

- **Reporta:** Equipo entero (Raiquen, Valentino, Axel y Franco)
- **Escalón:** 3 · molesta
- **Pasos:**
  1. Iniciar sesión como `admin` y abrir `admin.php`.
  2. En «Subir Imagen a Galería Institucional»: título «Proyectos5», categoría 2 y una imagen JPG. Tocar «SUBIR A LA GALERÍA».
  3. Presionar F5 y confirmar el reenvío del formulario.
- **Esperado:** no se vuelve a subir nada.
- **Obtenido:** se agrega una segunda fila «Proyectos5».
- **Evidencia:** `admin.php` procesa el POST sin redirigir después de guardar.
- **Estado:** abierta