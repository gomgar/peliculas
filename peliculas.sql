
## SOCIO #######################################################################

CREATE TABLE IF NOT EXISTS `socio` (
  `Numero_socio` int(255) NOT NULL,
  `Nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Apellido1` varchar(100) COLLATE latin1_spanish_ci NOT NULL, 
  `Apellido2` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `DNI` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` int(9),
  `Email` varchar(100),
  `Cuenta` varchar(20) NOT NULL,
  `Contraseña` varchar(8) NOT NULL,
  PRIMARY KEY (`Numero_socio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

## PELICULAS #####################################################################

CREATE TABLE IF NOT EXISTS `peliculas` (
  `Codigo_identificador` varchar(255) NOT NULL,
  `Titulo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Anio` year(4) NOT NULL, 
  `Duracion` int(11) NOT NULL,
  `Genero` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Precio` int(11) NOT NULL,
  `Cartel` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Sinopsis` text NOT NULL,
  `Alquilada` enum('si','no') NOT NULL,
  `Fecha_devolucion` date,
  PRIMARY KEY (`Codigo_identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

## MENSAJE ########################################################################

CREATE TABLE IF NOT EXISTS `mensaje` (
  `Codigo` int(255) NOT NULL,
  `Texto` text NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

## COMENTARIOS #####################################################################

CREATE TABLE IF NOT EXISTS `comentarios` (
  `Codigo` int(255) NOT NULL,
  `Texto` text NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

## RELACION_PELICULA_COMENTARIO ####################################################

CREATE TABLE IF NOT EXISTS `relacion_pelicula_comentario` (
  `Codigo_identificador` varchar(255) NOT NULL,
  `Codigo` int(255) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`Fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

## RELACION_SOCIO_COMENTARIO ####################################################

CREATE TABLE IF NOT EXISTS `relacion_socio_comentario` (
  `Numero_socio` int(255) NOT NULL,
  `Codigo` int(255) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`Fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

## RELACION_SOCIO_MENSAJE ########################################################

CREATE TABLE IF NOT EXISTS `relacion_socio_mensaje` (
  `Numero_socio` int(255) NOT NULL,
  `Codigo` int(255) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`Fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

## RELACION_SOCIO_MENSAJE ########################################################

CREATE TABLE IF NOT EXISTS `relacion_socio_pelicula` (
  `Codigo_identificador` varchar(255) NOT NULL,
  `Numero_socio` int(255) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`Fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;


## -- FOREIGN KEYS ------------------------------------------------------------- ##
ALTER TABLE `relacion_pelicula_comentario`
  ADD CONSTRAINT `fk_id_peliculacomentario` FOREIGN KEY (`Codigo_identificador`) REFERENCES `peliculas`(`Codigo_identificador`),
  ADD CONSTRAINT `fk_id_comentariopelicula` FOREIGN KEY (`Codigo`) REFERENCES `comentarios`(`Codigo`);

ALTER TABLE `relacion_socio_comentario`
  ADD CONSTRAINT `fk_id_sociocomentario` FOREIGN KEY (`Numero_socio`) REFERENCES `socio`(`Numero_socio`),
  ADD CONSTRAINT `fk_id_comentariosocio` FOREIGN KEY (`Codigo`) REFERENCES `comentarios`(`Codigo`);

ALTER TABLE `relacion_socio_mensaje`
  ADD CONSTRAINT `fk_id_sociomensaje` FOREIGN KEY (`Numero_socio`) REFERENCES `socio`(`Numero_socio`),
  ADD CONSTRAINT `fk_id_mensajesocio` FOREIGN KEY (`Codigo`) REFERENCES `mensaje`(`Codigo`);

ALTER TABLE `relacion_socio_pelicula`
  ADD CONSTRAINT `fk_id_peliculasocio` FOREIGN KEY (`Codigo_identificador`) REFERENCES `peliculas`(`Codigo_identificador`),
  ADD CONSTRAINT `fk_id_sociopelicula` FOREIGN KEY (`Numero_socio`) REFERENCES `socio`(`Numero_socio`);