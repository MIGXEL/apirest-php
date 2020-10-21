-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2020 a las 21:13:49
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tareas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `rut` text NOT NULL,
  `nombre` text NOT NULL,
  `direccion` text NOT NULL,
  `sigla` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'administrador'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `observacion` text DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_termino` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `id_usuario`, `titulo`, `descripcion`, `observacion`, `id_empresa`, `estado`, `fecha_inicio`, `fecha_termino`, `created_at`, `updated_at`) VALUES
(3, 4, 'Revisar equipo escaner', 'Equipo escaner sin acceso en la red, por ende no se pueden realizar escaners', NULL, NULL, NULL, NULL, NULL, '2020-09-02 20:28:41', '2020-09-02 20:28:41'),
(4, 4, 'Instalacion y configuración de escaner', 'Apoyar en la instalación y configuración de nuevo equipo de escaner en oficina de recepción', NULL, NULL, NULL, NULL, NULL, '2020-09-02 20:41:33', '2020-09-02 20:41:33'),
(5, 4, 'Hola Mundo', 'como estan todos en casa', NULL, NULL, NULL, NULL, NULL, '2020-10-01 01:19:25', '2020-10-01 01:19:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `titulo_profesion` text DEFAULT NULL,
  `correo` text NOT NULL,
  `password` text NOT NULL,
  `token` text NOT NULL,
  `correo_verificado` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_rol`, `nombre`, `apellido`, `titulo_profesion`, `correo`, `password`, `token`, `correo_verificado`, `created_at`, `updated_at`) VALUES
(4, 1, 'Miguel', 'Antiman', '', 'miguelantiman.mav@gmail.com', '$2y$10$pyykYVezYfyIjl61VgbXReqAYfkFon64z258IIWhnaDj6Ewf73dNK', '$2y$10$KnQ6oLFpt/z04n/EJdn9Qeu3g9cssr1LUK.O8lJwiqj1MfZRDU6Dm', '', '2020-08-11 04:08:13', '2020-08-11 04:08:13'),
(5, 2, 'Cristina', 'Perez', '', 'crisandrea23@gmail.com', '$2y$10$J3MyGwqFZnqNfkI/iD/dBua3OqaCoVmAn2RuQ0MecfU4/W7LVCBp6', '$2y$10$5sGK9MEOwO/l4XlGs39UxuuGqLXaNsuSAVDJNLtqyMtBK8mpYyNe.', '', '2020-08-18 02:57:49', '2020-08-18 02:57:49'),
(6, 0, 'Jose', 'Antiman', NULL, 'jose@jose.com', '$2y$10$orJByNLANkIWpPLF19QC1uZL6cRCEx0McG.5/syErGkCQJcaZ0d6i', '$2y$10$6kJxGo8gqOv97pHT8ljgfePlpq99AaLaFjKm41OOelwKtK2zWxpU.', NULL, '2020-10-08 01:27:40', '2020-10-08 01:27:40'),
(7, 0, 'Sandra', 'Vasquez', NULL, 'sandra@sandra.com', '$2y$10$MEvZcr4zBb2m3DyT.EPYauV9ye3vQ1El8ymbpWe2ILF1GHYbuB7Ai', '$2y$10$5OtFZ1OsSurCfT4ZQsqCGeP.QAML43k6ZaqkBiZTsQgbAXLwKH70e', NULL, '2020-10-08 01:50:17', '2020-10-08 01:50:17'),
(8, 0, 'javier', 'faundes', NULL, 'javier@javier.com', '$2y$10$daOwPCMOkQG.MXhB7lm/9.iBe8Eh1TZBzrm/uf/Tn040HA9CXiEcO', '$2y$10$vFPktTJcs79.H3LF.rlmY.R0G12xlkQ4lekENKFM2.aswceWU51Ai', NULL, '2020-10-08 03:29:08', '2020-10-08 03:29:08'),
(9, 0, 'Juan', 'Perez', NULL, 'juan@juan.com', '$2y$10$5PXtU3MBVOdUnFXtnK/Mye1X7lnYwO39PpQbNgQddG36sCpUZtrQe', '$2y$10$kpyBmT4TdVWYrGmr7x5WremJP.Da8s6gC6nqnXCIYCvkaq/rB1TJ.', NULL, '2020-10-19 03:49:54', '2020-10-19 03:49:54'),
(10, 0, 'Manuel', 'Sandoval', NULL, 'manuel@manuel.com', '$2y$10$O7UYxZ1lIDTUicqUuAYOx.l95ofKPbZdpYN4GZXT/K0kOLspbb0uy', '$2y$10$76D2DQkj3xWsP0E1/JU3Ku/mnYnrjCOJMaIx4njGTRdLI7vaeDk0O', NULL, '2020-10-19 03:51:17', '2020-10-19 03:51:17'),
(11, 0, 'Felipe', 'Gomez', NULL, 'felipe@felipe.com', '$2y$10$YgFO7T8Qv1uqAGyoa2bIaOuIsBkskcBoYAyCICKmpS8kzLNEBoF9.', '$2y$10$H7xegZN1SVgPtiU.VV4it.sHEm7Oh.N7R3/.hGX5NDNtvlZ80qntC', NULL, '2020-10-19 03:53:16', '2020-10-19 03:53:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tareas_usuarios` (`id_usuario`),
  ADD KEY `FK_tareas_empresas` (`id_empresa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `FK_tareas_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tareas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
