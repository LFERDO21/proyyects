-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2023 a las 13:52:13
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
-- Base de datos: `poi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `nombre`, `descripcion`, `id_empresa`) VALUES
(24, 'Almacen Principal', 'Es el almacen principal de la Empresa', 42),
(25, 'Almacen Principal', 'Es el almacen principal de la Empresa', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bdproductos`
--

CREATE TABLE `bdproductos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `etiquetas` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_u` int(11) DEFAULT NULL,
  `precio_c` int(11) DEFAULT NULL,
  `id_provedor` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `inventario_minimo` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bdproductos`
--

INSERT INTO `bdproductos` (`id`, `codigo`, `id_empresa`, `nombre`, `descripcion`, `etiquetas`, `cantidad`, `precio_u`, `precio_c`, `id_provedor`, `id_almacen`, `inventario_minimo`) VALUES
(388, '17046', 42, 'ABRAZADERA 28.6 C/BLOQUEO', 'abrazadera 28.6 bloqueo va en la parte del cuadro para el asiento', '28.6 bloqueo abrazadera cuadro asiento', 15, 100, 25, 36, 24, 0),
(389, '17079', 42, 'ABRAZADERA 31.8 C/BOQUEO', 'abrazadera 31.8 bloqueo va en la parte del cuadro para el asiento', '31.8 bloqueo abrazadera cuadro asiento', 11, 120, 59, 36, 24, 0),
(390, '17091', 42, 'ABRAZADERA 31.8 VISION TORNILLO', 'abrazadera 31.8 bloqueo va en la parte del cuadro para el asiento', '31.8 bloqueo cuadro asiento ', -32, 90, 38, 36, 24, 0),
(391, '17080', 42, 'ABRAZADERA 35M C/BLOQUEO', 'abrazadera 35 bloqueo va en la parte del cuadro para el asiento', '35 bloqueo cuadro asiento', 7, 150, 60, 36, 24, 0),
(392, 'DOR012', 42, 'ADAPTADOR VALVULA', 'adaptador para las valvulas', 'adaptador valvula', 95, 19, 6, 36, 24, 0),
(393, 'H4', 42, 'AHORCADOR P/GOMAS D/POSTE', 'ahorcador para gomas de poste', 'ahorcador gomas poste', 13, 15, 3, 36, 24, 0),
(394, '34130', 42, 'AMORTIGUADOR P/CUADRO', 'amortiguador central para cuadro', 'amortiguador central cuadro', 7, 170, 85, 36, 24, 0),
(395, '711375', 42, 'ANFORA TERMICA OTOOKQ', 'botella termica', 'botella termica ', 3, 220, 138, 36, 24, 0),
(396, '25063', 42, 'ANFORA WINDSOR', 'botella termica', 'botella termica ', 3, 130, 78, 36, 24, 0),
(397, '25152', 42, 'ANFORA ZEFAL ARTICA/TERMICA', 'botella zefal acrilico termica', 'botella termica', 2, 300, 234, 36, 24, 0),
(398, '163454', 42, 'ARNES P/MOCHILA D/PRECAUCIÓN RECARGABLE', 'arnes para las mochilas precausion recargable', 'arnes mochila recargable', 6, 460, 357, 36, 24, 0),
(399, '185', 42, 'ARO 20 ACERO', 'aro 20 acero ruedas', 'aro 20 ruedas acero', 2, 140, 75, 36, 24, 0),
(400, '84', 42, 'ARO 20 ALUM 36H', 'aro 20 aluminio ruedas', 'aro 20 ruedas aluminio', 4, 150, 63, 36, 24, 0),
(401, '2454', 42, 'ARO 24 ACERO', 'aro 24 aceroruedas', 'aro 24 ruedas acero', 17, 160, 88, 36, 24, 0),
(402, '85', 42, 'ARO 24 ALUMINIO 36H', 'aro 24 aluminio ruedas', 'aro 24 ruedas aluminio', 9, 170, 93, 36, 24, 0),
(403, 'A26F', 42, 'ARO 26 ACERO', 'aro 26 acero ruedas', 'aro 26 ruedas acero', 10, 160, 90, 36, 24, 0),
(404, '85029', 42, 'ARO 26 ALUMINIO 36H', 'aro 26 aluminio ruedas', 'aro 26 ruedas aluminio 36h ', 37, 170, 95, 36, 24, 0),
(405, '85051', 42, 'ARO 26 DOBLE FONDO ALUM', 'aro doble fondo aluminio', 'aro doble fondo aluminio', 12, 230, 118, 36, 24, 0),
(406, '86', 42, 'ARO 26 TRICARGA', 'aro tricarga', 'aro triciclo tricarga', 5, 210, 109, 36, 24, 0),
(407, '4575', 42, 'ARO 29 ALUM 36H', 'aro 29 aluminio 36h', '29 aluminio 36h', 6, 190, 0, 36, 24, 0),
(408, '12131', 42, 'ASIENTO AIR SOFT PLUS', 'asiento air soft plus', 'asiento ', 13, 130, 65, 36, 24, 0),
(409, '12130', 42, 'ASIENTO AIR SYSTEM UB-MAX', 'asiento air system ub-max', 'asiento ub-max', 17, 130, 78, 36, 24, 0),
(410, 'A12A', 42, 'ASIENTO ANCHO NHL&BCM', 'asiento ancho triciclo nhl', 'asiento ancho resorte triciclo tricarga', 12, 250, 110, 36, 24, 0),
(411, 'A12', 42, 'ASIENTO BALONA NAHEL', 'asiento balona nahel', 'balona asiento nahel', 9, 160, 55, 36, 24, 0),
(412, '12091', 42, 'ASIENTO C/RESORTE CAFE/BLANC MARILUZ', 'asiento cafe con resorte', 'cafe asiento resorte mariluz', 6, 190, 102, 36, 24, 0),
(413, '501', 42, 'ASIENTO DEPREDATOR', 'asiento depredator', 'depredator asiento', 3, 200, 85, 36, 24, 0),
(414, '11998', 42, 'ASIENTO HAPPY NHL', 'asiento nhl happy', 'asiento nhl happy', -1, 200, 76, 36, 24, 0),
(415, 'A164', 42, 'ASIENTO NAHEL', 'asiento nahel', 'asiento nahel', 14, 100, 45, 36, 24, 0),
(416, '1300', 42, 'ASIENTO NIÑA', 'asiento para niña', 'niña asiento', 13, 150, 70, 36, 24, 0),
(417, '13910', 42, 'ASIENTO NIÑA CICLOMETA', 'asiento para niña ciclometa', '', 5, 150, 0, 36, 24, 0),
(418, '11106', 42, 'ASIENTO NIÑO', 'asiento para niño', '', 7, 150, 73, 36, 24, 0),
(419, '13041', 42, 'ASIENTO NIÑO MARILUZ', 'asiento para niño mariluz', '', 8, 150, 71, 36, 24, 0),
(420, 'ANHL', 42, 'ASIENTO NIÑO NHL', 'asiento para niño nhl', '', -1, 100, 43, 36, 24, 0),
(421, 'A240', 42, 'ASIENTO PACIFIC', 'asiento pacific', '', 5, 240, 120, 36, 24, 0),
(422, 'A280', 42, 'ASIENTO PROSTATIC UB-MAX', 'asiento prostatico ub-max', '', 6, 280, 140, 36, 24, 0),
(423, 'A200', 42, 'ASIENTO ROSA RESORTE ANCHO', 'asiento con resorte ancho rosa', '', 2, 210, 119, 36, 24, 0),
(424, '2352', 42, 'ASIENTO SPORTS C/Resorte', 'asiento sport con resorte', '', 2, 190, 119, 36, 24, 0),
(425, '50362', 42, 'ASIENTO SUAVE SYSTEM', 'asiento suave system', '', 7, 130, 63, 36, 24, 0),
(426, '1602', 42, 'ASIENTO UB-MAX C/RESORTE', 'asiento ub-max', '', 12, 190, 110, 36, 24, 0),
(427, '17061', 42, 'Abrazadera Asiento 31.8 VISIÓN Negra', 'abrazadera asiento 31.8 vision negro', '', 3, 120, 45, 36, 24, 0),
(428, '17056', 42, 'Abrazadera P/Poste Asiento 31.8 VISIÓN Negro', 'abrazadera para poste asiento 31.8 vision negro', '', 5, 110, 89, 36, 24, 0),
(429, '17067', 42, 'Abrazadera P/Poste Asiento 35.0 VISIÓN Blanca', 'abrazadera asiento 35 vision blanco', '', 5, 110, 89, 36, 24, 0),
(430, '860116', 42, 'Abrazadera Para Poste De Asiento 31.8 mm', 'abrazadera poste asiento 31.8 ', '', 3, 25, 14, 36, 24, 0),
(431, '46620', 42, 'Adaptador para poste de aluminio 28.6 x 25.4 x 150mm', 'adaptador para poste de aluminio', '', 5, 80, 24, 36, 24, 0),
(432, '53', 42, 'Ahorcador P/Chicote', 'ahorcador chicote', '', 9811, 10, 4, 36, 24, 0),
(433, '121', 42, 'Ahorcador P/Freno', 'ahorcador freno', '', 44, 10, 1, 36, 24, 0),
(434, '77', 42, 'Alfiler', 'alfiler', '', 84, 10, 2, 36, 24, 0),
(435, '2300', 42, 'Asiento AERODINÁMICO MUJER Negro/Rosa', 'asiento aerodinamico negro y rosa', '', 2, 230, 0, 36, 24, 0),
(436, '52', 42, 'Asiento CONENECT Profesional', 'asiento profersional', '', 0, 400, 0, 36, 24, 0),
(437, '17046', 43, 'ABRAZADERA 28.6 C/BLOQUEO', 'abrazadera 28.6 bloqueo va en la parte del cuadro para el asiento', '28.6 bloqueo abrazadera cuadro asiento', 24, 100, 25, 37, 25, 0),
(438, '17079', 43, 'ABRAZADERA 31.8 C/BOQUEO', 'abrazadera 31.8 bloqueo va en la parte del cuadro para el asiento', '31.8 bloqueo abrazadera cuadro asiento', 14, 120, 59, 37, 25, 0),
(439, '17091', 43, 'ABRAZADERA 31.8 VISION TORNILLO', 'abrazadera 31.8 bloqueo va en la parte del cuadro para el asiento', '31.8 bloqueo cuadro asiento ', 3, 90, 38, 37, 25, 0),
(440, '17080', 43, 'ABRAZADERA 35M C/BLOQUEO', 'abrazadera 35 bloqueo va en la parte del cuadro para el asiento', '35 bloqueo cuadro asiento', 10, 150, 60, 37, 25, 0),
(441, 'DOR012', 43, 'ADAPTADOR VALVULA', 'adaptador para las valvulas', 'adaptador valvula', 95, 19, 6, 37, 25, 0),
(442, 'H4', 43, 'AHORCADOR P/GOMAS D/POSTE', 'ahorcador para gomas de poste', 'ahorcador gomas poste', 13, 15, 3, 37, 25, 0),
(443, '34130', 43, 'AMORTIGUADOR P/CUADRO', 'amortiguador central para cuadro', 'amortiguador central cuadro', 8, 170, 85, 37, 25, 0),
(444, '711375', 43, 'ANFORA TERMICA OTOOKQ', 'botella termica', 'botella termica ', 3, 220, 138, 37, 25, 0),
(445, '25063', 43, 'ANFORA WINDSOR', 'botella termica', 'botella termica ', 2, 130, 78, 37, 25, 0),
(446, '25152', 43, 'ANFORA ZEFAL ARTICA/TERMICA', 'botella zefal acrilico termica', 'botella termica', 2, 300, 234, 37, 25, 0),
(447, '163454', 43, 'ARNES P/MOCHILA D/PRECAUCIÓN RECARGABLE', 'arnes para las mochilas precausion recargable', 'arnes mochila recargable', 6, 460, 357, 37, 25, 0),
(448, '185', 43, 'ARO 20 ACERO', 'aro 20 acero ruedas', 'aro 20 ruedas acero', 2, 140, 75, 37, 25, 0),
(449, '84', 43, 'ARO 20 ALUM 36H', 'aro 20 aluminio ruedas', 'aro 20 ruedas aluminio', 4, 150, 63, 37, 25, 0),
(450, '2454', 43, 'ARO 24 ACERO', 'aro 24 aceroruedas', 'aro 24 ruedas acero', 17, 160, 88, 37, 25, 0),
(451, '85', 43, 'ARO 24 ALUMINIO 36H', 'aro 24 aluminio ruedas', 'aro 24 ruedas aluminio', 9, 170, 93, 37, 25, 0),
(452, 'A26F', 43, 'ARO 26 ACERO', 'aro 26 acero ruedas', 'aro 26 ruedas acero', 10, 160, 90, 37, 25, 0),
(453, '85029', 43, 'ARO 26 ALUMINIO 36H', 'aro 26 aluminio ruedas', 'aro 26 ruedas aluminio 36h ', 37, 170, 95, 37, 25, 0),
(454, '85051', 43, 'ARO 26 DOBLE FONDO ALUM', 'aro doble fondo aluminio', 'aro doble fondo aluminio', 12, 230, 118, 37, 25, 0),
(455, '86', 43, 'ARO 26 TRICARGA', 'aro tricarga', 'aro triciclo tricarga', 5, 210, 109, 37, 25, 0),
(456, '4575', 43, 'ARO 29 ALUM 36H', 'aro 29 aluminio 36h', '29 aluminio 36h', 7, 190, 0, 37, 25, 0),
(457, '12131', 43, 'ASIENTO AIR SOFT PLUS', 'asiento air soft plus', 'asiento ', 13, 130, 65, 37, 25, 0),
(458, '12130', 43, 'ASIENTO AIR SYSTEM UB-MAX', 'asiento air system ub-max', 'asiento ub-max', 17, 130, 78, 37, 25, 0),
(459, 'A12A', 43, 'ASIENTO ANCHO NHL&BCM', 'asiento ancho triciclo nhl', 'asiento ancho resorte triciclo tricarga', 12, 250, 110, 37, 25, 0),
(460, 'A12', 43, 'ASIENTO BALONA NAHEL', 'asiento balona nahel', 'balona asiento nahel', 9, 160, 55, 37, 25, 0),
(461, '12091', 43, 'ASIENTO C/RESORTE CAFE/BLANC MARILUZ', 'asiento cafe con resorte', 'cafe asiento resorte mariluz', 6, 190, 102, 37, 25, 0),
(462, '501', 43, 'ASIENTO DEPREDATOR', 'asiento depredator', 'depredator asiento', 5, 200, 85, 37, 25, 0),
(463, '11998', 43, 'ASIENTO HAPPY NHL', 'asiento nhl happy', 'asiento nhl happy', 0, 200, 76, 37, 25, 0),
(464, 'A164', 43, 'ASIENTO NAHEL', 'asiento nahel', 'asiento nahel', 14, 100, 45, 37, 25, 0),
(465, '1300', 43, 'ASIENTO NIÑA', 'asiento para niña', 'niña asiento', 13, 150, 70, 37, 25, 0),
(466, '13910', 43, 'ASIENTO NIÑA CICLOMETA', 'asiento para niña ciclometa', '', 5, 150, 0, 37, 25, 0),
(467, '11106', 43, 'ASIENTO NIÑO', 'asiento para niño', '', 7, 150, 73, 37, 25, 0),
(468, '13041', 43, 'ASIENTO NIÑO MARILUZ', 'asiento para niño mariluz', '', 8, 150, 71, 37, 25, 0),
(469, 'ANHL', 43, 'ASIENTO NIÑO NHL', 'asiento para niño nhl', '', 11, 100, 43, 37, 25, 0),
(470, 'A240', 43, 'ASIENTO PACIFIC', 'asiento pacific', '', 6, 240, 120, 37, 25, 0),
(471, 'A280', 43, 'ASIENTO PROSTATIC UB-MAX', 'asiento prostatico ub-max', '', 6, 280, 140, 37, 25, 0),
(472, 'A200', 43, 'ASIENTO ROSA RESORTE ANCHO', 'asiento con resorte ancho rosa', '', 2, 210, 119, 37, 25, 0),
(473, '2352', 43, 'ASIENTO SPORTS C/Resorte', 'asiento sport con resorte', '', 2, 190, 119, 37, 25, 0),
(474, '50362', 43, 'ASIENTO SUAVE SYSTEM', 'asiento suave system', '', 7, 130, 63, 37, 25, 0),
(475, '1602', 43, 'ASIENTO UB-MAX C/RESORTE', 'asiento ub-max', '', 12, 190, 110, 37, 25, 0),
(476, '17061', 43, 'Abrazadera Asiento 31.8 VISIÓN Negra', 'abrazadera asiento 31.8 vision negro', '', 3, 120, 45, 37, 25, 0),
(477, '17056', 43, 'Abrazadera P/Poste Asiento 31.8 VISIÓN Negro', 'abrazadera para poste asiento 31.8 vision negro', '', 5, 110, 89, 37, 25, 0),
(478, '17067', 43, 'Abrazadera P/Poste Asiento 35.0 VISIÓN Blanca', 'abrazadera asiento 35 vision blanco', '', 5, 110, 89, 37, 25, 0),
(479, '860116', 43, 'Abrazadera Para Poste De Asiento 31.8 mm', 'abrazadera poste asiento 31.8 ', '', 4, 25, 14, 37, 25, 0),
(480, '46620', 43, 'Adaptador para poste de aluminio 28.6 x 25.4 x 150mm', 'adaptador para poste de aluminio', '', 5, 80, 24, 37, 25, 0),
(481, '53', 43, 'Ahorcador P/Chicote', 'ahorcador chicote', '', 9811, 10, 4, 37, 25, 0),
(482, '121', 43, 'Ahorcador P/Freno', 'ahorcador freno', '', 44, 10, 1, 37, 25, 0),
(483, '77', 43, 'Alfiler', 'alfiler', '', 84, 10, 2, 37, 25, 0),
(484, '2300', 43, 'Asiento AERODINÁMICO MUJER Negro/Rosa', 'asiento aerodinamico negro y rosa', '', 2, 230, 0, 37, 25, 0),
(485, '52', 43, 'Asiento CONENECT Profesional', 'asiento profersional', '', 1, 400, 0, 37, 25, 0),
(486, '7506425624669', 42, 'toallitasw', 'tuallitas humedas huggies', 'toallitas humedas ', 134, 45, 76, 36, 24, 5),
(487, '8726383', 42, 'eje tracero', 'Eje tracero de bicicicleta taiwanes, se encuentra en estante metalico 1', 'taiwan eje tracero ', 12312, 1234, 123, 36, 24, 10),
(488, '17046', 42, 'ABRAZADERA 28.6 C/BLOQUEO', 'abrazadera 28.6 bloqueo va en la parte del cuadro para el asiento', '28.6 bloqueo abrazadera cuadro asiento', 30, 100, 25, 36, 24, 0),
(489, '17079', 42, 'ABRAZADERA 31.8 C/BOQUEO', 'abrazadera 31.8 bloqueo va en la parte del cuadro para el asiento', '31.8 bloqueo abrazadera cuadro asiento', 14, 120, 59, 36, 24, 0),
(490, '17091', 42, 'ABRAZADERA 31.8 VISION TORNILLO', 'abrazadera 31.8 bloqueo va en la parte del cuadro para el asiento', '31.8 bloqueo cuadro asiento ', 8, 90, 38, 36, 24, 0),
(491, '17080', 42, 'ABRAZADERA 35M C/BLOQUEO', 'abrazadera 35 bloqueo va en la parte del cuadro para el asiento', '35 bloqueo cuadro asiento', 10, 150, 60, 36, 24, 0),
(492, 'DOR012', 42, 'ADAPTADOR VALVULA', 'adaptador para las valvulas', 'adaptador valvula', 95, 19, 6, 36, 24, 0),
(493, 'H4', 42, 'AHORCADOR P/GOMAS D/POSTE', 'ahorcador para gomas de poste', 'ahorcador gomas poste', 5, 15, 3, 36, 24, 0),
(494, '34130', 42, 'AMORTIGUADOR P/CUADRO', 'amortiguador central para cuadro', 'amortiguador central cuadro', 8, 170, 85, 36, 24, 0),
(495, '711375', 42, 'ANFORA TERMICA OTOOKQ', 'botella termica', 'botella termica ', 3, 220, 138, 36, 24, 0),
(496, '25063', 42, 'ANFORA WINDSOR', 'botella termica', 'botella termica ', 4, 130, 78, 36, 24, 0),
(497, '25152', 42, 'ANFORA ZEFAL ARTICA/TERMICA', 'botella zefal acrilico termica', 'botella termica', 2, 300, 234, 36, 24, 0),
(498, '163454', 42, 'ARNES P/MOCHILA D/PRECAUCIÓN RECARGABLE', 'arnes para las mochilas precausion recargable', 'arnes mochila recargable', 6, 460, 357, 36, 24, 0),
(499, '185', 42, 'ARO 20 ACERO', 'aro 20 acero ruedas', 'aro 20 ruedas acero', 2, 140, 75, 36, 24, 0),
(500, '84', 42, 'ARO 20 ALUM 36H', 'aro 20 aluminio ruedas', 'aro 20 ruedas aluminio', 4, 150, 63, 36, 24, 0),
(501, '2454', 42, 'ARO 24 ACERO', 'aro 24 aceroruedas', 'aro 24 ruedas acero', 17, 160, 88, 36, 24, 0),
(502, '85', 42, 'ARO 24 ALUMINIO 36H', 'aro 24 aluminio ruedas', 'aro 24 ruedas aluminio', 9, 170, 93, 36, 24, 0),
(503, 'A26F', 42, 'ARO 26 ACERO', 'aro 26 acero ruedas', 'aro 26 ruedas acero', 10, 160, 90, 36, 24, 0),
(504, '85029', 42, 'ARO 26 ALUMINIO 36H', 'aro 26 aluminio ruedas', 'aro 26 ruedas aluminio 36h ', 37, 170, 95, 36, 24, 0),
(505, '85051', 42, 'ARO 26 DOBLE FONDO ALUM', 'aro doble fondo aluminio', 'aro doble fondo aluminio', 12, 230, 118, 36, 24, 0),
(506, '86', 42, 'ARO 26 TRICARGA', 'aro tricarga', 'aro triciclo tricarga', 5, 210, 109, 36, 24, 0),
(507, '4575', 42, 'ARO 29 ALUM 36H', 'aro 29 aluminio 36h', '29 aluminio 36h', 7, 190, 0, 36, 24, 0),
(508, '12131', 42, 'ASIENTO AIR SOFT PLUS', 'asiento air soft plus', 'asiento ', 13, 130, 65, 36, 24, 0),
(509, '12130', 42, 'ASIENTO AIR SYSTEM UB-MAX', 'asiento air system ub-max', 'asiento ub-max', 17, 130, 78, 36, 24, 0),
(510, 'A12A', 42, 'ASIENTO ANCHO NHL&BCM', 'asiento ancho triciclo nhl', 'asiento ancho resorte triciclo tricarga', 12, 250, 110, 36, 24, 0),
(511, 'A12', 42, 'ASIENTO BALONA NAHEL', 'asiento balona nahel', 'balona asiento nahel', 9, 160, 55, 36, 24, 0),
(512, '12091', 42, 'ASIENTO C/RESORTE CAFE/BLANC MARILUZ', 'asiento cafe con resorte', 'cafe asiento resorte mariluz', 6, 190, 102, 36, 24, 0),
(513, '501', 42, 'ASIENTO DEPREDATOR', 'asiento depredator', 'depredator asiento', 5, 200, 85, 36, 24, 0),
(514, '11998', 42, 'ASIENTO HAPPY NHL', 'asiento nhl happy', 'asiento nhl happy', 0, 200, 76, 36, 24, 0),
(515, 'A164', 42, 'ASIENTO NAHEL', 'asiento nahel', 'asiento nahel', 13, 100, 45, 36, 24, 0),
(516, '1300', 42, 'ASIENTO NIÑA', 'asiento para niña', 'niña asiento', 13, 150, 70, 36, 24, 0),
(517, '13910', 42, 'ASIENTO NIÑA CICLOMETA', 'asiento para niña ciclometa', '', 5, 150, 0, 36, 24, 0),
(518, '11106', 42, 'ASIENTO NIÑO', 'asiento para niño', '', 7, 150, 73, 36, 24, 0),
(519, '13041', 42, 'ASIENTO NIÑO MARILUZ', 'asiento para niño mariluz', '', 8, 150, 71, 36, 24, 0),
(520, 'ANHL', 42, 'ASIENTO NIÑO NHL', 'asiento para niño nhl', '', 11, 100, 43, 36, 24, 0),
(521, 'A240', 42, 'ASIENTO PACIFIC', 'asiento pacific', '', 6, 240, 120, 36, 24, 0),
(522, 'A280', 42, 'ASIENTO PROSTATIC UB-MAX', 'asiento prostatico ub-max', '', 6, 280, 140, 36, 24, 0),
(523, 'A200', 42, 'ASIENTO ROSA RESORTE ANCHO', 'asiento con resorte ancho rosa', '', 2, 210, 119, 36, 24, 0),
(524, '2352', 42, 'ASIENTO SPORTS C/Resorte', 'asiento sport con resorte', '', 2, 190, 119, 36, 24, 0),
(525, '50362', 42, 'ASIENTO SUAVE SYSTEM', 'asiento suave system', '', 7, 130, 63, 36, 24, 0),
(526, '1602', 42, 'ASIENTO UB-MAX C/RESORTE', 'asiento ub-max', '', 12, 190, 110, 36, 24, 0),
(527, '17061', 42, 'Abrazadera Asiento 31.8 VISIÓN Negra', 'abrazadera asiento 31.8 vision negro', '', 3, 120, 45, 36, 24, 0),
(528, '17056', 42, 'Abrazadera P/Poste Asiento 31.8 VISIÓN Negro', 'abrazadera para poste asiento 31.8 vision negro', '', 5, 110, 89, 36, 24, 0),
(529, '17067', 42, 'Abrazadera P/Poste Asiento 35.0 VISIÓN Blanca', 'abrazadera asiento 35 vision blanco', '', 5, 110, 89, 36, 24, 0),
(530, '860116', 42, 'Abrazadera Para Poste De Asiento 31.8 mm', 'abrazadera poste asiento 31.8 ', '', 4, 25, 14, 36, 24, 0),
(531, '46620', 42, 'Adaptador para poste de aluminio 28.6 x 25.4 x 150mm', 'adaptador para poste de aluminio', '', 5, 80, 24, 36, 24, 0),
(532, '53', 42, 'Ahorcador P/Chicote', 'ahorcador chicote', '', 9811, 10, 4, 36, 24, 0),
(533, '121', 42, 'Ahorcador P/Freno', 'ahorcador freno', '', 44, 10, 1, 36, 24, 0),
(534, '77', 42, 'Alfiler', 'alfiler', '', 84, 10, 2, 36, 24, 0),
(535, '2300', 42, 'Asiento AERODINÁMICO MUJER Negro/Rosa', 'asiento aerodinamico negro y rosa', '', 2, 230, 0, 36, 24, 0),
(536, '52', 42, 'Asiento CONENECT Profesional', 'asiento profersional', '', 1, 400, 0, 36, 24, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `blacklist`
--

INSERT INTO `blacklist` (`id`, `id_usuario`, `descripcion`, `fecha`, `id_empresa`, `area`) VALUES
(63, NULL, 'La empresa Bici art se creó 2023-10-22 09:28:30 Lista para usarse', '2023-10-22 01:28:30', 42, 'Inicialización de empresa'),
(64, NULL, 'Se creó \'Almacen Principal\' predeterminado para usarse libremente, Aquí se almacenarán los productos que no tengan un almacén predeterminado, para asignar otro almacén agrégalo en \'Agregar Almacén\'', '2023-10-22 01:28:30', 42, 'Inicialización de empresa'),
(65, NULL, 'Se creó \'Cliente General\' predeterminado para usarse libremente, Este cliente no tendrá ningún % de descuento, para tener un cliente con descuento agrégalo en \'Agregar Cliente\'', '2023-10-22 01:28:30', 42, 'Inicialización de empresa'),
(66, NULL, 'Se creó \'Sin Proveedor\' predeterminado para usarse libremente, Si deseas agregar un Proveedor agrégalo en \'Agregar Proveedor\'', '2023-10-22 01:28:30', 42, 'Inicialización de empresa'),
(67, NULL, 'El estado de la empresa  cambió a activo en 2023-10-22 09:28:46', '2023-10-22 01:28:46', 42, 'Estado de empresa'),
(68, NULL, 'La empresa DevStore se creó 2023-10-23 09:04:20 Lista para usarse', '2023-10-23 01:04:20', 43, 'Inicialización de empresa'),
(69, NULL, 'Se creó \'Almacen Principal\' predeterminado para usarse libremente, Aquí se almacenarán los productos que no tengan un almacén predeterminado, para asignar otro almacén agrégalo en \'Agregar Almacén\'', '2023-10-23 01:04:20', 43, 'Inicialización de empresa'),
(70, NULL, 'Se creó \'Cliente General\' predeterminado para usarse libremente, Este cliente no tendrá ningún % de descuento, para tener un cliente con descuento agrégalo en \'Agregar Cliente\'', '2023-10-23 01:04:20', 43, 'Inicialización de empresa'),
(71, NULL, 'Se creó \'Sin Proveedor\' predeterminado para usarse libremente, Si deseas agregar un Proveedor agrégalo en \'Agregar Proveedor\'', '2023-10-23 01:04:20', 43, 'Inicialización de empresa'),
(72, NULL, 'El estado de la empresa  cambió a activo en 2023-10-23 09:04:21', '2023-10-23 01:04:21', 43, 'Estado de empresa'),
(73, NULL, 'Un(os) dato(s) se modificó(aron): Plan: Plan1 -> PlanGrupo1', '2023-10-24 14:55:45', 42, 'Datos de empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `correo`, `telefono`, `id_empresa`, `descuento`) VALUES
(92, 'Cliente General', NULL, NULL, 42, '0.00'),
(93, 'LFerdo', 'luis_ferherrera21@hotmail.com', '7421035678', 42, '23.00'),
(94, 'Cliente General', NULL, NULL, 43, '0.00'),
(95, 'seco', 'denis_a@hotmail.com', '7421112121', 42, '20.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ubicacion` varchar(200) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `id_plan` int(11) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `status` enum('activo','no activo') NOT NULL DEFAULT 'no activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `ubicacion`, `fecha_registro`, `id_plan`, `id_grupo`, `status`) VALUES
(42, 'Bici art', 'Petatlan Centro', '2023-10-22', 4, NULL, 'activo'),
(43, 'DevStore', 'Guadalajara', '2023-10-23', 1, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `planes` varchar(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `limite_clientes` int(11) DEFAULT NULL,
  `limite_proveedores` int(11) DEFAULT 0,
  `limite_duenos` int(11) NOT NULL DEFAULT 0,
  `limite_cajas` int(11) NOT NULL DEFAULT 0,
  `limite_supervisores` int(11) NOT NULL DEFAULT 0,
  `limite_productos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `planes`, `costo`, `descripcion`, `limite_clientes`, `limite_proveedores`, `limite_duenos`, `limite_cajas`, `limite_supervisores`, `limite_productos`) VALUES
(1, 'Plan1', 400, 'Este plan tiene un costo de $400', 6, 6, 1, 1, 0, 200),
(2, 'Plan2', 500, 'Este plan tiene un costo de $500', 11, 11, 1, 2, 0, 350),
(3, 'Plan3', 600, 'Este plan tiene un costo de $600', 50, 50, 1, 5, 1, 500),
(4, 'PlanGrupo1', 500, 'Este plan tiene un costo de $500 por tienda perteneciente al grupo', 11, 11, 1, 2, 1, 500),
(5, 'PlanGrupo2', 600, 'Este plan tiene un costo de $600 por tienda perteneciente al grupo\r\n\r\n', 50, 50, 1, 3, 2, 600),
(6, 'PlanGrupo3', 700, 'Este plan tiene un costo de $700 por tienda perteneciente al grupo\r\n\r\n', 100, 100, 1, 5, 3, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `contacto_correo` varchar(100) DEFAULT NULL,
  `contacto_telefono` varchar(15) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provedor`
--

INSERT INTO `provedor` (`id`, `nombre`, `contacto_correo`, `contacto_telefono`, `descripcion`, `id_empresa`) VALUES
(36, 'Sin Proveedor', NULL, NULL, 'Los productos asociados a este Proveedor no tienen un contacto fijo', 42),
(37, 'Sin Proveedor', NULL, NULL, 'Los productos asociados a este Proveedor no tienen un contacto fijo', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `numero_telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `status` varchar(15) DEFAULT 'desactivado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `superadmin`
--

INSERT INTO `superadmin` (`id`, `nombre_completo`, `apellido_paterno`, `apellido_materno`, `numero_telefono`, `correo`, `contrasena`, `rol`, `status`) VALUES
(2, 'Luis Fernando', 'Rivera', 'Herrera', '+521164424', 'sadmin@hotmail.com', '$2y$10$MDxHeNqcFYyEdpQVkHtYQeAu.KWFL36y2CeV30gMMAeKl2E5/744u', 'Sadmin', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tikets`
--

CREATE TABLE `tikets` (
  `id` int(11) NOT NULL,
  `folio` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_productos` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `precio_u` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `sub_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `devolucion` varchar(255) DEFAULT '',
  `metodo_pago` varchar(255) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tikets`
--

INSERT INTO `tikets` (`id`, `folio`, `fecha`, `id_empresa`, `id_productos`, `id_usuario`, `id_cliente`, `precio_u`, `cantidad`, `sub_total`, `devolucion`, `metodo_pago`, `monto`) VALUES
(223, 1, '2023-10-21 05:21:52', 42, 388, 34, 92, '100.00', 1, '100.00', '', 'efectivo', '0.00'),
(224, 2, '2023-10-22 05:27:38', 42, 389, 34, 92, '120.00', 1, '120.00', '', 'efectivo', '0.00'),
(225, 2, '2023-10-22 05:27:38', 42, 391, 34, 92, '150.00', 1, '150.00', '', 'efectivo', '0.00'),
(226, 3, '2023-10-23 01:27:26', 42, 388, 34, 92, '100.00', 1, '100.00', '', 'efectivo', '0.00'),
(227, 4, '2023-10-23 01:28:13', 42, 388, 34, 92, '100.00', 1, '100.00', '', 'efectivo', '0.00'),
(228, 1, '2023-10-23 02:25:26', 43, 437, 35, 94, '100.00', 5, '100.00', 'Devuelto', 'efectivo', '0.00'),
(229, 1, '2023-10-23 02:25:26', 43, 445, 35, 94, '130.00', 1, '130.00', 'Devuelto', 'efectivo', '0.00'),
(230, 2, '2023-10-15 02:20:50', 43, 439, 35, 94, '90.00', 4, '38.00', 'Devuelto', 'efectivo', '0.00'),
(231, 5, '2023-10-23 05:43:35', 42, 396, 34, 92, '130.00', 1, '130.00', '', 'efectivo', '0.00'),
(232, 5, '2023-10-23 05:43:35', 42, 388, 34, 92, '100.00', 1, '100.00', '', 'efectivo', '0.00'),
(233, 5, '2023-10-22 05:43:35', 42, 390, 34, 92, '90.00', 37, '5000.00', 'Corrección', 'efectivo', '0.00'),
(234, 5, '2023-10-23 05:43:35', 42, 407, 34, 92, '190.00', 1, '190.00', '', 'efectivo', '0.00'),
(235, 5, '2023-10-23 05:43:35', 42, 421, 36, 92, '240.00', 1, '240.00', '', 'efectivo', '0.00'),
(236, 5, '2023-10-23 05:43:35', 42, 430, 36, 92, '25.00', 1, '25.00', '', 'efectivo', '0.00'),
(237, 5, '2023-10-23 05:43:35', 42, 436, 36, 92, '400.00', 1, '400.00', '', 'efectivo', '0.00'),
(238, 6, '2023-10-23 16:48:42', 42, 394, 34, 92, '170.00', 1, '170.00', '', 'efectivo', '0.00'),
(239, 6, '2023-10-23 16:48:42', 42, 414, 34, 92, '200.00', 1, '200.00', '', 'efectivo', '0.00'),
(240, 7, '2023-10-24 15:52:24', 42, 420, 34, 92, '100.00', 6, '600.00', 'Devuelto', 'efectivo', '0.00'),
(241, 7, '2023-10-24 15:52:24', 42, 493, 34, 92, '15.00', 4, '60.00', 'Devuelto', 'efectivo', '0.00'),
(242, 7, '2023-10-24 15:52:24', 42, 515, 34, 92, '100.00', 1, '100.00', '', 'efectivo', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `numero_telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `status` varchar(15) DEFAULT 'desactivado',
  `id_grupo` int(11) DEFAULT NULL,
  `imagen_hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `apellido_paterno`, `apellido_materno`, `id_empresa`, `numero_telefono`, `correo`, `contrasena`, `rol`, `status`, `id_grupo`, `imagen_hash`) VALUES
(34, 'Scherezada', 'Herrera', 'Moreno', 42, '+527421164424', 'shery@hotmail.com', '$2y$10$Ljm6zK4Vg/7VyEZhsucsFe4rzu6W/LQc6Sc4jjsAfBq3/RRa.I/Sq', 'Dueno', 'activo', NULL, '5452a5ac5777af65e0a4b2e527191c66'),
(35, 'Luis', 'Rivera', 'Herrera', 43, '7421164424', 'luisferivera44@gmail.com', '$2y$10$4TfJFpd0t2TLUVZV8nh9Ue8.tRa4m3rg30C/wkZ55XfMsyGIu64xO', 'Dueno', 'activo', NULL, '96ae5c3ab4340a0aa3c523ecb97209de'),
(36, 'Luis', 'Rivera', 'Herrera', 42, '', 'luisferivera45@gmail.com', '$2y$10$k3oElxd5zVJ2/RmgqKWS2eexGpO4.eyCzjv5/xvXADHGCIS.1LNdO', 'Caja', 'activo', NULL, 'c23bb3dc207895a2c60b4f87b3c1195a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `almacen_id_empresa_fk` (`id_empresa`);

--
-- Indices de la tabla `bdproductos`
--
ALTER TABLE `bdproductos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_provedor` (`id_provedor`),
  ADD KEY `bdproductos_id_almacen_fk` (`id_almacen`);

--
-- Indices de la tabla `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_plan` (`id_plan`),
  ADD KEY `empresa_ibfk_2` (`id_grupo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tikets`
--
ALTER TABLE `tikets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_productos` (`id_productos`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_ibfk_1` (`id_empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `bdproductos`
--
ALTER TABLE `bdproductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=537;

--
-- AUTO_INCREMENT de la tabla `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `provedor`
--
ALTER TABLE `provedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tikets`
--
ALTER TABLE `tikets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_id_empresa_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `bdproductos`
--
ALTER TABLE `bdproductos`
  ADD CONSTRAINT `bdproductos_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `bdproductos_ibfk_2` FOREIGN KEY (`id_provedor`) REFERENCES `provedor` (`id`),
  ADD CONSTRAINT `bdproductos_id_almacen_fk` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id`);

--
-- Filtros para la tabla `blacklist`
--
ALTER TABLE `blacklist`
  ADD CONSTRAINT `blacklist_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `blacklist_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id`),
  ADD CONSTRAINT `empresa_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `tikets`
--
ALTER TABLE `tikets`
  ADD CONSTRAINT `tikets_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `tikets_ibfk_2` FOREIGN KEY (`id_productos`) REFERENCES `bdproductos` (`id`),
  ADD CONSTRAINT `tikets_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `tikets_ibfk_4` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
