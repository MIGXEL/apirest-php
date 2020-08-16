CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `correo` text NOT NULL,
  `password` text NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;