-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-06-2021 a las 20:00:25
-- Versión del servidor: 5.5.59
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `documentos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `archivo_id` int(11) NOT NULL,
  `denominacion` varchar(100) NOT NULL,
  `matricula` varchar(8) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `tipo_documento` varchar(4) NOT NULL,
  `documento` bigint(20) NOT NULL,
  `ejercicio` int(11) NOT NULL,
  `activo_corriente` decimal(20,2) NOT NULL,
  `activo_nocorriente` decimal(20,2) NOT NULL,
  `activo` decimal(20,2) NOT NULL,
  `pasivo_corriente` decimal(20,2) NOT NULL,
  `pasivo_nocorriente` decimal(20,2) NOT NULL,
  `pasivo` decimal(20,2) NOT NULL,
  `patrimonio_neto` decimal(20,2) NOT NULL,
  `venta_neta` decimal(20,2) NOT NULL,
  `resultado_final` decimal(20,2) NOT NULL,
  `bienes_uso` decimal(20,2) NOT NULL,
  `origen_bienes_uso` float NOT NULL DEFAULT '0',
  `depreciacion_bienes_uso` float NOT NULL DEFAULT '0',
  `resultado_reexpresion_bienes_uso` float NOT NULL DEFAULT '0',
  `metodo_pago` int(1) NOT NULL,
  `entidad` varchar(255) NOT NULL,
  `importe` decimal(20,2) NOT NULL,
  `excedente` int(11) NOT NULL DEFAULT '0',
  `numero_comprobante` varchar(150) NOT NULL,
  `cuenta_id` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `fecha_informe` date NOT NULL,
  `codigo_barras` text NOT NULL,
  PRIMARY KEY(archivo_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areaturnoonline`
--

