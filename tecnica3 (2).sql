-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2026 a las 16:41:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnica3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades_img`
--

CREATE TABLE `especialidades_img` (
  `id` int(11) NOT NULL,
  `nombre_especialidad` varchar(100) NOT NULL,
  `imagen_ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidades_img`
--

INSERT INTO `especialidades_img` (`id`, `nombre_especialidad`, `imagen_ruta`) VALUES
(1, 'Química', 'uploads/esp_1_6a8235ed09fa0.jpg'),
(2, 'Electrónica', 'uploads/esp_2_6a84a0e09f0aa.jpeg'),
(3, 'Informática', ''),
(4, 'Construcciones', 'uploads/esp_4_6a82368a49cb1.jpeg'),
(5, 'Electromecánica', 'uploads/esp_5_6a82367e26256.jpeg'),
(6, 'Automotores', 'uploads/esp_6_6a823671d4932.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_institucional`
--

CREATE TABLE `galeria_institucional` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen_ruta` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galeria_institucional`
--

INSERT INTO `galeria_institucional` (`id`, `titulo`, `imagen_ruta`, `fecha_subida`, `categoria_id`) VALUES
(24, 'Talleres2', 'uploads/img_6a823ac47e8aa.jpg', '2026-08-16 22:33:40', 3),
(25, 'Talleres3', 'uploads/img_6a823ad071e91.jpg', '2026-08-16 22:33:52', 3),
(27, 'Talleres5', 'uploads/img_6a823ae9945be.jpg', '2026-08-16 22:34:17', 3),
(28, 'Talleres6', 'uploads/img_6a823af5b5753.jpg', '2026-08-16 22:34:29', 3),
(29, 'Talleres7', 'uploads/img_6a823b07dba65.jpg', '2026-08-16 22:34:47', 3),
(30, 'Talleres8', 'uploads/img_6a823b16d307d.jpg', '2026-08-16 22:35:02', 3),
(31, 'Talleres9', 'uploads/img_6a823b2230442.jpg', '2026-08-16 22:35:14', 3),
(32, 'Talleres10', 'uploads/img_6a823b8b50706.jpg', '2026-08-16 22:36:59', 3),
(33, 'Proyectos1', 'uploads/img_6a823bcba9d7b.jpg', '2026-08-16 22:38:03', 2),
(34, 'Proyectos2', 'uploads/img_6a823bded1a44.jpg', '2026-08-16 22:38:22', 2),
(35, 'Proyectos3', 'uploads/img_6a823bef67617.jpg', '2026-08-16 22:38:39', 2),
(36, 'Talleres4', 'uploads/img_6a8245b0d6388.jpg', '2026-08-16 23:20:16', 3),
(37, 'Proyectos4', 'uploads/img_6a8245c42940f.jpg', '2026-08-16 23:20:36', 2),
(38, 'Nuestra escuela 1', 'uploads/img_6a8245de9353f.jpeg', '2026-08-16 23:21:02', 1),
(39, 'Nuestra escuela 2', 'uploads/img_6a8245eb33e70.jpeg', '2026-08-16 23:21:15', 1),
(40, 'Nuestra escuela 3', 'uploads/img_6a8245f7e9c20.jpg', '2026-08-16 23:21:27', 1),
(41, 'Nuestra escuela 4', 'uploads/img_6a8246063ac70.jpeg', '2026-08-16 23:21:42', 1),
(42, 'Nuestra escuela 5', 'uploads/img_6a8246141db27.png', '2026-08-16 23:21:56', 1),
(43, 'Talleres1', 'uploads/img_6a8246b874b2e.jpg', '2026-08-16 23:24:40', 3),
(44, 'Nuestra escuela 6', 'uploads/img_6a82487204316.jpg', '2026-08-16 23:32:02', 1),
(45, 'Nuestra escuela 7', 'uploads/img_6a82488163e7d.jpg', '2026-08-16 23:32:17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `Id_noticia` int(11) NOT NULL,
  `Fecha_noticia` datetime DEFAULT NULL,
  `Titulo_noticia` varchar(150) DEFAULT NULL,
  `Descripcion_noticia` text DEFAULT NULL,
  `Foto_noticia` varchar(255) DEFAULT NULL,
  `Id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`Id_noticia`, `Fecha_noticia`, `Titulo_noticia`, `Descripcion_noticia`, `Foto_noticia`, `Id_usuario`) VALUES
(1, '2026-08-18 00:00:00', 'Inscripciones 2027', 'Estan abiertas las inscripciones', 'especialidades-wallper.png', NULL),
(2, '2026-08-18 00:00:00', 'Inscripciones 2027', 'Estan abiertas las inscripciones', 'especialidades-wallper.png', 1),
(3, '2026-08-18 00:00:00', 'Jornada de profilaxis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n3\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nr\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Proyectos2.jpg', 1),
(4, '2026-08-18 00:00:00', 'Rendir previas', 'hola', 'logo.png', 1),
(5, '2026-08-18 22:15:40', 'hola hola', 'hola', 'Portada_quimica.jpg', 1),
(6, '2026-08-19 05:05:22', 'acto', 'actos escolares por san martin', 'Talleres8.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousu`
--

CREATE TABLE `tipousu` (
  `Id_tipousu` int(11) NOT NULL,
  `descripcion_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipousu`
--

INSERT INTO `tipousu` (`Id_tipousu`, `descripcion_tipo`) VALUES
(1, 'administrador'),
(2, 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `Ape_usu` varchar(50) DEFAULT NULL,
  `Nom_usu` varchar(50) DEFAULT NULL,
  `Correo_usu` varchar(100) DEFAULT NULL,
  `Clave_usu` varchar(255) NOT NULL,
  `Id_tipousu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_usuario`, `usuario`, `Ape_usu`, `Nom_usu`, `Correo_usu`, `Clave_usu`, `Id_tipousu`) VALUES
(1, 'franco', NULL, NULL, 'franco@gmail.com', '$2y$10$5kBpGWyGuB5pa.f1NzzjiOg.pKyy5dam3RcHt6JYk0pfjAVMtrjfK', 2),
(3, 'franco1', NULL, NULL, 'franco1@gmail.com', '$2y$10$Ag375.mLRi5ZAVvq1N611OiVTUI8GTfFiACYEGBhmhRXo9JQCglGG', 2),
(4, 'franco2', NULL, NULL, 'franco2@gmail.com', '$2y$10$mPSrd3yp7cLajeD6bYreRu8KQSiOV5bbDGjdK5XZdkm5pcvz7XmMG', 2),
(5, 'franco3', NULL, NULL, 'franco3@gmail.com', '$2y$10$AHuXfpv5qnKoO0i0m9hk7OKJstUAP0pNBFRxrnbScZ1B7qbmSST/q', 2),
(6, 'dadad', NULL, NULL, 'dad@g.com', '$2y$10$Hr9bcrDvWih9hp8wvl7qT.F8XL.B3PR2fcKYy1sSZX1LgEskMgcbi', 2),
(7, 'ada', NULL, NULL, '11231@gmail.com', '$2y$10$S0TC.qlrFv8SK1Est0W9o.kj9Gfq4cog3Q0hLetK9UTKH3Ydxt0vW', 2),
(8, 'adawa', NULL, NULL, 'adwad@aed.com', '$2y$10$xOQZzUSRXo5dhJNd58awn.s5ofYjvaDzelWs/5AK7N/Edpsch0Amm', 2),
(9, 'dawda', NULL, NULL, 'fara@afaa.com', '$2y$10$3NvcQrmhErMd06KgRS/3heQrpyTpod6ZxFBhkZnSaHDpQCRO2uJoq', 2),
(11, 'admin', NULL, NULL, 'admin@gmail.com', '$2y$10$09zIPQ0mHFY9md8xKGJXJuQxlBKY27b2V971F1DeU.NBrPddtD8Gq', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especialidades_img`
--
ALTER TABLE `especialidades_img`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `galeria_institucional`
--
ALTER TABLE `galeria_institucional`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`Id_noticia`),
  ADD KEY `Id_usuario` (`Id_usuario`);

--
-- Indices de la tabla `tipousu`
--
ALTER TABLE `tipousu`
  ADD PRIMARY KEY (`Id_tipousu`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `Id_tipousu` (`Id_tipousu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especialidades_img`
--
ALTER TABLE `especialidades_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `galeria_institucional`
--
ALTER TABLE `galeria_institucional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `Id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipousu`
--
ALTER TABLE `tipousu`
  MODIFY `Id_tipousu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`Id_usuario`) REFERENCES `usuarios` (`Id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_tipousu`) REFERENCES `tipousu` (`Id_tipousu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
