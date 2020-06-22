-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2020 a las 20:52:54
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coink`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigorecuperacion`
--

CREATE TABLE `codigorecuperacion` (
  `id` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `codigorecuperacion`
--

INSERT INTO `codigorecuperacion` (`id`, `id_u`, `codigo`) VALUES
(1, 105, 70172),
(2, 105, 2954),
(3, 105, 73328),
(4, 105, 25278),
(5, 105, 47213),
(6, 105, 10573),
(7, 105, 22513),
(8, 105, 75334),
(9, 105, 91397),
(10, 106, 89959);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_c` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_c`, `id_u`, `id_p`, `mensaje`, `fecha`) VALUES
(450, 1, 440, 'jajajajaaj', '2020-03-12 16:14:51'),
(451, 1, 441, 'hola', '2020-03-13 15:43:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacados`
--

CREATE TABLE `destacados` (
  `id_d` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `destacados`
--

INSERT INTO `destacados` (`id_d`, `id_p`, `num`) VALUES
(1, 441, 1),
(7, 440, 2),
(8, 446, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detaller_pro`
--

CREATE TABLE `detaller_pro` (
  `id_detalle` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `titulo_p` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `parrafo` varchar(1000) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detaller_pro`
--

INSERT INTO `detaller_pro` (`id_detalle`, `id_proyecto`, `titulo_p`, `parrafo`, `imagen`) VALUES
(88, 440, 'hace una panaderia vegana', 'jajajaj zsz como no', 'img/Abrir.png'),
(89, 440, 'con face internet', 'jajajaajaj zsz', 'img/corazon.png'),
(90, 440, 'connnn', 'wfjagsdfe', 'img/foto.jpg'),
(91, 441, 'Fiesta en la playa', 'Arenosos', 'img/Captura de pantalla (6).png'),
(92, 441, 'fgffdgf', 'asdfasdfasdf', 'img/div2.JPG'),
(93, 441, 'sadfasdf', 'fsdfasdfasdf', 'img/img2.jpg'),
(94, 445, 'fdsa', 'asdASDLashdg', 'img/provedorimg.png'),
(95, 445, 'asd', 'asdASDJKHgsda', 'img/p1.JPG'),
(96, 445, 'ASD', 'asdkjASFDKjs', 'img/img-10.jpg'),
(97, 446, 'asdasdas', 'asdasdasd', ''),
(98, 446, 'asdasdasd', 'asdasdasd', ''),
(99, 446, 'asdasdasd', 'asdasdasd', ''),
(100, 447, 'asdasd', 'asasdasd', ''),
(101, 447, 'asdasda', 'asdasd', ''),
(102, 447, 'asdasdas', 'asdasd', ''),
(103, 448, 'dfgsdfg', 'sdfgsdf', 'img/iconfinder_aiga_mail_134146.png'),
(104, 448, 'dfgsdfgsd', 'sdfgsdfg', ''),
(105, 448, 'sdfgsdfg', 'sdfgsdfg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `donaciones`
--

INSERT INTO `donaciones` (`id`, `id_user`, `id_p`, `cantidad`, `fecha`) VALUES
(1, 1, 440, 0, '2020-03-25 14:03:38'),
(2, 1, 440, 100, '2020-03-25 14:05:31'),
(3, 1, 441, 5000, '2020-03-25 14:27:01'),
(4, 1, 446, 10, '2020-03-25 14:32:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meta`
--

CREATE TABLE `meta` (
  `id_meta` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `fecha_limite` date NOT NULL,
  `fecha_actual` date NOT NULL DEFAULT current_timestamp(),
  `dinero` double NOT NULL,
  `dinero_actual` double NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `meta`
--

INSERT INTO `meta` (`id_meta`, `fecha_creacion`, `fecha_limite`, `fecha_actual`, `dinero`, `dinero_actual`, `id_proyecto`, `dias`) VALUES
(18, '2020-03-12', '0000-00-00', '2020-03-26', 20000, 20200, 440, 21),
(19, '2020-03-12', '0000-00-00', '2020-03-26', 500, 6700, 441, 46),
(20, '2020-03-12', '0000-00-00', '2020-03-12', 3231, 0, 445, 50),
(21, '2020-03-12', '0000-00-00', '2020-03-26', 100, 10, 446, 46),
(22, '2020-03-13', '0000-00-00', '2020-03-26', 12312, 0, 447, 37),
(23, '2020-03-13', '0000-00-00', '2020-03-13', 1000, 1000, 448, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_n` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `parrafo_n` varchar(3000) NOT NULL,
  `sobre` varchar(500) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `link` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_n`, `id_user`, `parrafo_n`, `sobre`, `estado`, `fecha`, `link`) VALUES
(92, 101, 'Tu Proyecto ha sido aprovado desde este momento comensaras a ', 'Proyecto aprovado', 'visto', '2020-03-12 14:31:58', ''),
(93, 102, 'Tu Proyecto ha sido aprovado desde este momento comensaras a ', 'Proyecto aprovado', 'visto', '2020-03-12 15:12:29', ''),
(94, 102, 'Alguien contribuyo $1700 a tu proyecto', 'Contribucion', 'visto', '2020-03-12 15:14:33', 'ver.php?pro=441'),
(95, 101, 'Alguien contribuyo $10000 a tu proyecto', 'Contribucion', 'visto', '2020-03-12 15:14:57', 'ver.php?pro=440'),
(96, 102, '2', 'Tu proyecto ha sido reportado', 'visto', '2020-03-12 15:16:03', ''),
(97, 1, '2', 'asdfghjk', 'visto', '2020-03-12 15:16:03', 'ver.php?pro=441'),
(98, 102, '2', 'Tu proyecto ha sido reportado', 'visto', '2020-03-12 15:23:17', ''),
(99, 1, '2', 'wfqeffqwerrwer', 'visto', '2020-03-12 15:23:17', 'ver.php?pro=441'),
(100, 102, 'Robo de proyecto', 'Tu proyecto ha sido reportado', 'visto', '2020-03-12 15:24:03', ''),
(101, 1, 'Robo de proyecto', 'lalo', 'visto', '2020-03-12 15:24:03', 'ver.php?pro=441'),
(102, 101, 'Tu Proyecto ha sido aprovado desde este momento comensaras a ', 'Proyecto aprovado', 'visto', '2020-03-12 15:38:57', ''),
(103, 101, 'Tu Proyecto ha sido aprovado desde este momento comensaras a ', 'Proyecto aprovado', 'visto', '2020-03-12 16:13:27', ''),
(104, 101, 'Alguien contribuyo $5000 a tu proyecto', 'Contribucion', 'visto', '2020-03-12 16:13:39', 'ver.php?pro=440'),
(105, 101, 'Alguien contribuyo $5000 a tu proyecto', 'Contribucion', 'visto', '2020-03-12 16:13:55', 'ver.php?pro=440'),
(106, 101, 'Alguien a comentado tu proyecto', 'Comentario', 'visto', '2020-03-12 16:14:51', 'ver.php?pro=440'),
(107, 103, 'Tu Proyecto ha sido aprovado desde este momento comensaras a ', 'Proyecto aprovado', 'novisto', '2020-03-12 17:57:04', ''),
(108, 104, 'Tu Proyecto ha sido aprovado desde este momento comensaras a ', 'Proyecto aprovado', 'visto', '2020-03-13 12:50:49', ''),
(109, 106, 'Tu Proyecto ha sido aprovado desde este momento comensaras a ', 'Proyecto aprovado', 'visto', '2020-03-13 15:36:50', ''),
(110, 106, 'Alguien contribuyo $200 a tu proyecto', 'Contribucion', 'visto', '2020-03-13 15:37:13', 'ver.php?pro=448'),
(111, 106, 'Alguien contribuyo $800 a tu proyecto', 'Contribucion', 'visto', '2020-03-13 15:37:21', 'ver.php?pro=448'),
(112, 102, 'Alguien a comentado tu proyecto', 'Comentario', 'novisto', '2020-03-13 15:43:54', 'ver.php?pro=441'),
(113, 102, 'meta exagerada', 'Tu proyecto ha sido reportado', 'novisto', '2020-03-13 15:44:16', ''),
(114, 1, 'meta exagerada', 'feos', 'visto', '2020-03-13 15:44:16', 'ver.php?pro=441'),
(115, 106, 'Congratulations! Tu proyecto a terminado u tiempo de recaudacion y ha completado su meta', 'Fin de tu tiempo', 'visto', '2020-03-13 16:38:59', 'index.php'),
(116, 101, 'Alguien contribuyo $100 a tu proyecto', 'Contribucion', 'novisto', '2020-03-25 14:03:38', 'ver.php?pro=440'),
(117, 101, 'Alguien contribuyo $100 a tu proyecto', 'Contribucion', 'novisto', '2020-03-25 14:05:31', 'ver.php?pro=440'),
(118, 102, 'Alguien contribuyo $5000 a tu proyecto', 'Contribucion', 'novisto', '2020-03-25 14:27:01', 'ver.php?pro=441'),
(119, 103, 'Alguien contribuyo $10 a tu proyecto', 'Contribucion', 'novisto', '2020-03-25 14:32:32', 'ver.php?pro=446'),
(120, 103, 'Alguien a comensado a seguirte', 'Nuevo Seguidor', 'novisto', '2020-03-26 14:47:37', 'ver.php?pro=446');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nom_proyecto` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `p_principal` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen_p` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `video_p` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `n_con` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `id_user`, `nom_proyecto`, `estado`, `categoria`, `p_principal`, `imagen_p`, `video_p`, `n_con`) VALUES
(440, 101, 'panaderia', 'activo', 'productos', 'panaderia que hace panes :)', 'img/burrito1.png', 'https://www.youtube.com/watch?v=_7pQ4iH0IOM', 5),
(441, 102, 'juan', 'activo', 'eventos', 'Cerdo marrano', 'img/Cerdito.jpg', 'https://www.youtube.com/watch?v=S14XIwzvrT4', 2),
(446, 103, 'Hotaa', 'activo', 'ecologia', 'asdasdasdas', 'img/foto.jpg', 'https://www.youtube.com/watch?v=kmdl2jIfi3M', 1),
(447, 104, 'Las lomas', 'activo', 'deportes', 'qdasdasdsadasdasdas', 'img/iconfinder_aiga_mail_134146.png', 'https://www.youtube.com/watch?v=auMgg_0r9v0', 0),
(448, 106, 'hgfgfhhf', 'terminado', 'productos', 'jtdhtffjjfjghgjhjhg', 'img/iconfinder_aiga_mail_134146.png', 'https://www.youtube.com/watch?v=lDdWc76n0Ck', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recompensa`
--

CREATE TABLE `recompensa` (
  `id_recompensa` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `valor` double NOT NULL,
  `titulo_r` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `recompensa`
--

INSERT INTO `recompensa` (`id_recompensa`, `id_proyecto`, `imagen`, `valor`, `titulo_r`, `descripcion`) VALUES
(17, 440, 'img/balanceimg.png', 1200, 'descuentos', 'para todos los panes'),
(18, 441, 'img/burritocartas.png', 234234, 'asdfasdf', 'fasdfasd'),
(19, 445, '', 123, 'ASDss', 'ASDasd'),
(20, 446, '', 34234, 'asdasdasd', 'asdasdasd'),
(21, 447, '', 213, 'asdasdasd', 'asdasdasd'),
(22, 448, 'img/', 123123, 'asdasd', 'asdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_re` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id_re`, `motivo`, `descripcion`, `id_p`) VALUES
(17, '2', 'asdfghjk', 441),
(18, 'Proyecto falso', 'wfqeffqwerrwer', 441),
(19, 'Robo de proyecto', 'lalo', 441),
(20, 'meta exagerada', 'feos', 441);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguir`
--

CREATE TABLE `seguir` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seguir`
--

INSERT INTO `seguir` (`id`, `id_user`, `id_p`) VALUES
(2, 1, 441),
(3, 1, 446);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `aprellidos` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `contra` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `cargo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(120) COLLATE utf8mb4_spanish_ci NOT NULL,
  `identificacion` int(11) NOT NULL,
  `municipio` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `dirrecion` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `saldo` double NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `aprellidos`, `correo`, `contra`, `cargo`, `estado`, `descripcion`, `identificacion`, `municipio`, `fecha`, `dirrecion`, `saldo`, `foto`) VALUES
(1, 'Jor', 'King', 'admin', 'admin', 'admin', 'activo', 'Administrador del sitio', 1001236452, 'Medellin', '2020-03-12 13:18:12', 'calle 18 N# 105 -64', 9972090, 'img/Cerdito.jpg'),
(101, 'edwin', 'perez', 'edwin@gmail.com', '1234', 'start', 'activo', '', 1062955761, 'Medellín', '2000-03-12 00:00:00', 'calle 17b # 107a-63 int 214', 3000, ''),
(102, 'juan', 'perez', 'eren@gmail.com', '123', 'start', 'activo', '', 1445232344, 'Barbosa', '2020-03-25 00:00:00', 'calle 17b # 107a-63 int 214', 102000, ''),
(103, 'maicol', 'zapata', 'maicol@gmail.com', '1234', 'start', 'activo', 'Holaaaaa', 23443212, 'Bello', '2000-03-12 00:00:00', 'carrra 48 # 63 v', 0, ''),
(104, 'Feo', 'Lindo', 'feolindo@gmail.com', '123', 'start', 'activo', '', 100234234, 'Bello', '2020-03-19 00:00:00', 'caler e123', 0, ''),
(105, 'Coink', 'Coink', 'Coink8182@gmail.com', 'mama', 'start', 'activo', 'Coink jajaaja', 0, '', '2020-03-13 13:21:43', '', 0, 'img/iconfinder_aiga_mail_134146.png'),
(106, 'aaron', 'aguas', 'aaaguas@gmail.com', 'qwerty', 'start', 'activo', '', 2147483647, 'Barbosa', '2020-03-30 00:00:00', 'fdfdhrdhrdh', 0, 'img/iconfinder_aiga_mail_134146.png'),
(107, 'Recargador', 'Coink', '777', '666', 'rec', 'activo', 'Recargador empleado de Coink', 100111111, '', '2020-03-22 15:35:40', '', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `codigorecuperacion`
--
ALTER TABLE `codigorecuperacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_c`);

--
-- Indices de la tabla `destacados`
--
ALTER TABLE `destacados`
  ADD PRIMARY KEY (`id_d`);

--
-- Indices de la tabla `detaller_pro`
--
ALTER TABLE `detaller_pro`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id_meta`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_n`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recompensa`
--
ALTER TABLE `recompensa`
  ADD PRIMARY KEY (`id_recompensa`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_re`);

--
-- Indices de la tabla `seguir`
--
ALTER TABLE `seguir`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `codigorecuperacion`
--
ALTER TABLE `codigorecuperacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_c` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;

--
-- AUTO_INCREMENT de la tabla `destacados`
--
ALTER TABLE `destacados`
  MODIFY `id_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detaller_pro`
--
ALTER TABLE `detaller_pro`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `meta`
--
ALTER TABLE `meta`
  MODIFY `id_meta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

--
-- AUTO_INCREMENT de la tabla `recompensa`
--
ALTER TABLE `recompensa`
  MODIFY `id_recompensa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_re` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `seguir`
--
ALTER TABLE `seguir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
