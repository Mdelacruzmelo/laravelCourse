-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-03-2019 a las 19:53:18
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel_master`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users` (`user_id`),
  KEY `fk_comments_images` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `image_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Buena foto de familia!!', '2019-03-16 17:47:05', '2019-03-16 17:47:05'),
(2, 2, 1, 'Buena foto de PLAYA!!', '2019-03-16 17:47:06', '2019-03-16 17:47:06'),
(3, 2, 4, 'que bueno!!', '2019-03-16 17:47:06', '2019-03-16 17:47:06'),
(4, 5, 10, 'Este es mi nuevo comentario', '2019-03-17 18:21:18', '2019-03-17 18:21:18'),
(5, 5, 10, 'Que bien render de For Honor', '2019-03-17 18:27:38', '2019-03-17 18:27:38'),
(7, 7, 10, 'Que buena escena!', '2019-03-17 19:01:11', '2019-03-17 19:01:11'),
(8, 5, 10, 'Que loco', '2019-03-19 20:26:52', '2019-03-19 20:26:52'),
(9, 5, 9, 'Amo la naturaleza... aunque pare encerrado en mi cuarto', '2019-03-19 20:29:40', '2019-03-19 20:29:40'),
(10, 5, 9, 'Seria un buen fondo de escritorio', '2019-03-19 20:31:04', '2019-03-19 20:31:04'),
(11, 5, 9, 'Pensaba en hacer estos arboles unos assets para Unreal Engine', '2019-03-19 20:35:49', '2019-03-19 20:35:49'),
(12, 5, 11, 'Ya quiero jugarlo', '2019-03-19 20:44:52', '2019-03-19 20:44:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `user_id`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '1552831796profilepicture.jpg', 'descripción de prueba 1', '2019-03-16 17:47:05', '2019-03-16 17:47:05'),
(2, 1, '1552831796profilepicture.jpg', 'descripción de prueba 2', '2019-03-16 17:47:05', '2019-03-16 17:47:05'),
(3, 1, '1552831796profilepicture.jpg', 'descripción de prueba 3', '2019-03-16 17:47:05', '2019-03-16 17:47:05'),
(4, 3, '1552831796profilepicture.jpg', 'descripción de prueba 4', '2019-03-16 17:47:05', '2019-03-16 17:47:05'),
(9, 5, '1552832612Fondo Pantalla 1.jpg', 'asd', '2019-03-17 14:23:32', '2019-03-17 14:23:32'),
(10, 5, '1552843314paul-armstrong-samurai-08.jpg', 'Japan Feudal', '2019-03-17 17:21:54', '2019-03-17 17:21:54'),
(11, 7, '1552847830Assasisns Creed - Japan.jpg', 'Assassins creed Japan', '2019-03-17 18:37:10', '2019-03-17 18:37:10'),
(15, 5, '1553030051profilepicture.jpg', 'Esta es una foto de mi', '2019-03-19 21:14:11', '2019-03-19 21:14:11'),
(18, 5, '1553106061Fondo Pantalla 1.jpg', 'Imagen editada', '2019-03-19 21:18:40', '2019-03-20 18:21:01'),
(19, 5, '1553109548fotoperfil2.jpg', 'Foto mia', '2019-03-20 19:19:08', '2019-03-20 19:19:08'),
(23, 5, '1553109631Fondo Pantalla 1.jpg', 'et', '2019-03-20 19:20:31', '2019-03-20 19:20:31'),
(24, 5, '1553109655Fondo Pantalla 1.jpg', 'etr', '2019-03-20 19:20:55', '2019-03-20 19:20:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_likes_users` (`user_id`),
  KEY `fk_likes_images` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2019-03-16 17:47:06', '2019-03-16 17:47:06'),
(2, 2, 4, '2019-03-16 17:47:06', '2019-03-16 17:47:06'),
(3, 3, 1, '2019-03-16 17:47:06', '2019-03-16 17:47:06'),
(4, 3, 2, '2019-03-16 17:47:06', '2019-03-16 17:47:06'),
(5, 2, 1, '2019-03-16 17:47:06', '2019-03-16 17:47:06'),
(6, 7, 2, '2019-03-17 19:24:01', '2019-03-17 19:24:01'),
(7, 7, 2, '2019-03-17 19:24:47', '2019-03-17 19:24:47'),
(16, 7, 11, '2019-03-17 20:43:49', '2019-03-17 20:43:49'),
(17, 7, 9, '2019-03-17 21:36:43', '2019-03-17 21:36:43'),
(20, 5, 11, '2019-03-19 18:00:20', '2019-03-19 18:00:20'),
(21, 5, 10, '2019-03-19 18:00:21', '2019-03-19 18:00:21'),
(23, 5, 9, '2019-03-19 20:44:32', '2019-03-19 20:44:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `nick` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `nick`, `email`, `password`, `image`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'user', 'Víctor', 'Robles', 'victorroblesweb', 'victor@victor.com', 'pass', NULL, '2019-03-16 17:47:04', '2019-03-16 17:47:04', NULL),
(2, 'user', 'Juan', 'Lopez', 'juanlopez', 'juan@juan.com', 'pass', NULL, '2019-03-16 17:47:04', '2019-03-16 17:47:04', NULL),
(3, 'user', 'Manolo', 'Garcia', 'manologarcia', 'manolo@manolo.com', 'pass', NULL, '2019-03-16 17:47:04', '2019-03-16 17:47:04', NULL),
(4, 'user', 'Mario', 'Delacruzmelo', 'Mdelacruzmelo2', 'mdelacruzmelo@gmail.com', 'pass', NULL, '2019-03-16 19:25:27', '2019-03-16 19:25:27', NULL),
(5, 'user', 'Fernando', 'Delacruzmelo', 'Fdelacruzmelo', 'archivosmelo@gmail.com', '$2y$10$A7/nitSTna4lBSCUCEhDlOQYIdDx9Yvl.oE7H.uKGgPrZIpbpyLlO', '1552832590profilepicture.jpg', '2019-03-16 20:05:24', '2019-03-17 14:23:10', 'yRS8Ee6WPLORppsfm0snvwAaOiYmlObej2s45rIjh4TD8sFzlV0ytAWaGH0K'),
(6, 'user', 'Mario', 'Delacruzmelo', 'mdelacruzmelo', 'mdelacruzmelo@gmail.com', '$2y$10$clHecLBQKPPTKWQzAlSBOecEn9mEZtIcdwEIUIHDDf7xs9umO.JJi', '1552779893paul-armstrong-samurai-08.jpg', '2019-03-16 20:20:40', '2019-03-16 23:44:53', NULL),
(7, 'user', 'Fernando', 'Delacruzmelo', 'Fmelo', 'fdelacruzmelo@gmail.com', '$2y$10$gJEDG3W5q6lMN36GQUR6WO/VDAeEJiDZS9AVZiT35pLsTNPbop0Ky', '1552847881fotoperfil2.jpg', '2019-03-17 18:36:41', '2019-03-17 18:38:01', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_likes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
