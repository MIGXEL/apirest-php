-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2020 a las 17:45:01
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `rut`, `nombre`, `direccion`, `sigla`, `created_at`, `updated_at`) VALUES
(1, '16975351-2', 'Antvas', 'Las Avutardas 415', 'AV', '2020-11-02 21:29:34', '2020-11-02 21:29:34');

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
(3, 4, 'Revisar equipo escaner', 'Equipo escaner sin acceso en la red, por ende no se pueden realizar escaners', NULL, 1, NULL, NULL, NULL, '2020-09-02 20:28:41', '2020-09-02 20:28:41'),
(4, 4, 'Instalacion y configuración de escaner', 'Apoyar en la instalación y configuración de nuevo equipo de escaner en oficina de recepción', NULL, 1, NULL, NULL, NULL, '2020-09-02 20:41:33', '2020-09-02 20:41:33'),
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
(5, 2, 'Cristina', 'Perez', 'Sin Titulo', 'crisandrea23@gmail.com', '$2y$10$ov/7KAi4ew1IfqedT2kIwOxivU1OZ8GRuVvTnJfKOnoSQZt5Oq1GG', '$2y$10$F7Rwqt62mvmUzBi6atZ7TeUH5BYH75drwXO4bdkpv1gOAKxCW42oG', '', '2020-08-18 02:57:49', '2020-10-29 00:39:37');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tareas`
  ADD CONSTRAINT `FK_tareas_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tareas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  ADD CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