CREATE TABLE `areaturnoonline` (
  `areaturnoonline_id` int(11) NOT NULL,
  `denominacion` varchar(250) NOT NULL,
  `cantidad_gestores` int(11) NOT NULL,
  `turnoonline_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditor`
--

CREATE TABLE `auditor` (
  `auditor_id` int(11) NOT NULL,
  `recurso` varchar(100) NOT NULL,
  `objeto` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `navegador` varchar(100) NOT NULL,
  `sistemaoperativo` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `detalle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones`
--

CREATE TABLE `capacitaciones` (
  `capacitacion_id` int(11) NOT NULL,
  `denominacion` text NOT NULL,
  `detalle` text NOT NULL,
  `url` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE `correos` (
  `correo` varchar(250) NOT NULL,
  `matricula` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `cuenta_id` int(11) NOT NULL,
  `denominacion` varchar(150) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestapreguntaresultado`
--

CREATE TABLE `encuestapreguntaresultado` (
  `encuestapreguntaresultado_id` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `encuestaresultado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestaresultado`
--

CREATE TABLE `encuestaresultado` (
  `encuestaresultado_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `matricula_id` int(11) NOT NULL,
  `encuesta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `encuesta_id` int(11) NOT NULL,
  `denominacion` text NOT NULL,
  `fecha` date NOT NULL,
  `activa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--

CREATE TABLE `entidades` (
  `entidad_id` int(11) NOT NULL,
  `denominacion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `estado_id` int(11) NOT NULL,
  `denominacion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `evento_id` int(11) NOT NULL,
  `denominacion` text NOT NULL,
  `ubicacion` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencianivel`
--

CREATE TABLE `experiencianivel` (
  `experiencianivel_id` int(11) NOT NULL,
  `denominacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE `gestion` (
  `gestion_id` int(11) NOT NULL,
  `denominacion` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `grupo_id` int(11) NOT NULL,
  `denominacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE `idiomas` (
  `idioma_id` int(11) NOT NULL,
  `denominacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculados`
--

CREATE TABLE `matriculados` (
  `matriculado_id` int(11) NOT NULL,
  `documento` bigint(20) NOT NULL,
  `matricula` varchar(7) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `correoelectronico` varchar(250) NOT NULL,
  `correoelectronico_visible_web` int(1) NOT NULL DEFAULT '0',
  `telefono` bigint(20) NOT NULL,
  `telefono_visible_web` int(1) NOT NULL DEFAULT '0',
  `celular` bigint(20) NOT NULL,
  `celular_visible_web` int(1) NOT NULL DEFAULT '0',
  `direccion` text NOT NULL,
  `direccion_visible_web` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculadoscursos`
--

CREATE TABLE `matriculadoscursos` (
  `matriculadocurso_id` int(11) NOT NULL,
  `matriculado_id` int(11) NOT NULL,
  `denominacion` text NOT NULL,
  `numero` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculadosdetalle`
--

CREATE TABLE `matriculadosdetalle` (
  `matriculadodetalle_id` int(11) NOT NULL,
  `matriculado_id` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `localidad` text NOT NULL,
  `provincia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculadosestudios`
--

CREATE TABLE `matriculadosestudios` (
  `matriculadoestudio_id` int(11) NOT NULL,
  `matriculado_id` int(11) NOT NULL,
  `universidad` text NOT NULL,
  `titulacion` text NOT NULL,
  `nota` int(11) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `actividades` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculadosexperiencias`
--

CREATE TABLE `matriculadosexperiencias` (
  `matriculadoexperiencia_id` int(11) NOT NULL,
  `matriculado_id` int(11) NOT NULL,
  `cargo` text NOT NULL,
  `empresa` text NOT NULL,
  `ubicacion` text NOT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `actual` int(1) NOT NULL DEFAULT '0',
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculadosidiomas`
--

CREATE TABLE `matriculadosidiomas` (
  `matriculadoidioma_id` int(11) NOT NULL,
  `matriculado_id` int(11) NOT NULL,
  `idioma_id` int(11) NOT NULL,
  `experiencianivel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `matricula_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `matricula` varchar(7) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `novedad_id` int(11) NOT NULL,
  `denominacion` text NOT NULL,
  `contenido` text NOT NULL,
  `activo` int(1) NOT NULL,
  `destacado` int(1) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE `opiniones` (
  `opinion_id` int(11) NOT NULL,
  `opinion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `matriculado_id` int(11) NOT NULL,
  `opiniontipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinionestipos`
--

CREATE TABLE `opinionestipos` (
  `opiniontipo_id` int(11) NOT NULL,
  `denominacion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `pregunta_id` int(11) NOT NULL,
  `denominacion` text NOT NULL,
  `encuesta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protocolos`
--

CREATE TABLE `protocolos` (
  `protocolo_id` int(11) NOT NULL,
  `archivo_id` int(11) NOT NULL,
  `numero` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `provincia_id` int(11) NOT NULL,
  `denominacion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `respuesta_id` int(11) NOT NULL,
  `denominacion` text NOT NULL,
  `pregunta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `seguimiento_id` int(11) NOT NULL,
  `archivo_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `comentario` longtext NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudturnoonline`
--

CREATE TABLE `solicitudturnoonline` (
  `solicitudturnoonline_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `documento` varchar(8) NOT NULL,
  `matricula` varchar(10) DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `barcode` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `usuario_id` int(11) DEFAULT NULL,
  `gestion_id` int(11) DEFAULT NULL,
  `areaturnoonline_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `tipo_id` int(11) NOT NULL,
  `denominacion` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnoonline`
--

CREATE TABLE `turnoonline` (
  `turnoonline_id` int(11) NOT NULL,
  `denominacion` varchar(250) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `hora_desde` time NOT NULL,
  `hora_hasta` time NOT NULL,
  `duracion_turno` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `denominacion` varchar(50) NOT NULL,
  `correoelectronico` varchar(100) NOT NULL,
  `token` varchar(32) NOT NULL,
  `actualizacion` int(11) NOT NULL DEFAULT '0',
  `nivel` int(1) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`archivo_id`),
  ADD KEY `tipo_id` (`tipo_id`),
  ADD KEY `tipo_documento` (`tipo_documento`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `areaturnoonline`
--
ALTER TABLE `areaturnoonline`
  ADD PRIMARY KEY (`areaturnoonline_id`),
  ADD KEY `turnoonline_id` (`turnoonline_id`);

--
-- Indices de la tabla `auditor`
--
ALTER TABLE `auditor`
  ADD PRIMARY KEY (`auditor_id`);

--
-- Indices de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD PRIMARY KEY (`capacitacion_id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`cuenta_id`);

--
-- Indices de la tabla `encuestapreguntaresultado`
--
ALTER TABLE `encuestapreguntaresultado`
  ADD PRIMARY KEY (`encuestapreguntaresultado_id`);

--
-- Indices de la tabla `encuestaresultado`
--
ALTER TABLE `encuestaresultado`
  ADD PRIMARY KEY (`encuestaresultado_id`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`encuesta_id`);

--
-- Indices de la tabla `entidades`
--
ALTER TABLE `entidades`
  ADD PRIMARY KEY (`entidad_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`estado_id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`evento_id`);
  ADD KEY `agenda_id` (`evento_id`);

--
-- Indices de la tabla `correos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`matricula`);
-- Indices de la tabla `experiencianivel`
--
ALTER TABLE `experiencianivel`
  ADD PRIMARY KEY (`experiencianivel_id`);

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`gestion_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`grupo_id`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`idioma_id`);

--
-- Indices de la tabla `matriculados`
--
ALTER TABLE `matriculados`
  ADD PRIMARY KEY (`matriculado_id`);

--
-- Indices de la tabla `matriculadoscursos`
--
ALTER TABLE `matriculadoscursos`
  ADD PRIMARY KEY (`matriculadocurso_id`);

--
-- Indices de la tabla `matriculadosdetalle`
--
ALTER TABLE `matriculadosdetalle`
  ADD PRIMARY KEY (`matriculadodetalle_id`);

--
-- Indices de la tabla `matriculadosestudios`
--
ALTER TABLE `matriculadosestudios`
  ADD PRIMARY KEY (`matriculadoestudio_id`);

--
-- Indices de la tabla `matriculadosexperiencias`
--
ALTER TABLE `matriculadosexperiencias`
  ADD PRIMARY KEY (`matriculadoexperiencia_id`);

--
-- Indices de la tabla `matriculadosidiomas`
--
ALTER TABLE `matriculadosidiomas`
  ADD PRIMARY KEY (`matriculadoidioma_id`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`matricula_id`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`novedad_id`);

--
-- Indices de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD PRIMARY KEY (`opinion_id`),
  ADD KEY `matriculado_id` (`matriculado_id`),
  ADD KEY `tipoopinion_id` (`opiniontipo_id`);

--
-- Indices de la tabla `opinionestipos`
--
ALTER TABLE `opinionestipos`
  ADD PRIMARY KEY (`opiniontipo_id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`pregunta_id`);

--
-- Indices de la tabla `protocolos`
--
ALTER TABLE `protocolos`
  ADD PRIMARY KEY (`protocolo_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`provincia_id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`respuesta_id`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`seguimiento_id`),
  ADD KEY `archivo_id` (`archivo_id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `solicitudturnoonline`
--
ALTER TABLE `solicitudturnoonline`
  ADD PRIMARY KEY (`solicitudturnoonline_id`),
  ADD KEY `gestion_id` (`gestion_id`),
  ADD KEY `areaturnoonline_id` (`areaturnoonline_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `turnoonline`
--
ALTER TABLE `turnoonline`
  ADD PRIMARY KEY (`turnoonline_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `archivo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areaturnoonline`
--
ALTER TABLE `areaturnoonline`
  MODIFY `areaturnoonline_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditor`
--
ALTER TABLE `auditor`
  MODIFY `auditor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  MODIFY `capacitacion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `cuenta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuestapreguntaresultado`
--
ALTER TABLE `encuestapreguntaresultado`
  MODIFY `encuestapreguntaresultado_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuestaresultado`
--
ALTER TABLE `encuestaresultado`
  MODIFY `encuestaresultado_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `encuesta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entidades`
--
ALTER TABLE `entidades`
  MODIFY `entidad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `estado_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `evento_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experiencianivel`
--
ALTER TABLE `experiencianivel`
  MODIFY `experiencianivel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `gestion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `grupo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `idioma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculados`
--
ALTER TABLE `matriculados`
  MODIFY `matriculado_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculadoscursos`
--
ALTER TABLE `matriculadoscursos`
  MODIFY `matriculadocurso_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculadosdetalle`
--
ALTER TABLE `matriculadosdetalle`
  MODIFY `matriculadodetalle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculadosestudios`
--
ALTER TABLE `matriculadosestudios`
  MODIFY `matriculadoestudio_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculadosexperiencias`
--
ALTER TABLE `matriculadosexperiencias`
  MODIFY `matriculadoexperiencia_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculadosidiomas`
--
ALTER TABLE `matriculadosidiomas`
  MODIFY `matriculadoidioma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `matricula_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `novedad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  MODIFY `opinion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opinionestipos`
--
ALTER TABLE `opinionestipos`
  MODIFY `opiniontipo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `pregunta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `protocolos`
--
ALTER TABLE `protocolos`
  MODIFY `protocolo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `provincia_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `respuesta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `seguimiento_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudturnoonline`
--
ALTER TABLE `solicitudturnoonline`
  MODIFY `solicitudturnoonline_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnoonline`
--
ALTER TABLE `turnoonline`
  MODIFY `turnoonline_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
