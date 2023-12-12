-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2023 a las 13:51:44
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `psicodev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `correo`, `telefono`, `motivo`, `descripcion`, `estado`) VALUES
(1, 'luis Fernando', 'luis_ferherrera21@hotmail.com', '7421112121', 'otra', 'el problema es...', 'Pendiente'),
(2, 'luis Fernando', 'luis_ferherrera21@hotmail.com', '7421112121', 'problemas', 'Es otro problema', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `identificador` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `identificador`, `nombre`, `fechainicio`, `personal_id`, `fecha_creacion`, `estado`, `empresa_id`, `tipo`) VALUES
(202, 'UTCCG-1', 'TEST ESTILO DE APRENDIZAJE (MODELO PNL)', '2023-11-24', 6, '2023-11-24 07:49:48', 'activo', 1, 'tipo2'),
(203, 'UTCCG-2', 'Test para determinar el Canal de Aprendizaje de preferencia', '2023-11-24', 6, '2023-11-24 08:29:57', 'activo', 1, 'tipo1'),
(204, 'UTCCG-3', 'Test de Orientación Vocacional', '2023-11-25', 6, '2023-11-25 09:04:31', 'activo', 1, 'tipo1'),
(205, 'TM-1', 'werqertfg', '2023-11-25', 9, '2023-11-25 12:12:50', 'activo', 2, 'tipo1'),
(206, 'UTCCG-4', 'test1', '2023-11-29', 7, '2023-11-27 16:45:49', 'activo', 1, 'tipo1'),
(207, 'UTCCG-5', 'Encuesta 3', '2023-11-28', 6, '2023-11-28 09:39:30', 'activo', 1, 'tipo3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `abreviatura` varchar(50) NOT NULL,
  `cct` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `plan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre_empresa`, `abreviatura`, `cct`, `descripcion`, `plan_id`) VALUES
(1, 'Universidad Tecnologica de la Costa Grande de Guerrero', 'UTCCG', '12EUT0001Z ', 'Escuela universitaria con grandes ramas de la educacion', 2),
(2, 'Tecnologico de Monterrey', 'TM', '12EUT00012', 'Universidad Tecnologico de Monterrey', 2),
(3, 'La salle', 'SALL', '12EUT0004Z ', 'RTYTREWSAADERRES', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `profesional` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `clave_interna` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre_completo`, `profesional`, `edad`, `sexo`, `clave_interna`, `correo`, `contrasena`, `empresa_id`, `estado`) VALUES
(6, 'Ps. Laura Gómez', 'Psicologo', 42, 'Femenino', 'UTCCG10307011', 'laura.gomez@utcgg.edu.mx', '$2y$10$Q2OXXbqXWGCKIZ/pcsIEpeM.rkBVWMCo5RaeSem0ozA1MuvwQkqZ6', 1, 'Activo'),
(7, 'Ps. Juan Carlos Vega', 'Psicologo', 48, 'Masculino', 'UTCCG10307012', 'juan.vega@utcgg.edu.mx', '$2y$10$CWIoHODGiRDyjLN/We8k6eP8a/szB9LQW2H6xwjOK8J58zU8uKaD2', 1, 'Activo'),
(8, 'Dr. Sergio Ramírez', 'Psicologo', 45, 'Masculino', 'UTCCG10307013', 'sergio.ramirez@utcgg.edu.mx', '$2y$10$mSlZt4c5oLg2qPuXX58fx.WYiu1BWHsLzBvdrqI0vLXdZz0GjGBD2', 1, 'Activo'),
(9, 'Martín Hernández Martínez', 'Doctor', 35, 'Masculino', 'TM20407001', 'martin.hernandez@tecm.edu.mx', '$2y$10$VZP5LLU0FMgOBqQYOyzwVOTOngG1Fi9DHxvdKwawlPSrkouM2Xph.', 2, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `encuestas_numero` int(11) NOT NULL,
  `personal_numero` int(11) NOT NULL,
  `usuarios_numero` int(11) NOT NULL,
  `blogsempresa_numero` int(11) NOT NULL,
  `blogpersonal_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `nombre`, `descripcion`, `precio`, `encuestas_numero`, `personal_numero`, `usuarios_numero`, `blogsempresa_numero`, `blogpersonal_numero`) VALUES
(1, 'Plan 1', 'Plan de ejemplo1', '300.00', 3, 3, 10, 3, 4),
(2, 'Plan 2', 'Plan de ejmplo 2', '500.00', 10, 10, 100, 10, 10),
(3, 'Plan3', 'Plan3', '1000.00', 1000, 100, 1000, 100, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `identificador` varchar(255) DEFAULT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `Categoria` varchar(255) DEFAULT NULL,
  `Pregunta` text DEFAULT NULL,
  `datos_id` int(11) DEFAULT NULL,
  `respuesta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `identificador`, `personal_id`, `empresa_id`, `Categoria`, `Pregunta`, `datos_id`, `respuesta`) VALUES
(238, 'UTCCG-1', 6, 1, 'Visual', '¿Cuál de las siguientes actividades disfrutas más?', 202, 'Ver películas'),
(239, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cuál de las siguientes actividades disfrutas más?', 202, 'Escuchar música'),
(240, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cuál de las siguientes actividades disfrutas más?', 202, 'Bailar con buena música'),
(241, 'UTCCG-1', 6, 1, 'Visual', '¿Qué programa de televisión prefieres?', 202, 'Reportajes de descubrimientos y lugares'),
(242, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué programa de televisión prefieres?', 202, 'Noticias del mundo'),
(243, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué programa de televisión prefieres?', 202, 'Cómico y de entretenimiento'),
(244, 'UTCCG-1', 6, 1, 'Visual', 'Cuando conversas con otra persona, tú:', 202, 'La observas'),
(245, 'UTCCG-1', 6, 1, 'Auditivo', 'Cuando conversas con otra persona, tú:', 202, 'La escuchas atentamente'),
(246, 'UTCCG-1', 6, 1, 'Kinestesico', 'Cuando conversas con otra persona, tú:', 202, 'Tiendes a tocarla'),
(247, 'UTCCG-1', 6, 1, 'Visual', 'Si pudieras adquirir uno de los siguientes artículos, ¿cuál elegirías?', 202, 'Un televisor'),
(248, 'UTCCG-1', 6, 1, 'Auditivo', 'Si pudieras adquirir uno de los siguientes artículos, ¿cuál elegirías?', 202, 'Un estéreo'),
(249, 'UTCCG-1', 6, 1, 'Kinestesico', 'Si pudieras adquirir uno de los siguientes artículos, ¿cuál elegirías?', 202, 'Un jacuzzi'),
(250, 'UTCCG-1', 6, 1, 'Visual', '¿Qué prefieres hacer un sábado por la tarde?', 202, 'Ir al cine'),
(251, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué prefieres hacer un sábado por la tarde?', 202, 'Ir a un concierto'),
(252, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué prefieres hacer un sábado por la tarde?', 202, 'Quedarte en casa'),
(253, 'UTCCG-1', 6, 1, 'Visual', '¿Qué tipo de exámenes se te facilitan más?', 202, 'Examen escrito'),
(254, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué tipo de exámenes se te facilitan más?', 202, 'Examen oral'),
(255, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué tipo de exámenes se te facilitan más?', 202, 'Examen de opción múltiple'),
(256, 'UTCCG-1', 6, 1, 'Visual', '¿Cómo te orientas más fácilmente?', 202, 'Mediante el uso de un mapa'),
(257, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cómo te orientas más fácilmente?', 202, 'Pidiendo indicaciones'),
(258, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cómo te orientas más fácilmente?', 202, 'A través de la intuición'),
(259, 'UTCCG-1', 6, 1, 'Visual', '¿En qué prefieres ocupar tu tiempo en un lugar de descanso?', 202, 'Caminar por los alrededores'),
(260, 'UTCCG-1', 6, 1, 'Auditivo', '¿En qué prefieres ocupar tu tiempo en un lugar de descanso?', 202, 'Pensar'),
(261, 'UTCCG-1', 6, 1, 'Kinestesico', '¿En qué prefieres ocupar tu tiempo en un lugar de descanso?', 202, 'Descansar'),
(262, 'UTCCG-1', 6, 1, 'Visual', '¿Qué te halaga más?', 202, 'Que te digan que tienes buen aspecto'),
(263, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué te halaga más?', 202, 'Que te digan que tienes una conversación interesante'),
(264, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué te halaga más?', 202, 'Que te digan que tienes un trato muy agradable'),
(265, 'UTCCG-1', 6, 1, 'Visual', '¿Cuál de estos ambientes te atrae más?', 202, 'Uno con una hermosa vista al océano'),
(266, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cuál de estos ambientes te atrae más?', 202, 'Uno en el que se escuchen las olas del mar'),
(267, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cuál de estos ambientes te atrae más?', 202, 'Uno en el que se sienta un clima agradable'),
(268, 'UTCCG-1', 6, 1, 'Visual', 'De qué manera se te facilita aprender algo?', 202, 'Escribiéndolo varias veces'),
(269, 'UTCCG-1', 6, 1, 'Auditivo', 'De qué manera se te facilita aprender algo?', 202, 'Repitiendo en voz alta'),
(270, 'UTCCG-1', 6, 1, 'Kinestesico', 'De qué manera se te facilita aprender algo?', 202, 'Relacionándolo con algo divertido'),
(271, 'UTCCG-1', 6, 1, 'Visual', '¿A qué evento preferirías asistir?', 202, 'A una exposición de arte'),
(272, 'UTCCG-1', 6, 1, 'Auditivo', '¿A qué evento preferirías asistir?', 202, 'A una conferencia'),
(273, 'UTCCG-1', 6, 1, 'Kinestesico', '¿A qué evento preferirías asistir?', 202, 'A una reunión social'),
(274, 'UTCCG-1', 6, 1, 'Visual', '¿De qué manera te formas una opinión de otras personas?', 202, 'Por su aspecto'),
(275, 'UTCCG-1', 6, 1, 'Auditivo', '¿De qué manera te formas una opinión de otras personas?', 202, 'Por la sinceridad en su voz'),
(276, 'UTCCG-1', 6, 1, 'Kinestesico', '¿De qué manera te formas una opinión de otras personas?', 202, 'Por la forma de estrecharte la mano'),
(277, 'UTCCG-1', 6, 1, 'Visual', '¿Cómo te consideras?', 202, 'Atlético'),
(278, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cómo te consideras?', 202, 'Intelectual'),
(279, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cómo te consideras?', 202, 'Sociable'),
(280, 'UTCCG-1', 6, 1, 'Visual', '¿Qué tipo de películas te gustan más?', 202, 'De acción'),
(281, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué tipo de películas te gustan más?', 202, 'Clásicas'),
(282, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué tipo de películas te gustan más?', 202, 'De amor'),
(283, 'UTCCG-1', 6, 1, 'Visual', '¿Cómo prefieres mantenerte en contacto con otra persona?', 202, 'Por correo electrónico'),
(284, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cómo prefieres mantenerte en contacto con otra persona?', 202, 'Por teléfono'),
(285, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cómo prefieres mantenerte en contacto con otra persona?', 202, 'Tomando un café juntos'),
(286, 'UTCCG-1', 6, 1, 'Visual', '¿Cuál de las siguientes frases se identifican más contigo?', 202, 'Es importante que mi coche esté limpio por fuera y por dentro'),
(287, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cuál de las siguientes frases se identifican más contigo?', 202, 'Percibo hasta el mas ligero ruido que hace mi coche'),
(288, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cuál de las siguientes frases se identifican más contigo?', 202, 'Me gusta que mi coche se sienta bien al conducirlo'),
(289, 'UTCCG-1', 6, 1, 'Visual', '¿Cómo prefieres pasar el tiempo con tu novia o novio?', 202, 'Mirando algo juntos'),
(290, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cómo prefieres pasar el tiempo con tu novia o novio?', 202, 'Conversando'),
(291, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cómo prefieres pasar el tiempo con tu novia o novio?', 202, 'Acariciándose'),
(292, 'UTCCG-1', 6, 1, 'Visual', 'Si no encuentras las llaves en una bolsa', 202, 'La buscas mirando'),
(293, 'UTCCG-1', 6, 1, 'Auditivo', 'Si no encuentras las llaves en una bolsa', 202, 'Sacudes la bolsa para oír el ruido'),
(294, 'UTCCG-1', 6, 1, 'Kinestesico', 'Si no encuentras las llaves en una bolsa', 202, 'Buscas al tacto'),
(295, 'UTCCG-1', 6, 1, 'Visual', 'Cuando tratas de recordar algo, ¿cómo lo haces?', 202, 'A través de imágenes'),
(296, 'UTCCG-1', 6, 1, 'Auditivo', 'Cuando tratas de recordar algo, ¿cómo lo haces?', 202, 'A través de sonidos'),
(297, 'UTCCG-1', 6, 1, 'Kinestesico', 'Cuando tratas de recordar algo, ¿cómo lo haces?', 202, 'A través de emociones'),
(298, 'UTCCG-1', 6, 1, 'Visual', 'Si tuvieras dinero, ¿qué harías?', 202, 'Viajar y conocer el mundo'),
(299, 'UTCCG-1', 6, 1, 'Auditivo', 'Si tuvieras dinero, ¿qué harías?', 202, 'Adquirir un estudio de grabación'),
(300, 'UTCCG-1', 6, 1, 'Kinestesico', 'Si tuvieras dinero, ¿qué harías?', 202, 'Comprar una casa'),
(301, 'UTCCG-1', 6, 1, 'Visual', '¿Con qué frase te identificas más?', 202, 'Recuerdo el aspecto de alguien, pero no su nombre'),
(302, 'UTCCG-1', 6, 1, 'Auditivo', '¿Con qué frase te identificas más?', 202, 'Reconozco a las personas por su voz'),
(303, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Con qué frase te identificas más?', 202, 'No recuerdo el aspecto de la gente'),
(304, 'UTCCG-1', 6, 1, 'Visual', 'Si tuvieras que quedarte en una isla desierta, ¿qué preferirías llevar contigo?', 202, 'Algunos buenos libros'),
(305, 'UTCCG-1', 6, 1, 'Auditivo', 'Si tuvieras que quedarte en una isla desierta, ¿qué preferirías llevar contigo?', 202, 'Un radio portátil de alta frecuencia'),
(306, 'UTCCG-1', 6, 1, 'Kinestesico', 'Si tuvieras que quedarte en una isla desierta, ¿qué preferirías llevar contigo?', 202, 'Golosinas y comida enlatada'),
(307, 'UTCCG-1', 6, 1, 'Visual', '¿Cuál de los siguientes entretenimientos prefieres?', 202, 'Sacar fotografías'),
(308, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cuál de los siguientes entretenimientos prefieres?', 202, 'Tocar un instrumento musical'),
(309, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cuál de los siguientes entretenimientos prefieres?', 202, 'Actividades manuales'),
(310, 'UTCCG-1', 6, 1, 'Visual', '¿Cómo es tu forma de vestir?', 202, 'Impecable'),
(311, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cómo es tu forma de vestir?', 202, 'Informal'),
(312, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cómo es tu forma de vestir?', 202, 'Muy informal'),
(313, 'UTCCG-1', 6, 1, 'Visual', '¿Qué es lo que más te gusta de una fogata nocturna?', 202, 'Mirar el fuego y las estrellas'),
(314, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué es lo que más te gusta de una fogata nocturna?', 202, 'El sonido del fuego quemando la leña'),
(315, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué es lo que más te gusta de una fogata nocturna?', 202, 'El calor del fuego y los bombones asados'),
(316, 'UTCCG-1', 6, 1, 'Visual', '¿Cómo se te facilita entender algo?', 202, 'Cuando utilizan medios visuales'),
(317, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cómo se te facilita entender algo?', 202, 'Cuando te lo explican verbalmente'),
(318, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cómo se te facilita entender algo?', 202, 'Cuando se realiza a través de alguna actividad'),
(319, 'UTCCG-1', 6, 1, 'Visual', '¿Por qué te distingues?', 202, 'Por ser un buen observador'),
(320, 'UTCCG-1', 6, 1, 'Auditivo', '¿Por qué te distingues?', 202, 'Por ser un buen conversador'),
(321, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Por qué te distingues?', 202, 'Por tener una gran intuición'),
(322, 'UTCCG-1', 6, 1, 'Visual', '¿Qué es lo que más disfrutas de un amanecer?', 202, 'Las tonalidades del cielo'),
(323, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué es lo que más disfrutas de un amanecer?', 202, 'El canto de las aves'),
(324, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué es lo que más disfrutas de un amanecer?', 202, 'La emoción de vivir un nuevo día'),
(325, 'UTCCG-1', 6, 1, 'Visual', 'Si pudieras elegir ¿qué preferirías ser?', 202, 'Un gran pintor'),
(326, 'UTCCG-1', 6, 1, 'Auditivo', 'Si pudieras elegir ¿qué preferirías ser?', 202, 'Un gran músico'),
(327, 'UTCCG-1', 6, 1, 'Kinestesico', 'Si pudieras elegir ¿qué preferirías ser?', 202, 'Un gran médico'),
(328, 'UTCCG-1', 6, 1, 'Visual', 'Cuando eliges tu ropa, ¿qué es lo más importante para ti?', 202, 'Que luzca bien'),
(329, 'UTCCG-1', 6, 1, 'Auditivo', 'Cuando eliges tu ropa, ¿qué es lo más importante para ti?', 202, 'Que sea adecuada'),
(330, 'UTCCG-1', 6, 1, 'Kinestesico', 'Cuando eliges tu ropa, ¿qué es lo más importante para ti?', 202, 'Que sea cómoda'),
(331, 'UTCCG-1', 6, 1, 'Visual', '¿Qué es lo que más disfrutas de una habitación?', 202, 'Que esté limpia y ordenada'),
(332, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué es lo que más disfrutas de una habitación?', 202, 'Que sea silenciosa'),
(333, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué es lo que más disfrutas de una habitación?', 202, 'Que sea confortable'),
(334, 'UTCCG-1', 6, 1, 'Visual', '¿Qué es más sexy para ti?', 202, 'Una iluminación tenue'),
(335, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué es más sexy para ti?', 202, 'Cierto tipo de música'),
(336, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué es más sexy para ti?', 202, 'El perfume'),
(337, 'UTCCG-1', 6, 1, 'Visual', '¿A qué tipo de espectáculo preferirías asistir?', 202, 'A un espectáculo de magia'),
(338, 'UTCCG-1', 6, 1, 'Auditivo', '¿A qué tipo de espectáculo preferirías asistir?', 202, 'A un concierto de música'),
(339, 'UTCCG-1', 6, 1, 'Kinestesico', '¿A qué tipo de espectáculo preferirías asistir?', 202, 'A una muestra gastronómica'),
(340, 'UTCCG-1', 6, 1, 'Visual', '¿Qué te atrae más de una persona?', 202, 'Su aspecto físico'),
(341, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué te atrae más de una persona?', 202, 'Su conversación'),
(342, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué te atrae más de una persona?', 202, 'Su trato y forma de ser'),
(343, 'UTCCG-1', 6, 1, 'Visual', 'Cuando vas de compras, ¿en dónde pasas mucho tiempo?', 202, 'En una librería'),
(344, 'UTCCG-1', 6, 1, 'Auditivo', 'Cuando vas de compras, ¿en dónde pasas mucho tiempo?', 202, 'En una tienda de discos'),
(345, 'UTCCG-1', 6, 1, 'Kinestesico', 'Cuando vas de compras, ¿en dónde pasas mucho tiempo?', 202, 'En una perfumería'),
(346, 'UTCCG-1', 6, 1, 'Visual', '¿Cuáles tu idea de una noche romántica?', 202, 'A la luz de las velas'),
(347, 'UTCCG-1', 6, 1, 'Auditivo', '¿Cuáles tu idea de una noche romántica?', 202, 'Con música romántica'),
(348, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Cuáles tu idea de una noche romántica?', 202, 'Bailando tranquilamente'),
(349, 'UTCCG-1', 6, 1, 'Visual', '¿Qué es lo que más disfrutas de viajar?', 202, 'Conocer lugares nuevos'),
(350, 'UTCCG-1', 6, 1, 'Auditivo', '¿Qué es lo que más disfrutas de viajar?', 202, 'Aprender sobre otras costumbres'),
(351, 'UTCCG-1', 6, 1, 'Kinestesico', '¿Qué es lo que más disfrutas de viajar?', 202, 'Conocer personas y hacer nuevos amigos'),
(352, 'UTCCG-1', 6, 1, 'Visual', 'Cuando estás en la ciudad, ¿qué es lo que más hechas de menos del campo?', 202, 'Los paisajes'),
(353, 'UTCCG-1', 6, 1, 'Auditivo', 'Cuando estás en la ciudad, ¿qué es lo que más hechas de menos del campo?', 202, 'La tranquilidad'),
(354, 'UTCCG-1', 6, 1, 'Kinestesico', 'Cuando estás en la ciudad, ¿qué es lo que más hechas de menos del campo?', 202, 'El aire limpio y refrescante'),
(355, 'UTCCG-1', 6, 1, 'Visual', 'Si te ofrecieran uno de los siguientes empleos, ¿cuál elegirías?', 202, 'Director de una revista'),
(356, 'UTCCG-1', 6, 1, 'Auditivo', 'Si te ofrecieran uno de los siguientes empleos, ¿cuál elegirías?', 202, 'Director de una estación de radio'),
(357, 'UTCCG-1', 6, 1, 'Kinestesico', 'Si te ofrecieran uno de los siguientes empleos, ¿cuál elegirías?', 202, 'Director de un club deportivo'),
(358, 'UTCCG-2', 6, 1, 'VISUAL', 'Puedo recordar algo mejor si lo escribo', 203, NULL),
(359, 'UTCCG-2', 6, 1, 'VISUAL', 'Puedo visualizar imágenes en mi cabeza.', 203, NULL),
(360, 'UTCCG-2', 6, 1, 'VISUAL', 'Tomo muchas notas de lo que leo y escucho.', 203, NULL),
(361, 'UTCCG-2', 6, 1, 'VISUAL', 'Me ayuda MIRAR a la persona que está hablando. Me mantiene enfocado.', 203, NULL),
(362, 'UTCCG-2', 6, 1, 'VISUAL', 'Se me hace difícil entender lo que una persona está diciendo si hay ruidos alrededor.', 203, NULL),
(363, 'UTCCG-2', 6, 1, 'VISUAL', 'Es más fácil para mí hacer un trabajo en un lugar tranquilo.', 203, NULL),
(364, 'UTCCG-2', 6, 1, 'VISUAL', 'Me resulta fácil entender mapas, tablas y gráficos.', 203, NULL),
(365, 'UTCCG-2', 6, 1, 'VISUAL', 'Cuando estoy concentrado leyendo o escribiendo, la radio me molesta.', 203, NULL),
(366, 'UTCCG-2', 6, 1, 'VISUAL', 'Cuando estoy en un examen, puedo “ver” la página en el libro de textos y la respuesta.', 203, NULL),
(367, 'UTCCG-2', 6, 1, 'VISUAL', 'No puedo recordar una broma lo suficiente para contarla luego.', 203, NULL),
(368, 'UTCCG-2', 6, 1, 'VISUAL', 'Cuando estoy tratando de recordar algo nuevo, por ejemplo, un número de teléfono, me ayuda formarme una imagen mental para lograrlo.', 203, NULL),
(369, 'UTCCG-2', 6, 1, 'VISUAL', 'Cuando tengo una gran idea, debo escribirla inmediatamente, o la olvido con facilidad.', 203, NULL),
(370, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Al leer, oigo las palabras en mi cabeza o leo en voz alta.', 203, NULL),
(371, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Necesito hablar las cosas para entenderlas mejor.', 203, NULL),
(372, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Prefiero que alguien me diga cómo tengo que hacer las cosas que leer las instrucciones.', 203, NULL),
(373, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Prefiero escuchar una conferencia o una grabación a leer un libro.', 203, NULL),
(374, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Puedo seguir fácilmente a una persona que está hablando aunque mi cabeza esté hacia abajo o me encuentre mirando por una ventana.', 203, NULL),
(375, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Recuerdo mejor lo que la gente dice que su aspecto.', 203, NULL),
(376, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Recuerdo mejor si estudio en voz alta con alguien.', 203, NULL),
(377, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Me resulta difícil crear imágenes en mi cabeza.', 203, NULL),
(378, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Me resulta útil decir en voz alta las tareas que tengo para hacer.', 203, NULL),
(379, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Al aprender algo nuevo, prefiero escuchar la información, luego leer y luego hacerlo.', 203, NULL),
(380, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Me gusta completar una tarea antes de comenzar otra.', 203, NULL),
(381, 'UTCCG-2', 6, 1, 'AUDITIVO', 'Para obtener una nota extra, prefiero grabar un informe a escribirlo.', 203, NULL),
(382, 'UTCCG-2', 6, 1, 'KINESTESICO', 'No me gusta leer o escuchar instrucciones, prefiero simplemente comenzar a hacer las cosas.', 203, NULL),
(383, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Puedo estudiar mejor si escucho música.', 203, NULL),
(384, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Necesito recreos frecuentes cuando estudio.', 203, NULL),
(385, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Pienso mejor cuando tengo la libertad de moverme, estar sentado detrás de un escritorio no es para mí.', 203, NULL),
(386, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Cuando no puedo pensar en una palabra específica, uso mis manos y llamo al objeto “coso”.', 203, NULL),
(387, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Cuando comienzo un artículo o un libro, prefiero espiar la última página.', 203, NULL),
(388, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Tomo notas, pero nunca vuelvo a releerlas.', 203, NULL),
(389, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Mi cuaderno y mi escritorio pueden verse un desastre, pero sé exactamente dónde está cada cosa.', 203, NULL),
(390, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Uso mis dedos para contar y muevo los labios cuando leo.', 203, NULL),
(391, 'UTCCG-2', 6, 1, 'KINESTESICO', 'No me gusta releer mi trabajo.', 203, NULL),
(392, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Fantaseo en clase', 203, NULL),
(393, 'UTCCG-2', 6, 1, 'KINESTESICO', 'Para obtener una calificación extra, prefiero crear un proyecto a escribir un informe.', 203, NULL),
(394, 'UTCCG-3', 6, 1, 'Desarrollo e Innovación Empresarial', 'Disfruto generando nuevas ideas y soluciones.', 204, NULL),
(395, 'UTCCG-3', 6, 1, 'Desarrollo e Innovación Empresarial', 'Me gusta asumir retos y buscar oportunidades de mejora en los procesos.', 204, NULL),
(396, 'UTCCG-3', 6, 1, 'Desarrollo e Innovación Empresarial', 'Encuentro emocionante la posibilidad de crear y dirigir un negocio.', 204, NULL),
(397, 'UTCCG-3', 6, 1, 'Mantenimiento Industrial', 'Disfruto resolviendo problemas técnicos y aplicando soluciones prácticas.', 204, NULL),
(398, 'UTCCG-3', 6, 1, 'Mantenimiento Industrial', 'Me siento atraído(a) por la idea de mantener y optimizar equipos industriales.', 204, NULL),
(399, 'UTCCG-3', 6, 1, 'Mantenimiento Industrial', 'Valoro la importancia de mantener un entorno industrial seguro y eficiente.', 204, NULL),
(400, 'UTCCG-3', 6, 1, 'Metal Mecánica', 'Me gusta entender cómo funcionan los dispositivos y sistemas mecánicos.', 204, NULL),
(401, 'UTCCG-3', 6, 1, 'Metal Mecánica', 'Te sientes cómodo(a) utilizando herramientas y maquinaria en tus actividades', 204, NULL),
(402, 'UTCCG-3', 6, 1, 'Metal Mecánica', 'Disfruto del proceso de creación y fabricación de objetos.', 204, NULL),
(403, 'UTCCG-3', 6, 1, 'Procesos Alimentarios', 'Valoro la importancia de la seguridad alimentaria y la calidad de los productos.', 204, NULL),
(404, 'UTCCG-3', 6, 1, 'Procesos Alimentarios', 'Me interesa el proceso de producción de alimentos y bebidas.', 204, NULL),
(405, 'UTCCG-3', 6, 1, 'Procesos Alimentarios', 'Disfruto experimentando con recetas e ingredientes.', 204, NULL),
(406, 'UTCCG-3', 6, 1, 'Tecnologías de la Información', 'Disfruto resolviendo problemas relacionados con software y hardware.', 204, NULL),
(407, 'UTCCG-3', 6, 1, 'Tecnologías de la Información', 'Me siento cómodo(a) utilizando y explorando nuevas tecnologías', 204, NULL),
(408, 'UTCCG-3', 6, 1, 'Tecnologías de la Información', 'Me atrae la idea de trabajar en el desarrollo y mantenimiento de sistemas informáticos.', 204, NULL),
(409, 'UTCCG-3', 6, 1, 'Logística Internacional', 'Valoro la eficiencia en la cadena de suministro y la distribución de productos.', 204, NULL),
(410, 'UTCCG-3', 6, 1, 'Logística Internacional', 'Me interesa la coordinación y optimización de procesos logísticos a nivel internacional', 204, NULL),
(411, 'UTCCG-3', 6, 1, 'Logística Internacional', 'Disfruto planificando y organizando actividades logísticas.', 204, NULL),
(412, 'UTCCG-3', 6, 1, 'Licenciatura en Gestión y Desarrollo Turístico', 'Me interesa la gestión y planificación de servicios turísticos.', 204, NULL),
(413, 'UTCCG-3', 6, 1, 'Licenciatura en Gestión y Desarrollo Turístico', 'Disfruto interactuando con personas y brindando experiencias positivas a los demás.', 204, NULL),
(414, 'UTCCG-3', 6, 1, 'Licenciatura en Gestión y Desarrollo Turístico', 'Me apasiona aprender sobre diferentes culturas y destinos turísticos.', 204, NULL),
(415, 'UTCCG-3', 6, 1, 'Gastronomía', 'Me gusta experimentar con la cocina y crear nuevas recetas.', 204, NULL),
(416, 'UTCCG-3', 6, 1, 'Gastronomía', 'Disfruto trabajando con ingredientes y presentando platillos de manera atractiva', 204, NULL),
(417, 'UTCCG-3', 6, 1, 'Gastronomía', 'Valoro la importancia de la gastronomía en la cultura y la experiencia culinaria.', 204, NULL),
(418, 'UTCCG-3', 6, 1, 'Energías Renovables', 'Valoro la importancia de contribuir al cuidado del medio ambiente', 204, NULL),
(419, 'UTCCG-3', 6, 1, 'Energías Renovables', 'Disfruto explorando tecnologías y métodos para generar energía limpia.', 204, NULL),
(420, 'UTCCG-3', 6, 1, 'Energías Renovables', 'Me preocupa el impacto ambiental y estoy interesado(a) en soluciones sostenibles.', 204, NULL),
(421, 'TM-1', 9, 2, 'qrwretyugjhgrgef', 'qwrtytreweegr', 205, NULL),
(422, 'TM-1', 9, 2, 'retyugjghree2', 'erthyngbfew', 205, NULL),
(423, 'TM-1', 9, 2, 'qewretygjhrgew', '2q3wrehtrgsefawed', 205, NULL),
(424, 'UTCCG-4', 7, 1, 'Visual', 'Visual1', 206, NULL),
(425, 'UTCCG-4', 7, 1, 'Visual', 'Visual2', 206, NULL),
(426, 'UTCCG-4', 7, 1, 'Auditiva', 'wqegfvds', 206, NULL),
(427, 'UTCCG-4', 7, 1, 'Auditiva', 'wefrfewd', 206, NULL),
(428, 'UTCCG-4', 7, 1, 'Kinestesica', '3ewreewd', 206, NULL),
(429, 'UTCCG-4', 7, 1, 'Ejemplo2', '234rfewd', 206, NULL),
(430, 'UTCCG-5', 6, 1, 'Visual', 'Cat 1', 207, NULL),
(431, 'UTCCG-5', 6, 1, 'Visual', 'Cat 2', 207, NULL),
(432, 'UTCCG-5', 6, 1, 'Auditiva', 'Cat 5', 207, NULL),
(433, 'UTCCG-5', 6, 1, 'Auditiva', 'Cat 6', 207, NULL),
(434, 'UTCCG-5', 6, 1, 'Kinestesica', 'Cat 3', 207, NULL),
(435, 'UTCCG-5', 6, 1, 'Kinestesica', 'Cat4', 207, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `identificador` varchar(255) NOT NULL,
  `datos_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `respuesta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `identificador`, `datos_id`, `usuario_id`, `pregunta_id`, `respuesta`) VALUES
(478, 'UTCCG-5', 207, 6, 430, '0'),
(479, 'UTCCG-5', 207, 6, 431, '1'),
(480, 'UTCCG-5', 207, 6, 432, '1'),
(481, 'UTCCG-5', 207, 6, 433, '0'),
(482, 'UTCCG-5', 207, 6, 434, '1'),
(483, 'UTCCG-5', 207, 6, 435, '1'),
(484, 'UTCCG-3', 204, 6, 394, '5'),
(485, 'UTCCG-3', 204, 6, 395, '4'),
(486, 'UTCCG-3', 204, 6, 396, '4'),
(487, 'UTCCG-3', 204, 6, 397, '2'),
(488, 'UTCCG-3', 204, 6, 398, '5'),
(489, 'UTCCG-3', 204, 6, 399, '5'),
(490, 'UTCCG-3', 204, 6, 400, '5'),
(491, 'UTCCG-3', 204, 6, 401, '3'),
(492, 'UTCCG-3', 204, 6, 402, '4'),
(493, 'UTCCG-3', 204, 6, 403, '3'),
(494, 'UTCCG-3', 204, 6, 404, '4'),
(495, 'UTCCG-3', 204, 6, 405, '4'),
(496, 'UTCCG-3', 204, 6, 406, '5'),
(497, 'UTCCG-3', 204, 6, 407, '4'),
(498, 'UTCCG-3', 204, 6, 408, '5'),
(499, 'UTCCG-3', 204, 6, 409, '4'),
(500, 'UTCCG-3', 204, 6, 410, '4'),
(501, 'UTCCG-3', 204, 6, 411, '3'),
(502, 'UTCCG-3', 204, 6, 412, '4'),
(503, 'UTCCG-3', 204, 6, 413, '4'),
(504, 'UTCCG-3', 204, 6, 414, '5'),
(505, 'UTCCG-3', 204, 6, 415, '5'),
(506, 'UTCCG-3', 204, 6, 416, '3'),
(507, 'UTCCG-3', 204, 6, 417, '4'),
(508, 'UTCCG-3', 204, 6, 418, '4'),
(509, 'UTCCG-3', 204, 6, 419, '2'),
(510, 'UTCCG-3', 204, 6, 420, '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sadmin`
--

CREATE TABLE `sadmin` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sadmin`
--

INSERT INTO `sadmin` (`id`, `nombre_completo`, `correo`, `contraseña`) VALUES
(1, 'Luis Fernando', 'luisferivera44@gmail.com', '3e9d7c120b10153caaac5f517c30c95bd6bd51e30a355bcfdd426f5f698a237dfc7fe3d01de206b8cf41ecf8c8f20ebe8945c92dfec9033156e5d3408cd27a92');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `clave_interna` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `edad`, `correo`, `contrasena`, `empresa_id`, `estado`, `clave_interna`, `sexo`) VALUES
(4, 'Valentina', 'Hernández Morales', 22, 'Valentina.Hernandez@utcgg.edu.mx', '$2y$10$NglCa59TxYVIPFL/pFVYuOfWMu.tgTd9l7NdcbEQ9dwNqCgkgmA5W', 1, 'No Activo', 'UTCCG20307001', 'Femenino'),
(5, 'Rodrigo', 'Torres Sánchez', 23, 'Rodrigo.Torres@utcgg.edu.mx', '$2y$10$ykxas.DbXkvlAUT/wHxQCuWAg0fHhrcIPKSjTvIOuPIezqJZ3x8Km', 1, 'Activo', 'UTCCG20307002', 'Masculino'),
(6, 'Alejandra', 'Morales Delgado', 25, 'Alejandra.Morales@utcgg.edu.mx', '$2y$10$dXqQZxKpouR6GgBYPKcNS.S6T1lJvLTvHNXUy/wGcdwiRUI9/hngm', 1, 'Activo', 'UTCCG20307003', 'Femenino'),
(7, 'Natalia', 'González Ríos', 21, 'Natalia.Gonzalez@utcgg.edu.mx', '$2y$10$EuCDf8CHA2Y5ZjsvA.Q.9e3KY2TyY1MXlUdL3Ssc6uxTbj.q5tvnO', 1, 'Activo', 'UTCCG20307004', 'Femenino'),
(8, 'Alejandro', 'López Méndez', 24, 'Alejandro.Lopez@utcgg.edu.mx', '$2y$10$YK/.cLFjX3RFUkboJbAJ0uOlwTVg7zkZfSn3VgNZBbjeNJlMXX/T.', 1, 'Activo', 'UTCCG20307005', 'Masculino'),
(9, 'Camila', 'Ramírez Núñez', 19, 'Camila.Ramirez@utcgg.edu.mx', '$2y$10$l3fJvU4NtlXsGDENAAPgY.HgHtTjRNpOjjRD7gr69CGTYnylnPJOe', 1, 'Activo', 'UTCCG20307006', 'Femenino'),
(10, 'Mariana', 'Torres Herrera', 25, 'Mariana.Torres@utcgg.edu.mx', '$2y$10$GcOFouALEglzIx3xGTCpzudX9YPDfOqTsvahuUz0/O6WprjZZOuT.', 1, 'Activo', 'UTCCG20307007', 'Femenino'),
(11, 'Mariana', 'Torres Herrera', 25, 'Mariana.Torres@utcgg.edu.mx', '$2y$10$bw/nfR0hF3TjVsP6C9jz0e0DwZo0lENY1Xe.z9VU5a69xG6IUFUQS', 1, 'Activo', 'UTCCG20307007', 'Femenino'),
(12, 'Gabriela', 'Núñez González', 21, 'Gabriela.Nunez@utcgg.edu.mx', '$2y$10$7uXh8aINAy0yyBc3lP2gIeg5oD0RGsfP8GwYEb0v78MlijNoBXoqG', 1, 'Activo', 'UTCCG20307008', 'Femenino'),
(24, 'Daniel', 'López	García', 20, 'Daniel.Lopez@tecm.edu.mx', '$2y$10$y23TdLm6RXK1ExjC./9VD.HD6BWMv4Na/o6okBd9nE9TlKU0m93fi', 2, 'Activo', '20407014', 'Masculino');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_id` (`personal_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_id` (`personal_id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `datos_id` (`datos_id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sadmin`
--
ALTER TABLE `sadmin`
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
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT de la tabla `sadmin`
--
ALTER TABLE `sadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos`
--
ALTER TABLE `datos`
  ADD CONSTRAINT `datos_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `preguntas_ibfk_2` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `preguntas_ibfk_3` FOREIGN KEY (`datos_id`) REFERENCES `datos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
