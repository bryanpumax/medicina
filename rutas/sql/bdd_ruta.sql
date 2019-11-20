-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2019 a las 22:17:39
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdd_ruta`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_ciudades` (IN `id` INT)  BEGIN
if not exists(Select * from tbl_rutas tr where tr.idx_ciudades=id)then
delete from tbl_ciudades  where tbl_ciudades.idx_ciudades=id;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_clientes` (IN `id` INT)  begin
		if not exists(SELECT * from   tbl_perdido,tbl_clientes tbl_o  where tbl_perdido.idx_clientes=tbl_o.idx_clientes 
    and tbl_o.idx_clientes=id)then
			delete from tbl_clientes WHERE tbl_clientes.idx_clientes=id;
		end if;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_inventario` (IN `id` INT)  BEGIN
 declare contar int;
 declare idx_tipo int;
 select tbl_inventario.idx_tipo into idx_tipo from tbl_inventario where tbl_inventario.idx_producto=id;
 if not exists(SELECT * from tbl_det_pedido ,tbl_inventario   where tbl_det_pedido.idx_producto=tbl_inventario.idx_producto 
    and tbl_inventario.idx_producto=id)then
 delete from tbl_inventario where idx_producto=id;
 
 select count(*) into contar from tbl_inventario where tbl_inventario.idx_tipo=idx_tipo;
  update tbl_tipo set tbl_tipo.contar_tipo=contar where tbl_tipo.idx_tipo=idx_tipo;
 end  if;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_muestra` (IN `n_muestra` LONGTEXT)  begin 

declare muestra longtext;
select view_visitas_detalle.n_muestra into muestra from view_visitas_detalle where view_visitas_detalle.idx_visitas_detalle=n_muestra;
delete from tbl_det_muestra where tbl_det_muestra.idx_det_muestra=muestra;

 
 delete from tbl_visitas where tbl_visitas.idx_visita= n_muestra;
 DELETE FROM tbl_visitas_detalle WHERE tbl_visitas_detalle.idx_visitas_detalle=n_muestra;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_operador` (IN `id` INT)  begin
		if not exists(select * FROM tbl_perdido where tbl_perdido.idx_operador=id)then
			delete from tbl_operador WHERE tbl_operador.idx_operador=id;
		end if;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_perdido` (IN `id` INT)  BEGIN
 
 if exists(SELECT * from tbl_det_pedido where idx_perdido=id)then
 delete from tbl_det_pedido where idx_perdido=id;
 delete from tbl_perdido where idx_perdido=id;
else
 delete from tbl_perdido where idx_perdido=id;
 end  if;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_rutas` (IN `id` INT)  BEGIN
declare contar int;
declare idx_ciudades int;
select tbl_rutas.idx_ciudades into idx_ciudades from tbl_rutas where tbl_rutas.idx_rutas=id;
if not exists(SELECT * from tbl_clientes tbl_p,tbl_rutas tbl_o  where tbl_p.idx_rutas=tbl_o.idx_rutas     and tbl_o.idx_rutas=id)then
delete from tbl_rutas where idx_rutas=id;

select count(*) into contar from tbl_rutas where tbl_rutas.idx_ciudades=idx_ciudades;
 update tbl_ciudades set cont_ciudades=contar where tbl_ciudades.idx_ciudades=idx_ciudades;
end  if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_tipo` (IN `id` INT)  BEGIN
if not exists(select * from tbl_inventario where idx_tipo=id )then
delete from tbl_tipo where idx_tipo =id;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_ciudades` (IN `nom_ciudades` VARCHAR(120))  BEGIN
 if not exists(select * from tbl_ciudades where tbl_ciudades.nom_ciudades=nom_ciudades  )then
 insert into tbl_ciudades values(null,nom_ciudades,0);
 end if;
 
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_clientes` (IN `cru_clientes` VARCHAR(10), IN `nom_clientes` VARCHAR(120), IN `ape_clientes` VARCHAR(120), IN `idx_ruta` INT, IN `dir_clientes` VARCHAR(120), IN `telf_clientes` VARCHAR(10), IN `cel_clientes` VARCHAR(10), IN `email_clientes` VARCHAR(120), IN `emp_clientes` VARCHAR(120), IN `idx_operador` INT)  BEGIN
if not exists(Select * from tbl_clientes where tbl_clientes.cru_clientes=cru_clientes)then 
insert into tbl_clientes value(null,cru_clientes,nom_clientes,ape_clientes,idx_ruta,dir_clientes,telf_clientes,cel_clientes,email_clientes,emp_clientes,idx_operador);
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_det_pedido` (IN `idx_perdido` INT, IN `idx_producto` INT, IN `cant` INT)  begin
declare valor float;
declare iva int;
declare par_iva decimal(7,2);
declare cant_precio float;
declare subtotal float;
declare totaliva_perdido float;
declare impuesto  float;
declare totalsiniva_perdido float;
declare totaliva_perdidofinal float;
select tbl_inventario.prec_producto into valor   from tbl_inventario where tbl_inventario.idx_producto=idx_producto;
select tbl_inventario.iva_producto into iva from tbl_inventario where tbl_inventario.idx_producto=idx_producto;
select tbl_parametros.iva_parametros into par_iva from tbl_parametros  WHERE  1;
select tbl_perdido.totaliva_perdido into totaliva_perdido from tbl_perdido where tbl_perdido.idx_perdido=idx_perdido;
 
select tbl_perdido.totalsiniva_perdido into totalsiniva_perdido from tbl_perdido where tbl_perdido.idx_perdido=idx_perdido;

set cant_precio=valor*cant;
set impuesto =cant_precio*par_iva;
set subtotal=0.0;
set totaliva_perdidofinal=totaliva_perdido+impuesto;
update tbl_perdido set tbl_perdido.totaliva_perdido=totaliva_perdidofinal;
if(iva=0)then
set par_iva=0.0;
set subtotal=(cant_precio*par_iva)+cant_precio;
 
else
set subtotal=(impuesto)+cant_precio;

end if;
insert into tbl_det_pedido values(null,idx_perdido,idx_producto,cant,subtotal);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_Especialidades` (IN `esp_especialidades` VARCHAR(120))  BEGIN
 if not exists(select * from tbl_especialidades where tbl_especialidades.esp_especialidades=esp_especialidades) then
 insert into tbl_especialidades values(null,esp_especialidades);
 end if;
 
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_invetario` (IN `nomp_producto` VARCHAR(120), IN `idx_tipo` INT, IN `prec_producto` DECIMAL(7,2), IN `img_producto` LONGTEXT, IN `iva_producto` INT, IN `promo_producto` INT, IN `caract_inventario` LONGTEXT)  BEGIN 
declare contar int;

 if not exists(select * from tbl_inventario where tbl_inventario.nomp_producto=nomp_producto and tbl_inventario.idx_tipo=idx_tipo)then
 insert into tbl_inventario value(null,nomp_producto,idx_tipo,prec_producto,img_producto,iva_producto,promo_producto,caract_inventario,0,'0000-00-00');
 select count(*) into contar from tbl_inventario where tbl_inventario.idx_tipo=idx_tipo;
 update tbl_tipo set contar_tipo=contar where tbl_tipo.idx_tipo=idx_tipo;
 end if;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_operador` (IN `ced_operador` VARCHAR(10), IN `nom_operador` VARCHAR(120), IN `ape_operador` VARCHAR(120), IN `tel_operador` VARCHAR(10), IN `dir_operador` VARCHAR(120), IN `email_operador` VARCHAR(120), IN `usu_operador` VARCHAR(120), IN `pass_operador` VARCHAR(120), IN `rol_operador` INT, IN `nrol_operador` VARCHAR(120), IN `img_operador` LONGTEXT)  begin

declare pass_operador2 varchar(120);
if not exists(select * from tbl_operador where tbl_operador.ced_operador=ced_operador  )then
set pass_operador2=md5(pass_operador);
insert into tbl_operador value(null,ced_operador  ,nom_operador  ,ape_operador  ,tel_operador ,dir_operador ,email_operador ,usu_operador ,pass_operador2,rol_operador,nrol_operador,img_operador);
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_ruta` (IN `nom_ruta` VARCHAR(120), IN `idx_ciudades` INT, IN `idx_operador` INT)  BEGIN 
declare contar int;
 if not exists(select * from tbl_rutas where tbl_rutas.nom_rutas=nom_ruta and tbl_rutas.idx_ciudades=idx_ciudades )then
 insert into tbl_rutas value(null,idx_ciudades,nom_ruta,idx_operador);
 select count(*) into contar from tbl_rutas where tbl_rutas.idx_ciudades=idx_ciudades;
 update tbl_ciudades set cont_ciudades=contar where tbl_ciudades.idx_ciudades=idx_ciudades;
 end if;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_tipo` (IN `desc_tipo` VARCHAR(120))  BEGIN
 if not exists(select *  from tbl_tipo where tbl_tipo.desc_tipo=desc_tipo) then
 insert into tbl_tipo value(null,desc_tipo,0);
 end if;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `nom_old` longtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `nom_new` longtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `dir_old` longtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `dir_new` longtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `tabla` longtext COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `excel`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `excel` (
`idx_visita` int(11)
,`nom_visita` varchar(120)
,`dir_visita` varchar(120)
,`esp_especialidades` varchar(120)
,`operador` varchar(241)
,`nomp_producto` varchar(120)
,`cant_det_muestra` int(11)
,`idx_muestra` int(11)
,`fech_visita` date
,`cont_muestra` int(11)
,`localizacion` varchar(243)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citas`
--

CREATE TABLE `tbl_citas` (
  `id_citas` int(11) NOT NULL COMMENT 'identificador DE  LA  TABLA',
  `fecha_citas` date DEFAULT NULL COMMENT 'FECHA',
  `hora_citas` time DEFAULT NULL COMMENT 'HORA',
  `idx_clientes` int(11) DEFAULT NULL COMMENT 'RELACION TABLA DEL CLIENTE',
  `idx_operador` int(11) DEFAULT NULL COMMENT 'RELACION TABLA DEL OPERADOR',
  `estado_citas` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'ESTADO DE LA ACCION',
  `obseravacion_citas` longtext COLLATE utf8_spanish_ci COMMENT 'OPINION DE CLIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_citas`
--

INSERT INTO `tbl_citas` (`id_citas`, `fecha_citas`, `hora_citas`, `idx_clientes`, `idx_operador`, `estado_citas`, `obseravacion_citas`) VALUES
(1, '2019-05-26', '22:11:00', 1, 4, 'activo', ''),
(2, '2019-05-26', '23:33:00', 5, 4, 'activo', ''),
(3, '2019-05-27', '15:06:00', 6, 5, 'activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ciudades`
--

CREATE TABLE `tbl_ciudades` (
  `idx_ciudades` int(11) NOT NULL,
  `nom_ciudades` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cont_ciudades` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ciudades`
--

INSERT INTO `tbl_ciudades` (`idx_ciudades`, `nom_ciudades`, `cont_ciudades`) VALUES
(1, 'LOS RÃ­OS', 0),
(2, 'BAÃ±OS', 0),
(3, 'SANTO DOMINGO', 2),
(4, 'ESMERALDAS', 0),
(5, 'MANABI', 0),
(6, 'SANTA ELENA', 0),
(7, 'GUAYAS', 0),
(9, 'EL ORO', 0),
(10, 'AZUAY', 0),
(11, 'BOLIVAR', 0),
(12, 'CAÃ±AR', 0),
(13, 'CARCHI', 0),
(14, 'COTOPAXI', 0),
(15, 'CHIMBORAZO', 0),
(16, 'IMBABURA', 0),
(17, 'LOJA', 0),
(18, 'PINCHINCHA', 0),
(19, 'TUNGURAHUA', 0),
(20, 'MORONA SANTIAGO', 0),
(21, 'NAPO', 0),
(22, 'ORELLANA', 0),
(23, 'PASTAZA', 0),
(24, 'SUCUMBIOS', 0),
(25, 'ZAMORA', 0),
(26, 'ALFA DE MEDITERRANEO', 0),
(32, 'AAAAAAA', 0),
(33, 'AAAAAAAA', 0),
(34, 'AAAAAAAAA', 0),
(35, 'AAAAAAAAAA', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `idx_clientes` int(11) NOT NULL,
  `cru_clientes` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nom_clientes` varchar(120) CHARACTER SET latin1 NOT NULL,
  `ape_clientes` varchar(120) CHARACTER SET latin1 NOT NULL,
  `idx_rutas` int(11) NOT NULL,
  `dir_clientes` varchar(120) CHARACTER SET latin1 NOT NULL,
  `telf_clientes` varchar(10) CHARACTER SET latin1 NOT NULL,
  `cel_clientes` varchar(10) CHARACTER SET latin1 NOT NULL,
  `email_clientes` varchar(120) CHARACTER SET latin1 NOT NULL,
  `emp_clientes` varchar(120) CHARACTER SET latin1 NOT NULL,
  `idx_operador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`idx_clientes`, `cru_clientes`, `nom_clientes`, `ape_clientes`, `idx_rutas`, `dir_clientes`, `telf_clientes`, `cel_clientes`, `email_clientes`, `emp_clientes`, `idx_operador`) VALUES
(5, '1717565665', 'BRYAN', 'CORNEJO', 21, 'TSACHILA Y  GUAYAQUIL', '0959113935', '', 'riqbran@hotmail.com', 'PC-SANTO DOMINGO', 4),
(6, '1720836400', 'LOLI', 'K', 22, 'EW', '32', '', 'd@m.cpm', 'D', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_det_muestra`
--

CREATE TABLE `tbl_det_muestra` (
  `idx_det_muestra` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `idx_vista` int(11) NOT NULL,
  `idx_muestra` int(11) NOT NULL,
  `cant_det_muestra` int(11) NOT NULL,
  `fecha_det_muestra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_det_muestra`
--

INSERT INTO `tbl_det_muestra` (`idx_det_muestra`, `idx_vista`, `idx_muestra`, `cant_det_muestra`, `fecha_det_muestra`) VALUES
('PAR00145', 41, 46, 3, '2019-05-26'),
('PAR00149', 42, 44, 32, '2019-05-26'),
('PAR00150', 43, 44, 4, '2019-05-26'),
('PAR00150', 44, 43, 3, '2019-05-26'),
('PAR00151', 45, 45, 32, '2019-05-26'),
('PAR00152', 46, 43, 32, '2019-05-26'),
('PAR00153', 47, 44, 32, '2019-05-26'),
('PAR00155', 48, 43, 32, '2019-05-27'),
('PAR00156', 49, 44, 14, '2019-05-27'),
('PAR00157', 50, 46, 41, '2019-05-27'),
('PAR00158', 51, 43, 324, '2019-05-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_det_pedido`
--

CREATE TABLE `tbl_det_pedido` (
  `idx_det_pedido` int(11) NOT NULL,
  `idx_perdido` varchar(11) CHARACTER SET latin1 NOT NULL,
  `idx_producto` int(11) NOT NULL,
  `cant_det_pedido` int(11) NOT NULL,
  `pre_det_pedido` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pro_det_pedido` int(11) NOT NULL DEFAULT '0',
  `iva_det_pedido` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subt_det_pedido` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_det_pedido`
--

INSERT INTO `tbl_det_pedido` (`idx_det_pedido`, `idx_perdido`, `idx_producto`, `cant_det_pedido`, `pre_det_pedido`, `pro_det_pedido`, `iva_det_pedido`, `subt_det_pedido`) VALUES
(1, 'COT00039', 30, 32, '22.56', 0, '0.00', '721.92'),
(2, 'COT00040', 1, 5, '16.38', 1, '0.00', '98.28');

--
-- Disparadores `tbl_det_pedido`
--
DELIMITER $$
CREATE TRIGGER `tbl_det_pedido_AFTER_INSERT` AFTER INSERT ON `tbl_det_pedido` FOR EACH ROW BEGIN
declare contar int;
select count(*) into contar from tbl_det_pedido where tbl_det_pedido.idx_producto=new.idx_producto;
update tbl_inventario set  tbl_inventario.contar_inventario=contar 
where tbl_inventario.idx_producto=new.idx_producto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tbl_det_pedido_BEFORE_INSERT` BEFORE INSERT ON `tbl_det_pedido` FOR EACH ROW BEGIN
declare contar int;
select count(*) into contar from tbl_det_pedido where tbl_det_pedido.idx_producto=new.idx_producto;
update tbl_inventario set  tbl_inventario.contar_inventario=contar 
where tbl_inventario.idx_producto=new.idx_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_diario`
--

CREATE TABLE `tbl_diario` (
  `Nro_informe` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fec_informe` date NOT NULL,
  `rut_informe` varchar(235) COLLATE utf8mb4_spanish_ci NOT NULL,
  `est_informe` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'Generado',
  `idx_operador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_diario`
--

INSERT INTO `tbl_diario` (`Nro_informe`, `fec_informe`, `rut_informe`, `est_informe`, `idx_operador`) VALUES
('JUAINF20', '2019-05-27', 'JUAInforme_2019-05-27.xlsx', 'Actualizado', 5),
('JUAINFMEN22', '2019-05-27', 'JUAInforme_mensual_2019-05-27.xlsx', 'Generado Mensua', 5),
('USUINF19', '2019-05-01', 'USUInforme_2019-05-27.xlsx', 'Actualizado', 4),
('USUINFMEN21', '2019-05-27', 'USUInforme_mensual_2019-05-27.xlsx', 'Generado Mensua', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_especialidades`
--

CREATE TABLE `tbl_especialidades` (
  `idx_especialidades` int(11) NOT NULL,
  `esp_especialidades` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_especialidades`
--

INSERT INTO `tbl_especialidades` (`idx_especialidades`, `esp_especialidades`) VALUES
(1, 'GINECOLOGIA'),
(2, 'MEDICINA INTERNA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `idx_producto` int(11) NOT NULL,
  `nomp_producto` varchar(120) NOT NULL,
  `idx_tipo` int(11) NOT NULL,
  `prec_producto` decimal(7,2) NOT NULL,
  `img_producto` longtext NOT NULL,
  `iva_producto` int(11) NOT NULL,
  `promo_producto` int(11) NOT NULL,
  `caract_inventario` longtext,
  `contar_inventario` int(11) NOT NULL,
  `fecha_parrilla` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`idx_producto`, `nomp_producto`, `idx_tipo`, `prec_producto`, `img_producto`, `iva_producto`, `promo_producto`, `caract_inventario`, `contar_inventario`, `fecha_parrilla`) VALUES
(1, 'ATENNOR', 1, '16.38', 'foto.jpg', 0, 1, 'Caja x 14 Tabletas', 1, '0000-00-00'),
(2, 'ANTIFUX', 2, '27.58', 'foto.jpg', 0, 0, 'Caja x 14 C&aacute;psulas', 1, '0000-00-00'),
(3, 'CENTELAR GEL', 3, '15.00', 'foto.jpg', 0, 0, 'Tubo 50 g', 1, '0000-00-00'),
(4, 'CIFLOBAC TABL 500 MG', 6, '7.92', 'foto.jpg', 0, 0, 'Tabletas Caja x 10', 1, '0000-00-00'),
(5, 'COLPOSTAT OVULOS', 7, '21.00', 'foto.jpg', 0, 0, 'Ovulos Caja x 7', 1, '0000-00-00'),
(6, 'COLPOSTAT CREMA', 7, '16.50', 'foto.jpg', 0, 0, 'Crema 30 g Caja x 1', 1, '0000-00-00'),
(7, 'CRESULIV OVULOS', 8, '15.78', 'foto.jpg', 0, 0, 'Ovulos Caja x 6 ', 0, '0000-00-00'),
(8, 'DILUPHEN SOBRES', 9, '10.08', 'foto.jpg', 0, 0, 'Sobres Caja x 20 ', 0, '0000-00-00'),
(9, 'DISFEBRAL SIMPLE', 10, '2.70', 'foto.jpg', 0, 0, 'Suspensi&oacute;n 120 ml ', 0, '0000-00-00'),
(10, 'DISFEBRAL FAST 400', 10, '6.40', 'foto.jpg', 0, 0, 'Caja x 16 C&aacute;psulas Blandas', 0, '0000-00-00'),
(11, 'DISFEBRAL FORTE', 10, '4.11', 'foto.jpg', 0, 0, 'Suspensi&oacute;n 120 ml', 0, '0000-00-00'),
(12, 'DISFEBRAL GOTAS', 10, '1.94', 'foto.jpg', 0, 0, 'Gotas Suspensi&oacute;n 30 ml', 0, '0000-00-00'),
(13, 'DISFEBRAL 400', 10, '4.20', 'foto.jpg', 0, 0, 'Comprimidos Caja x 20 ', 0, '0000-00-00'),
(14, 'DISFEBRAL 600', 10, '6.00', 'foto.jpg', 0, 0, 'Tabletas Caja x 20', 0, '0000-00-00'),
(15, 'ELODERM CREMA', 11, '5.75', 'foto.jpg', 0, 0, 'Tubo 30 g', 0, '0000-00-00'),
(16, 'EPEROX IBL TABLETAS', 12, '26.00', 'foto.jpg', 0, 0, 'Tabletas Dispersables Caja x 14', 0, '0000-00-00'),
(17, 'EPEROX IBL SUSPENSION', 12, '11.50', 'foto.jpg', 0, 0, 'Suspension 100 ml', 0, '0000-00-00'),
(18, 'IVUMOD CAPSULAS', 13, '5.83', 'foto.jpg', 0, 0, 'C&aacute;psulas Caja x 20', 0, '0000-00-00'),
(19, 'LIDEMIN SOBRES', 14, '18.00', 'foto.jpg', 0, 0, 'Sobres Caja x 30 ', 0, '0000-00-00'),
(20, 'MIOLOX 75MG ', 15, '3.55', 'foto.jpg', 0, 0, 'Tabletas Caja x 10', 1, '0000-00-00'),
(21, 'MIOLOX 15', 15, '6.08', 'foto.jpg', 0, 0, 'Tabletas Caja x 10', 0, '0000-00-00'),
(22, 'MIOLOX GRANULADO', 15, '24.92', 'foto.jpg', 0, 0, 'Sobres Caja x 30', 0, '0000-00-00'),
(23, 'NITELMIN 200 ', 16, '5.30', 'foto.jpg', 0, 0, 'Tabletas Dispersable Caja x 6', 0, '0000-00-00'),
(24, 'NITELMIN 500', 16, '8.40', 'foto.jpg', 0, 0, 'tableta caja x6', 0, '0000-00-00'),
(25, 'NITELMIN SUSPENSION 60', 16, '6.57', 'foto.jpg', 0, 0, 'Suspensi&oacute;n 30 ml', 0, '0000-00-00'),
(26, 'NITELMIN SUSPENSION 30', 16, '3.29', 'foto.jpg', 0, 0, 'Suspension 30 ml', 0, '0000-00-00'),
(27, 'SULTAPRIN', 17, '13.40', 'foto.jpg', 0, 0, 'Tabletas Dispersables Caja x 10', 0, '0000-00-00'),
(28, 'UOSOMOX 250 mg 5ml PPS', 12, '3.73', 'foto.jpg', 0, 0, 'Polvo para suspension 100 ml', 0, '0000-00-00'),
(29, 'UOSOMOX CAPSULAS ', 12, '4.60', 'foto.jpg', 0, 0, 'Capsulas Caja x 20', 0, '0000-00-00'),
(30, 'XIMAX TABLETAS 500', 21, '22.56', 'foto.jpg', 0, 0, 'Tabletas dispersables caja x 10 ', 1, '0000-00-00'),
(31, 'XIMAX SUSPENSION 250', 21, '18.00', 'foto.jpg', 0, 0, 'Suspensi&oacute;n 70 mL 250 mg5 mL', 0, '0000-00-00');

--
-- Disparadores `tbl_inventario`
--
DELIMITER $$
CREATE TRIGGER `tbl_inventario_AFTER_UPDATE` AFTER UPDATE ON `tbl_inventario` FOR EACH ROW BEGIN
declare contar int;
declare oldcontar int;
select count(*) into oldcontar from tbl_inventario where tbl_inventario.idx_tipo=old.idx_tipo;
 update tbl_tipo set tbl_tipo.contar_tipo=oldcontar where tbl_tipo.idx_tipo=old.idx_tipo;
 select count(*) into contar from tbl_inventario where tbl_inventario.idx_tipo=new.idx_tipo;
 update tbl_tipo set tbl_tipo.contar_tipo=contar where tbl_tipo.idx_tipo=new.idx_tipo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_medico`
--

CREATE TABLE `tbl_medico` (
  `idxm` int(11) NOT NULL,
  `ced_medico` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nom_medi` varchar(120) COLLATE utf8mb4_spanish_ci NOT NULL,
  `dir_medico` longtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `ruta` int(11) NOT NULL,
  `especialidad` int(11) NOT NULL,
  `idx_operador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_medico`
--

INSERT INTO `tbl_medico` (`idxm`, `ced_medico`, `nom_medi`, `dir_medico`, `ruta`, `especialidad`, `idx_operador`) VALUES
(1, 'CLI00089', 'LUIS', 'EWQ', 21, 1, 4),
(2, 'CLI00090', 'JORGE', 'EWQE', 22, 1, 5),
(3, 'CLI00091', 'MILK', 'DS', 21, 1, 4),
(4, 'CLI00092', 'FELIX', '32', 22, 1, 5),
(5, 'CLI00093', 'FLORES ROSA', 'EW1', 22, 1, 5),
(6, 'CLI00094', 'LUNA', 'DEMO', 21, 1, 4);

--
-- Disparadores `tbl_medico`
--
DELIMITER $$
CREATE TRIGGER `t_actualizar_med` BEFORE UPDATE ON `tbl_medico` FOR EACH ROW INSERT into auditoria VALUES(0,old.nom_medi,new.nom_medi,old.dir_medico,new.dir_medico,'tbl_medico')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `idx_menu` int(11) NOT NULL,
  `etiq_menu` varchar(120) NOT NULL,
  `ruta_menu` varchar(120) NOT NULL,
  `icono_menu` varchar(120) NOT NULL,
  `rol_menu` int(11) NOT NULL,
  `orden_menu` int(11) DEFAULT NULL,
  `jerarquia` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_menu`
--

INSERT INTO `tbl_menu` (`idx_menu`, `etiq_menu`, `ruta_menu`, `icono_menu`, `rol_menu`, `orden_menu`, `jerarquia`) VALUES
(1, 'clientes', 'cliente', 'fa-border fas fa-users', 1, 5, 'a'),
(2, 'ciudades', 'ciudad', 'fas fa-city fa-border', 3, 2, 'a'),
(3, 'ruta', 'ruta', 'fas fa-street-view fa-border', 1, 3, 'a'),
(4, 'inventario', 'invetario', 'fas fa-warehouse fa-border', 1, 6, 'a'),
(5, 'pedido', 'pedido', 'far fa-clipboard fa-border', 1, 7, 'm'),
(6, 'operador', 'operador', 'fas fa-user-tie fa-border', 3, 4, 'a'),
(7, 'categoria producto', 'categoria', 'fab fa-typo3 fa-border', 3, 1, 'a'),
(8, 'reportes/estadistica', 'reporte', 'fas fa-chart-pie fa-border', 1, 8, 'r'),
(9, 'Citas', 'citas', 'fas fa-book-open fa-border', 1, 6, 'm'),
(10, 'Visitas', 'visita', 'fas fa-street-view fa-border', 1, 12, 'm'),
(11, 'Especialidad', 'especial', 'fas fa-user-md fa-border', 3, 12, 'a'),
(12, 'Reporte Diario/Mensual', 'diario', 'fas fa-book fa-fw fa-border', 1, 2, 'r'),
(13, 'Medicos', 'medico', 'fas fa-user-md fa-border', 1, 5, 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_muestra`
--

CREATE TABLE `tbl_muestra` (
  `idx_muestra` int(11) NOT NULL,
  `idx_producto` int(11) NOT NULL,
  `fecha_muestra` date NOT NULL,
  `cont_muestra` int(11) NOT NULL,
  `idx_operador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_muestra`
--

INSERT INTO `tbl_muestra` (`idx_muestra`, `idx_producto`, `fecha_muestra`, `cont_muestra`, `idx_operador`) VALUES
(2, 2, '2019-05-27', 16, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_operador`
--

CREATE TABLE `tbl_operador` (
  `idx_operador` int(11) NOT NULL,
  `ced_operador` varchar(10) CHARACTER SET latin1 NOT NULL COMMENT 'cedula',
  `nom_operador` varchar(120) CHARACTER SET latin1 NOT NULL COMMENT 'nombre',
  `ape_operador` varchar(120) CHARACTER SET latin1 NOT NULL COMMENT 'apellido',
  `tel_operador` varchar(10) CHARACTER SET latin1 NOT NULL COMMENT 'telefono',
  `dir_operador` varchar(120) CHARACTER SET latin1 NOT NULL COMMENT 'direccion',
  `email_operador` varchar(120) CHARACTER SET latin1 NOT NULL,
  `usu_operador` varchar(120) CHARACTER SET latin1 NOT NULL COMMENT 'usuario',
  `pass_operador` varchar(120) CHARACTER SET latin1 NOT NULL COMMENT 'contraseÃ±a',
  `rol_operador` int(11) NOT NULL COMMENT 'nivel de acceso',
  `nrol_operador` varchar(120) CHARACTER SET latin1 NOT NULL,
  `img_operador` longtext CHARACTER SET latin1 NOT NULL COMMENT 'imagen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_operador`
--

INSERT INTO `tbl_operador` (`idx_operador`, `ced_operador`, `nom_operador`, `ape_operador`, `tel_operador`, `dir_operador`, `email_operador`, `usu_operador`, `pass_operador`, `rol_operador`, `nrol_operador`, `img_operador`) VALUES
(1, '0000000000', 'ADMIN', 'ADMIN', '0000000000', '000000000', 'admin@svm.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 7, 'Administrador', 'cedula.jpg'),
(4, '2222222222', 'USUARIO', 'USUARIOAP', '9889879797', 'IYI87', 'usuario@svm.com', 'us-2222222222', '69393a8bbc80dec9f380bc7014ce71cc', 1, 'Vendedor', 'foto.jpg'),
(5, '9999999999', 'JUAN', 'LOPEX', '9999999990', 'PINPAN RIGHT', 'e@mail.com', 'us-9999999999', '254c5a76d669478d2b93ce9ec10d5f11', 1, 'Vendedor', 'foto.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_parametros`
--

CREATE TABLE `tbl_parametros` (
  `idx` int(11) NOT NULL,
  `tittle_parametros` varchar(120) CHARACTER SET latin1 NOT NULL,
  `iva_parametros` decimal(7,2) DEFAULT NULL,
  `nro_cotizacion` int(11) NOT NULL DEFAULT '0',
  `cont_f_cotiza` int(11) NOT NULL DEFAULT '0',
  `n_muestra` int(11) NOT NULL,
  `cont_muestra` int(11) NOT NULL,
  `con_cliente` int(11) NOT NULL DEFAULT '0',
  `n_informe` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_parametros`
--

INSERT INTO `tbl_parametros` (`idx`, `tittle_parametros`, `iva_parametros`, `nro_cotizacion`, `cont_f_cotiza`, `n_muestra`, `cont_muestra`, `con_cliente`, `n_informe`) VALUES
(1, 'S.V.MEDICAL', '0.12', 92, 40, 158, 16, 95, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perdido`
--

CREATE TABLE `tbl_perdido` (
  `idx_perdido` varchar(11) NOT NULL,
  `fech_perdido` date NOT NULL,
  `hora_perdido` time NOT NULL,
  `idx_clientes` int(11) NOT NULL,
  `idx_operador` int(10) NOT NULL,
  `totaliva_perdido` decimal(7,2) NOT NULL,
  `totalsiniva_perdido` decimal(7,2) NOT NULL,
  `totalbono` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_perdido` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_perdido`
--

INSERT INTO `tbl_perdido` (`idx_perdido`, `fech_perdido`, `hora_perdido`, `idx_clientes`, `idx_operador`, `totaliva_perdido`, `totalsiniva_perdido`, `totalbono`, `total_perdido`) VALUES
('COT00039', '2019-05-27', '00:28:00', 5, 4, '0.00', '0.00', '0.00', '721.92'),
('COT00040', '2019-05-27', '00:41:00', 6, 5, '0.00', '0.00', '16.38', '81.90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rutas`
--

CREATE TABLE `tbl_rutas` (
  `idx_rutas` int(11) NOT NULL,
  `idx_ciudades` int(11) NOT NULL,
  `nom_rutas` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `idx_operador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_rutas`
--

INSERT INTO `tbl_rutas` (`idx_rutas`, `idx_ciudades`, `nom_rutas`, `idx_operador`) VALUES
(21, 3, 'BOMBOLI', 4),
(22, 3, 'CALIFORNIA', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sql`
--

CREATE TABLE `tbl_sql` (
  `idx_sql` int(11) NOT NULL,
  `sql_sql` longtext NOT NULL,
  `tipo_sql` varchar(120) NOT NULL,
  `tabla_sql` varchar(120) NOT NULL,
  `accion_sql` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_sql`
--

INSERT INTO `tbl_sql` (`idx_sql`, `sql_sql`, `tipo_sql`, `tabla_sql`, `accion_sql`) VALUES
(1, 'delimiter $$\ncreate procedure p_i_operador(ced_operador varchar(10),nom_operador varchar(120),ape_operador varchar(120),tel_operador varchar(10),dir_operador varchar(120),email_operador varchar(120),usu_operador varchar(120),pass_operador varchar(120),rol_operador int,nrol_operador varchar(120),img_operador longtext)\nbegin\ndeclare pass_operador2 varchar(120);\nif not exists(select * from tbl_operador where tbl_operador.ced_operador=ced_operador  )then\nset pass_operador2=md5(pass_operador);\ninsert into tbl_operador value(ced_operador  ,nom_operador  ,ape_operador  ,tel_operador ,dir_operador ,email_operador ,usu_operador ,pass_operador2,rol_operador,nrol_operador,img_operador);\nend if;\nend;\n\n$$ delimiter ;', 'procedimiento almecenado', 'operador', 'insertar'),
(2, 'delimiter $$\ncreate procedure p_e_operador(id int)\n	begin\n		if not exists(select * FROM tbl_perdido where tbl_perdido.idx_operador=id)then\n			delete from tbl_operador WHERE tbl_operador.idx_operador=id;\n		end if;\n	end;\n$$ delimiter ;', 'procedimiento almacenado', 'operador', 'eliminar'),
(3, '\nDELIMITER $$\nUSE `bdd_ruta`$$\nCREATE PROCEDURE `p_i_ciudades` (nom_ciudades varchar(120))\nBEGIN\nif not exists(select * from tbl_ciudades where tbl_ciudades.nom_ciudades=nom_ciudades  )then\ninsert into tbl_ciudades values(null,nom_ciudades);\nend if;\n\nEND$$\n\nDELIMITER ;\n\n', 'pa', 'ciudades', 'insertar'),
(4, 'CREATE PROCEDURE `p_i_clientes`(cru_clientes varchar(10),nom_clientes varchar(120),\nape_clientes varchar(120),idx_ruta int,dir_clientes varchar(120),telf_clientes varchar(10),cel_clientes varchar(10),email_clientes varchar(120),emp_clientes varchar(120))\nBEGIN\nif not exists(Select * from tbl_clientes where tbl_clientes.cru_clientes=cru_clientes)then \ninsert into tbl_clientes value(null,cru_clientes,nom_clientes,ape_clientes,idx_ruta,dir_clientes,telf_clientes,cel_clientes,email_clientes,emp_clientes);\nend if;\nEND', 'pa', 'clientes', 'insertar'),
(5, 'CREATE PROCEDURE `p_e_ciudades`(id int)\nBEGIN\nif not exists(Select * from tbl_rutas tr where tr.idx_ciudades=id)then\ndelete from tbl_ciudades  where tbl_ciudades.idx_ciudades=id;\nend if;\nEND', 'pa', 'ciudades', 'eliminar'),
(6, ' \nCREATE  PROCEDURE `p_i_ruta`(nom_ruta varchar(120),idx_ciudades int)\nBEGIN \ndeclare contar int;\n if not exists(select * from tbl_rutas where tbl_rutas.nom_rutas=nom_ruta and tbl_rutas.idx_ciudades=idx_ciudades )then\n insert into tbl_rutas value(null,idx_ciudades,nom_ruta);\n select count(*) into contar from tbl_rutas where tbl_rutas.idx_ciudades=idx_ciudades;\n update tbl_ciudades set cont_ciudades=contar where tbl_ciudades.idx_ciudades=idx_ciudades;\n end if;\n END;\n ', 'pa', 'ruta', 'insertar'),
(7, ' CREATE PROCEDURE `p_i_tipo`(desc_tipo varchar(120))\n BEGIN\n if not exists(select *  from tbl_tipo where tbl_tipo.desc_tipo=desc_tipo) then\n insert into tbl_tipo value(null,desc_tipo,0);\n end if;\n END;\n ', 'pa', 'tipo', 'insertar'),
(8, ' \nCREATE PROCEDURE `p_e_tipo`(id int)\nBEGIN\nif not exists(select * from tbl_inventario where idx_tipo=id )then\ndelete from tbl_tipo where idx_tipo =id;\nend if;\nEND;\n ', 'pa', 'tipo ', 'eliminar'),
(9, ' \n  CREATE PROCEDURE `p_e_rutas`(id  int)\nBEGIN\ndeclare contar int;\ndeclare idx_ciudades int;\nselect tbl_rutas.idx_ciudades into idx_ciudades from tbl_rutas where tbl_rutas.idx_rutas=id;\nif not  exists(SELECT * from tbl_clientes tbl_p,tbl_rutas tbl_o  where tbl_p.idx_rutas=tbl_o.idx_rutas     and tbl_o.idx_rutas=id)then\ndelete from tbl_rutas where idx_rutas=id;\n\nselect count(*) into contar from tbl_rutas where tbl_rutas.idx_ciudades=idx_ciudades;\n update tbl_ciudades set cont_ciudades=contar where tbl_ciudades.idx_ciudades=idx_ciudades;\nend  if;\nEND;\n ', 'pa', 'ruta', 'eliminar'),
(10, 'create procedure p_e_clientes(id int)\n	begin\n		if not exists(SELECT * from   tbl_perdido,tbl_clientes tbl_o  where tbl_perdido.idx_clientes=tbl_o.idx_clientes \n    and tbl_o.idx_clientes=id)then\n			delete from tbl_clientes WHERE tbl_clientes.idx_clientes=id;\n		end if;\n	end;', 'pa', 'cliente', 'eliminar'),
(11, 'CREATE  PROCEDURE `p_i_invetario`(nomp_producto varchar(120),idx_tipo int,prec_producto decimal(7.2),img_producto longtext,iva_producto int,promo_producto int,caract_inventario longtext)\nBEGIN \ndeclare contar int;\n if not exists(select * from tbl_inventario where tbl_inventario.nomp_producto=nomp_producto and tbl_inventario.idx_tipo=idx_tipo)then\n insert into tbl_inventario value(null,nomp_producto,idx_tipo,prec_producto,img_producto,iva_producto,promo_producto,caract_inventario);\n select count(*) into contar from tbl_rutas where tbl_inventario.idx_tipo=idx_tipo;\n update idx_tipo set contar_tipo=contar where idx_tipo.idx_tipo=idx_tipo;\n end if;\n END;', 'pa', 'invetario ', 'insertar'),
(12, '   CREATE PROCEDURE `p_e_inventario`(id  int)\n BEGIN\n declare contar int;\n declare idx_tipo int;\n select tbl_inventario.idx_tipo into idx_tipo from tbl_inventario where tbl_inventario.idx_producto=id;\n if not  exists(SELECT * from tbl_det_pedido ,tbl_inventario   where tbl_det_pedido.idx_producto=tbl_inventario.idx_producto \n    and tbl_inventario.idx_producto=id)then\n delete from tbl_inventario where idx_producto=id;\n \n select count(*) into contar from tbl_rutas where tbl_rutas.idx_ciudades=idx_ciudades;\n  update tbl_ciudades set cont_ciudades=contar where tbl_ciudades.idx_tipo=idx_tipo;\n end  if;\n END;', 'pa', 'inventario', 'eliminar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo`
--

CREATE TABLE `tbl_tipo` (
  `idx_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(120) NOT NULL,
  `contar_tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo`
--

INSERT INTO `tbl_tipo` (`idx_tipo`, `desc_tipo`, `contar_tipo`) VALUES
(1, 'VALSARTAN', 1),
(2, 'ITRACONAZOL', 1),
(3, 'CENTELLA ASIATICA', 1),
(6, 'CIPROFLOXACINA ', 1),
(7, 'CLINDAMICINA', 2),
(8, 'POLICRESULENO', 1),
(9, 'PARACETAMOL', 1),
(10, 'IBUPROFENO', 6),
(11, 'BETAMETASONA, CLOTRIMAZOL, GENTAMICINA', 1),
(12, 'AMOXICILINA', 4),
(13, 'NITROFURANTOINA', 1),
(14, 'NIMESULIDA', 1),
(15, 'MELOXICAM', 3),
(16, 'NITAZOXANIDA', 4),
(17, 'SULTAMICILINA', 1),
(21, 'CEFUROXIMA', 2),
(22, 'A1', 0),
(23, 'A2', 0),
(24, 'A3', 0),
(25, 'A4', 0),
(26, 'A5', 0),
(27, 'A6', 0),
(28, 'A7', 0),
(29, 'A8', 0),
(30, 'A9', 0),
(34, 'A10', 0),
(35, 'A32', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_visitas`
--

CREATE TABLE `tbl_visitas` (
  `idx_visita` int(11) NOT NULL,
  `fech_visita` date NOT NULL,
  `cedu_visita` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nom_visita` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `dir_visita` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `idx_especialidades` int(11) NOT NULL,
  `idx_rutas` int(11) NOT NULL,
  `idx_operador` int(11) NOT NULL,
  `hora_visitas` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_visitas`
--

INSERT INTO `tbl_visitas` (`idx_visita`, `fech_visita`, `cedu_visita`, `nom_visita`, `dir_visita`, `idx_especialidades`, `idx_rutas`, `idx_operador`, `hora_visitas`) VALUES
(46, '2019-05-26', 'CLI00089', 'LUIS', 'EWQ', 1, 21, 4, '23:16:00'),
(47, '2019-05-26', 'CLI00090', 'JORGE', 'EWQE', 1, 22, 5, '23:31:00'),
(48, '2019-05-27', 'CLI00091', 'MILK', 'DS', 1, 21, 4, '00:01:00'),
(49, '2019-05-27', 'CLI00092', 'FELIX', '32', 1, 22, 5, '00:02:00'),
(50, '2019-05-27', 'CLI00093', 'FLORES ROSA', 'EW1', 1, 22, 5, '00:10:00'),
(51, '2019-05-27', 'CLI00094', 'LUNA', 'DEMO', 1, 21, 4, '00:11:00');

--
-- Disparadores `tbl_visitas`
--
DELIMITER $$
CREATE TRIGGER `t_i_medico1` BEFORE INSERT ON `tbl_visitas` FOR EACH ROW BEGIN
DECLARE ruta, especie int ;
DECLARE cliente  char;
SELECT tbl_rutas.idx_rutas into ruta from tbl_rutas where tbl_rutas.idx_rutas=new.idx_rutas;
SELECT tbl_medico.ced_medico into cliente from tbl_medico where tbl_medico.nom_medi=new.nom_visita;
SELECT tbl_especialidades.idx_especialidades into especie from tbl_especialidades where tbl_especialidades.idx_especialidades=new.idx_especialidades;
    IF( isnull(cliente) )THEN BEGIN
       INSERT INTO tbl_medico(idxm,ced_medico,nom_medi,dir_medico,ruta,especialidad,idx_operador)values(0,new.cedu_visita,new.nom_visita,new.dir_visita,ruta,especie,new.idx_operador);
  END; END IF;

End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_visitas_detalle`
--

CREATE TABLE `tbl_visitas_detalle` (
  `idx_visitas_detalle` int(11) NOT NULL,
  `idx_visitas` int(11) NOT NULL,
  `n_muestra` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `total_cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_visitas_detalle`
--

INSERT INTO `tbl_visitas_detalle` (`idx_visitas_detalle`, `idx_visitas`, `n_muestra`, `total_cant`) VALUES
(1, 46, 'PAR00152', 32),
(2, 47, 'PAR00153', 32),
(3, 48, 'PAR00155', 32),
(4, 49, 'PAR00156', 14),
(5, 50, 'PAR00157', 41),
(6, 51, 'PAR00158', 324);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_coti_detalle`
--

CREATE TABLE `tmp_coti_detalle` (
  `id` int(11) NOT NULL,
  `idcoti` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `promocion` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(9,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tmp_coti_detalle`
--

INSERT INTO `tmp_coti_detalle` (`id`, `idcoti`, `idproducto`, `cantidad`, `promocion`, `precio`, `iva`) VALUES
(1, 64, 1, 10, 1, '16.38', '0.00'),
(2, 65, 1, 10, 1, '16.38', '0.00'),
(3, 66, 1, 2, 1, '16.38', '0.00'),
(4, 67, 1, 2, 1, '16.38', '0.00'),
(5, 68, 3, 2, 0, '15.00', '0.00'),
(6, 69, 3, 2, 0, '15.00', '0.00'),
(7, 69, 1, 3, 1, '16.38', '0.00'),
(8, 69, 2, 2, 0, '27.58', '0.00'),
(9, 70, 1, 5, 1, '16.38', '0.00'),
(10, 72, 2, 1, 1, '27.58', '0.00'),
(11, 73, 2, 1, 1, '27.58', '0.00'),
(12, 74, 4, 2, 0, '7.92', '0.00'),
(16, 76, 2, 3, 0, '27.58', '0.00'),
(22, 78, 3, 2, 0, '15.00', '0.00'),
(28, 80, 2, 1, 0, '27.58', '0.00'),
(34, 82, 2, 1, 0, '27.58', '0.00'),
(40, 84, 2, 156, 0, '27.58', '0.00'),
(46, 86, 2, 1, 0, '27.58', '0.00'),
(47, 88, 30, 32, 0, '22.56', '0.00'),
(48, 89, 30, 32, 0, '22.56', '0.00'),
(50, 91, 1, 5, 1, '16.38', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_det_muestra`
--

CREATE TABLE `tmp_det_muestra` (
  `id_tmp_det` int(11) NOT NULL,
  `n_muestra` int(11) NOT NULL,
  `idx_muestra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tmp_det_muestra`
--

INSERT INTO `tmp_det_muestra` (`id_tmp_det`, `n_muestra`, `idx_muestra`, `cantidad`, `fecha`) VALUES
(1, 120, 31, 42, '2019-05-05'),
(2, 116, 31, 2, '2019-05-05'),
(3, 0, 0, 0, '0000-00-00'),
(4, 116, 31, 2, '2019-05-05'),
(5, 116, 31, 2, '2019-05-05'),
(6, 134, 43, 3, '2019-05-26'),
(7, 135, 43, 3, '2019-05-26'),
(8, 136, 43, 23, '2019-05-26'),
(9, 137, 43, 3, '2019-05-26'),
(11, 139, 44, 1, '2019-05-26'),
(12, 140, 46, 2, '2019-05-26'),
(13, 141, 47, 3, '2019-05-26'),
(14, 142, 43, 4, '2019-05-26'),
(15, 143, 47, 2, '2019-05-26'),
(16, 144, 47, 4, '2019-05-26'),
(18, 146, 44, 32, '2019-05-26'),
(19, 147, 43, 5, '2019-05-26'),
(26, 154, 43, 4, '2019-05-27');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_clientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_clientes` (
`idx_clientes` int(11)
,`cru_clientes` varchar(10)
,`concat(tbl_clientes.nom_clientes,' ',tbl_clientes.ape_clientes)` varchar(241)
,`nom_ciudades` varchar(120)
,`nom_rutas` varchar(120)
,`dir_clientes` varchar(120)
,`emp_clientes` varchar(120)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_inventario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_inventario` (
`idx_producto` int(11)
,`nomp_producto` varchar(120)
,`prec_producto` decimal(7,2)
,`promo_producto` int(11)
,`desc_tipo` varchar(120)
,`caract_inventario` longtext
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_muestra`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_muestra` (
`idx_muestra` int(11)
,`nomp_producto` varchar(120)
,`fecha_muestra` date
,`cont_muestra` int(11)
,`idx_operador` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_operador`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_operador` (
`idx_operador` int(11)
,`ced_operador` varchar(10)
,`operador` varchar(241)
,`tel_operador` varchar(10)
,`dir_operador` varchar(120)
,`email_operador` varchar(120)
,`nrol_operador` varchar(120)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_rutas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_rutas` (
`idx_rutas` int(11)
,`nom_ciudades` varchar(120)
,`nom_rutas` varchar(120)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_tbl_citas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_tbl_citas` (
`id_citas` int(11)
,`fecha_citas` varchar(10)
,`hora_citas` varchar(11)
,`cliente` varchar(241)
,`estado_citas` varchar(45)
,`obseravacion_citas` longtext
,`operador` varchar(241)
,`idx_clientes` int(11)
,`idx_operador` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_tbl_det_muestra`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_tbl_det_muestra` (
`n_muestra` varchar(10)
,`nomp_producto` varchar(120)
,`fecha` date
,`cantidad` int(11)
,`id_tmp_det` int(11)
,`idx_vista` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_tbl_det_pedidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_tbl_det_pedidos` (
`idx_det_pedido` int(11)
,`idx_perdido` varchar(11)
,`idx_producto` int(11)
,`cantidad` int(11)
,`precio` decimal(10,2)
,`promocion` int(11)
,`iva` decimal(10,2)
,`subt_det_pedido` decimal(7,2)
,`nomp_producto` varchar(120)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_tbl_perdido_v1`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_tbl_perdido_v1` (
`tiempo` varchar(24)
,`idx_perdido` varchar(11)
,`totaliva_perdido` decimal(7,2)
,`totalsiniva_perdido` decimal(7,2)
,`total_perdido` decimal(7,2)
,`idx_clientes` int(11)
,`cliente` varchar(241)
,`idx_operador` int(10)
,`operador` varchar(241)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_visitas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_visitas` (
`idx_visita` int(11)
,`fech_visita` date
,`mes_visita` int(2)
,`cedu_visita` varchar(10)
,`nom_visita` varchar(120)
,`esp_especialidades` varchar(120)
,`localizacion` varchar(243)
,`operador` varchar(241)
,`idx_especialidades` int(11)
,`idx_rutas` int(11)
,`nom_rutas` varchar(120)
,`idx_ciudades` int(11)
,`nom_ciudades` varchar(120)
,`dir_visita` varchar(120)
,`ced_operador` varchar(10)
,`nom_operador` varchar(120)
,`idx_operador` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_visitas_detalle`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_visitas_detalle` (
`n_muestra` varchar(11)
,`nom_visita` varchar(120)
,`dir_visita` varchar(120)
,`operador` varchar(241)
,`total_cant` int(11)
,`idx_visitas_detalle` int(11)
,`idx_vista` int(11)
,`esp_especialidades` varchar(120)
,`fech_visita` date
,`localizacion` varchar(243)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_detalle`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_detalle` (
`id` int(11)
,`idcoti` int(11)
,`idproducto` int(11)
,`nomp_producto` varchar(120)
,`cantidad` int(11)
,`promocion` int(11)
,`precio` decimal(9,2)
,`iva` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_detalle_muestra`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_detalle_muestra` (
`id_tmp_det` int(11)
,`n_muestra` int(11)
,`fecha` date
,`nomp_producto` varchar(120)
,`cantidad` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_medico`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_medico` (
`ced_medico` varchar(15)
,`Medico` varchar(120)
,`Direccion` longtext
,`Localizacion` varchar(243)
,`esp_especialidades` varchar(120)
,`ruta` int(11)
,`idx_ciudades` int(11)
,`especialidad` int(11)
,`idxm` int(11)
,`idx_operador` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pedido`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_pedido` (
`idx_perdido` varchar(11)
,`fech_perdido` date
,`emp_clientes` varchar(120)
,`cru_clientes` varchar(10)
,`Cliente` varchar(241)
,`dir_clientes` varchar(120)
,`telf_clientes` varchar(10)
,`email_clientes` varchar(120)
,`idx_rutas` int(11)
,`idx_ciudades` int(11)
,`Operador` varchar(241)
,`hora_perdido` time
,`totalbono` decimal(10,2)
,`totaliva_perdido` decimal(7,2)
,`totalsiniva_perdido` decimal(7,2)
,`total_perdido` decimal(7,2)
,`nom_rutas` varchar(120)
,`nom_ciudades` varchar(120)
,`idx_clientes` int(11)
,`idx_operador` int(10)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `excel`
--
DROP TABLE IF EXISTS `excel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `excel`  AS  select `view_visitas`.`idx_visita` AS `idx_visita`,`view_visitas`.`nom_visita` AS `nom_visita`,`view_visitas`.`dir_visita` AS `dir_visita`,`view_visitas`.`esp_especialidades` AS `esp_especialidades`,`view_visitas`.`operador` AS `operador`,`view_muestra`.`nomp_producto` AS `nomp_producto`,`tbl_det_muestra`.`cant_det_muestra` AS `cant_det_muestra`,`view_muestra`.`idx_muestra` AS `idx_muestra`,`view_visitas`.`fech_visita` AS `fech_visita`,`view_muestra`.`cont_muestra` AS `cont_muestra`,`view_visitas`.`localizacion` AS `localizacion` from ((`view_visitas` join `tbl_det_muestra` on((`tbl_det_muestra`.`idx_vista` = `view_visitas`.`idx_visita`))) join `view_muestra` on((`view_muestra`.`idx_muestra` = `tbl_det_muestra`.`idx_muestra`))) where ((`tbl_det_muestra`.`idx_vista` = `view_visitas`.`idx_visita`) and (`tbl_det_muestra`.`idx_muestra` = `view_muestra`.`idx_muestra`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_clientes`
--
DROP TABLE IF EXISTS `view_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_clientes`  AS  select `tbl_clientes`.`idx_clientes` AS `idx_clientes`,`tbl_clientes`.`cru_clientes` AS `cru_clientes`,concat(`tbl_clientes`.`nom_clientes`,' ',`tbl_clientes`.`ape_clientes`) AS `concat(tbl_clientes.nom_clientes,' ',tbl_clientes.ape_clientes)`,`tbl_ciudades`.`nom_ciudades` AS `nom_ciudades`,`tbl_rutas`.`nom_rutas` AS `nom_rutas`,`tbl_clientes`.`dir_clientes` AS `dir_clientes`,`tbl_clientes`.`emp_clientes` AS `emp_clientes` from ((`tbl_clientes` join `tbl_ciudades`) join `tbl_rutas`) where ((`tbl_clientes`.`idx_rutas` = `tbl_rutas`.`idx_rutas`) and (`tbl_rutas`.`idx_ciudades` = `tbl_ciudades`.`idx_ciudades`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_inventario`
--
DROP TABLE IF EXISTS `view_inventario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_inventario`  AS  select `tbl_inventario`.`idx_producto` AS `idx_producto`,`tbl_inventario`.`nomp_producto` AS `nomp_producto`,`tbl_inventario`.`prec_producto` AS `prec_producto`,`tbl_inventario`.`promo_producto` AS `promo_producto`,`tbl_tipo`.`desc_tipo` AS `desc_tipo`,`tbl_inventario`.`caract_inventario` AS `caract_inventario` from (`tbl_tipo` join `tbl_inventario`) where (`tbl_inventario`.`idx_tipo` = `tbl_tipo`.`idx_tipo`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_muestra`
--
DROP TABLE IF EXISTS `view_muestra`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_muestra`  AS  select `tbl_muestra`.`idx_muestra` AS `idx_muestra`,`tbl_inventario`.`nomp_producto` AS `nomp_producto`,`tbl_muestra`.`fecha_muestra` AS `fecha_muestra`,`tbl_muestra`.`cont_muestra` AS `cont_muestra`,`tbl_muestra`.`idx_operador` AS `idx_operador` from (`tbl_muestra` join `tbl_inventario`) where (`tbl_muestra`.`idx_producto` = `tbl_inventario`.`idx_producto`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_operador`
--
DROP TABLE IF EXISTS `view_operador`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_operador`  AS  select `tbl_operador`.`idx_operador` AS `idx_operador`,`tbl_operador`.`ced_operador` AS `ced_operador`,concat(`tbl_operador`.`nom_operador`,' ',`tbl_operador`.`ape_operador`) AS `operador`,`tbl_operador`.`tel_operador` AS `tel_operador`,`tbl_operador`.`dir_operador` AS `dir_operador`,`tbl_operador`.`email_operador` AS `email_operador`,`tbl_operador`.`nrol_operador` AS `nrol_operador` from `tbl_operador` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_rutas`
--
DROP TABLE IF EXISTS `view_rutas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rutas`  AS  select `tbl_rutas`.`idx_rutas` AS `idx_rutas`,`tbl_ciudades`.`nom_ciudades` AS `nom_ciudades`,`tbl_rutas`.`nom_rutas` AS `nom_rutas` from (`tbl_rutas` join `tbl_ciudades`) where (`tbl_ciudades`.`idx_ciudades` = `tbl_rutas`.`idx_ciudades`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_tbl_citas`
--
DROP TABLE IF EXISTS `view_tbl_citas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tbl_citas`  AS  select `tbl_citas`.`id_citas` AS `id_citas`,date_format(`tbl_citas`.`fecha_citas`,'%d-%m-%Y') AS `fecha_citas`,date_format(`tbl_citas`.`hora_citas`,' %H:%i') AS `hora_citas`,concat(`tbl_clientes`.`nom_clientes`,' ',`tbl_clientes`.`ape_clientes`) AS `cliente`,`tbl_citas`.`estado_citas` AS `estado_citas`,`tbl_citas`.`obseravacion_citas` AS `obseravacion_citas`,concat(`tbl_operador`.`nom_operador`,' ',`tbl_operador`.`ape_operador`) AS `operador`,`tbl_citas`.`idx_clientes` AS `idx_clientes`,`tbl_citas`.`idx_operador` AS `idx_operador` from ((`tbl_citas` join `tbl_clientes`) join `tbl_operador`) where ((`tbl_citas`.`idx_clientes` = `tbl_clientes`.`idx_clientes`) and (`tbl_citas`.`idx_operador` = `tbl_operador`.`idx_operador`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_tbl_det_muestra`
--
DROP TABLE IF EXISTS `view_tbl_det_muestra`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tbl_det_muestra`  AS  select `tbl_det_muestra`.`idx_det_muestra` AS `n_muestra`,`view_muestra`.`nomp_producto` AS `nomp_producto`,`tbl_det_muestra`.`fecha_det_muestra` AS `fecha`,`tbl_det_muestra`.`cant_det_muestra` AS `cantidad`,`tbl_det_muestra`.`idx_muestra` AS `id_tmp_det`,`tbl_det_muestra`.`idx_vista` AS `idx_vista` from (`tbl_det_muestra` join `view_muestra`) where (`tbl_det_muestra`.`idx_muestra` = `view_muestra`.`idx_muestra`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_tbl_det_pedidos`
--
DROP TABLE IF EXISTS `view_tbl_det_pedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tbl_det_pedidos`  AS  select `tbl_det_pedido`.`idx_det_pedido` AS `idx_det_pedido`,`tbl_det_pedido`.`idx_perdido` AS `idx_perdido`,`tbl_det_pedido`.`idx_producto` AS `idx_producto`,`tbl_det_pedido`.`cant_det_pedido` AS `cantidad`,`tbl_det_pedido`.`pre_det_pedido` AS `precio`,`tbl_det_pedido`.`pro_det_pedido` AS `promocion`,`tbl_det_pedido`.`iva_det_pedido` AS `iva`,`tbl_det_pedido`.`subt_det_pedido` AS `subt_det_pedido`,`tbl_inventario`.`nomp_producto` AS `nomp_producto` from (`tbl_det_pedido` join `tbl_inventario` on((`tbl_det_pedido`.`idx_producto` = `tbl_inventario`.`idx_producto`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_tbl_perdido_v1`
--
DROP TABLE IF EXISTS `view_tbl_perdido_v1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tbl_perdido_v1`  AS  select concat(date_format(`tbl_perdido`.`fech_perdido`,'%d-%m-%Y'),'_','_','_','_',`tbl_perdido`.`hora_perdido`) AS `tiempo`,`tbl_perdido`.`idx_perdido` AS `idx_perdido`,`tbl_perdido`.`totaliva_perdido` AS `totaliva_perdido`,`tbl_perdido`.`totalsiniva_perdido` AS `totalsiniva_perdido`,`tbl_perdido`.`total_perdido` AS `total_perdido`,`tbl_perdido`.`idx_clientes` AS `idx_clientes`,concat(`tbl_clientes`.`nom_clientes`,' ',`tbl_clientes`.`ape_clientes`) AS `cliente`,`tbl_perdido`.`idx_operador` AS `idx_operador`,concat(`tbl_operador`.`nom_operador`,' ',`tbl_operador`.`ape_operador`) AS `operador` from ((`tbl_perdido` join `tbl_clientes`) join `tbl_operador`) where ((`tbl_perdido`.`idx_clientes` = `tbl_clientes`.`idx_clientes`) and (`tbl_perdido`.`idx_operador` = `tbl_operador`.`idx_operador`)) order by `tbl_perdido`.`idx_perdido` desc ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_visitas`
--
DROP TABLE IF EXISTS `view_visitas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_visitas`  AS  select `tbl_visitas`.`idx_visita` AS `idx_visita`,`tbl_visitas`.`fech_visita` AS `fech_visita`,month(`tbl_visitas`.`fech_visita`) AS `mes_visita`,`tbl_visitas`.`cedu_visita` AS `cedu_visita`,`tbl_visitas`.`nom_visita` AS `nom_visita`,`tbl_especialidades`.`esp_especialidades` AS `esp_especialidades`,concat(`tbl_ciudades`.`nom_ciudades`,' / ',`tbl_rutas`.`nom_rutas`) AS `localizacion`,concat(`tbl_operador`.`nom_operador`,' ',`tbl_operador`.`ape_operador`) AS `operador`,`tbl_visitas`.`idx_especialidades` AS `idx_especialidades`,`tbl_visitas`.`idx_rutas` AS `idx_rutas`,`tbl_rutas`.`nom_rutas` AS `nom_rutas`,`tbl_rutas`.`idx_ciudades` AS `idx_ciudades`,`tbl_ciudades`.`nom_ciudades` AS `nom_ciudades`,`tbl_visitas`.`dir_visita` AS `dir_visita`,`tbl_operador`.`ced_operador` AS `ced_operador`,`tbl_operador`.`nom_operador` AS `nom_operador`,`tbl_visitas`.`idx_operador` AS `idx_operador` from ((((`tbl_visitas` join `tbl_especialidades` on((`tbl_especialidades`.`idx_especialidades` = `tbl_visitas`.`idx_especialidades`))) join `tbl_ciudades`) join `tbl_rutas` on(((`tbl_rutas`.`idx_rutas` = `tbl_visitas`.`idx_rutas`) and (`tbl_ciudades`.`idx_ciudades` = `tbl_rutas`.`idx_ciudades`)))) join `tbl_operador` on((`tbl_operador`.`idx_operador` = `tbl_visitas`.`idx_operador`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_visitas_detalle`
--
DROP TABLE IF EXISTS `view_visitas_detalle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_visitas_detalle`  AS  select `tbl_visitas_detalle`.`n_muestra` AS `n_muestra`,`view_visitas`.`nom_visita` AS `nom_visita`,`view_visitas`.`dir_visita` AS `dir_visita`,`view_visitas`.`operador` AS `operador`,`tbl_visitas_detalle`.`total_cant` AS `total_cant`,`tbl_visitas_detalle`.`idx_visitas_detalle` AS `idx_visitas_detalle`,`tbl_visitas_detalle`.`idx_visitas` AS `idx_vista`,`view_visitas`.`esp_especialidades` AS `esp_especialidades`,`view_visitas`.`fech_visita` AS `fech_visita`,`view_visitas`.`localizacion` AS `localizacion` from (`tbl_visitas_detalle` join `view_visitas` on((`view_visitas`.`idx_visita` = `tbl_visitas_detalle`.`idx_visitas`))) where (`tbl_visitas_detalle`.`idx_visitas` = `view_visitas`.`idx_visita`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_detalle`
--
DROP TABLE IF EXISTS `v_detalle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detalle`  AS  select `tmp_coti_detalle`.`id` AS `id`,`tmp_coti_detalle`.`idcoti` AS `idcoti`,`tmp_coti_detalle`.`idproducto` AS `idproducto`,`tbl_inventario`.`nomp_producto` AS `nomp_producto`,`tmp_coti_detalle`.`cantidad` AS `cantidad`,`tmp_coti_detalle`.`promocion` AS `promocion`,`tmp_coti_detalle`.`precio` AS `precio`,`tmp_coti_detalle`.`iva` AS `iva` from (`tmp_coti_detalle` join `tbl_inventario` on((`tbl_inventario`.`idx_producto` = `tmp_coti_detalle`.`idproducto`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_detalle_muestra`
--
DROP TABLE IF EXISTS `v_detalle_muestra`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detalle_muestra`  AS  select `tmp_det_muestra`.`id_tmp_det` AS `id_tmp_det`,`tmp_det_muestra`.`n_muestra` AS `n_muestra`,`tmp_det_muestra`.`fecha` AS `fecha`,`view_muestra`.`nomp_producto` AS `nomp_producto`,`tmp_det_muestra`.`cantidad` AS `cantidad` from (`view_muestra` join `tmp_det_muestra`) where (`view_muestra`.`idx_muestra` = `tmp_det_muestra`.`idx_muestra`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_medico`
--
DROP TABLE IF EXISTS `v_medico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_medico`  AS  select `tbl_medico`.`ced_medico` AS `ced_medico`,ucase(`tbl_medico`.`nom_medi`) AS `Medico`,ucase(`tbl_medico`.`dir_medico`) AS `Direccion`,ucase(concat(`tbl_ciudades`.`nom_ciudades`,' / ',`tbl_rutas`.`nom_rutas`)) AS `Localizacion`,`tbl_especialidades`.`esp_especialidades` AS `esp_especialidades`,`tbl_medico`.`ruta` AS `ruta`,`tbl_rutas`.`idx_ciudades` AS `idx_ciudades`,`tbl_medico`.`especialidad` AS `especialidad`,`tbl_medico`.`idxm` AS `idxm`,`tbl_medico`.`idx_operador` AS `idx_operador` from (((`tbl_medico` join `tbl_rutas` on((`tbl_rutas`.`idx_rutas` = `tbl_medico`.`ruta`))) join `tbl_especialidades` on((`tbl_especialidades`.`idx_especialidades` = `tbl_medico`.`especialidad`))) join `tbl_ciudades` on((`tbl_rutas`.`idx_ciudades` = `tbl_ciudades`.`idx_ciudades`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pedido`
--
DROP TABLE IF EXISTS `v_pedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pedido`  AS  select `tbl_perdido`.`idx_perdido` AS `idx_perdido`,`tbl_perdido`.`fech_perdido` AS `fech_perdido`,`tbl_clientes`.`emp_clientes` AS `emp_clientes`,`tbl_clientes`.`cru_clientes` AS `cru_clientes`,concat(`tbl_clientes`.`nom_clientes`,' ',`tbl_clientes`.`ape_clientes`) AS `Cliente`,`tbl_clientes`.`dir_clientes` AS `dir_clientes`,`tbl_clientes`.`telf_clientes` AS `telf_clientes`,`tbl_clientes`.`email_clientes` AS `email_clientes`,`tbl_clientes`.`idx_rutas` AS `idx_rutas`,`tbl_rutas`.`idx_ciudades` AS `idx_ciudades`,concat(`tbl_operador`.`nom_operador`,' ',`tbl_operador`.`ape_operador`) AS `Operador`,`tbl_perdido`.`hora_perdido` AS `hora_perdido`,`tbl_perdido`.`totalbono` AS `totalbono`,`tbl_perdido`.`totaliva_perdido` AS `totaliva_perdido`,`tbl_perdido`.`totalsiniva_perdido` AS `totalsiniva_perdido`,`tbl_perdido`.`total_perdido` AS `total_perdido`,`tbl_rutas`.`nom_rutas` AS `nom_rutas`,`tbl_ciudades`.`nom_ciudades` AS `nom_ciudades`,`tbl_clientes`.`idx_clientes` AS `idx_clientes`,`tbl_perdido`.`idx_operador` AS `idx_operador` from ((((`tbl_perdido` join `tbl_clientes` on((`tbl_perdido`.`idx_clientes` = `tbl_clientes`.`idx_clientes`))) join `tbl_operador` on((`tbl_perdido`.`idx_operador` = `tbl_operador`.`idx_operador`))) join `tbl_rutas` on((`tbl_clientes`.`idx_rutas` = `tbl_rutas`.`idx_rutas`))) join `tbl_ciudades` on((`tbl_rutas`.`idx_ciudades` = `tbl_ciudades`.`idx_ciudades`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  ADD PRIMARY KEY (`id_citas`);

--
-- Indices de la tabla `tbl_ciudades`
--
ALTER TABLE `tbl_ciudades`
  ADD PRIMARY KEY (`idx_ciudades`);

--
-- Indices de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`idx_clientes`),
  ADD KEY `ruta` (`idx_rutas`);

--
-- Indices de la tabla `tbl_det_pedido`
--
ALTER TABLE `tbl_det_pedido`
  ADD PRIMARY KEY (`idx_det_pedido`),
  ADD KEY `inventario` (`idx_producto`),
  ADD KEY `pedido` (`idx_perdido`);

--
-- Indices de la tabla `tbl_diario`
--
ALTER TABLE `tbl_diario`
  ADD PRIMARY KEY (`Nro_informe`);

--
-- Indices de la tabla `tbl_especialidades`
--
ALTER TABLE `tbl_especialidades`
  ADD PRIMARY KEY (`idx_especialidades`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`idx_producto`),
  ADD KEY `tipo` (`idx_tipo`);

--
-- Indices de la tabla `tbl_medico`
--
ALTER TABLE `tbl_medico`
  ADD PRIMARY KEY (`idxm`);

--
-- Indices de la tabla `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`idx_menu`);

--
-- Indices de la tabla `tbl_muestra`
--
ALTER TABLE `tbl_muestra`
  ADD PRIMARY KEY (`idx_muestra`);

--
-- Indices de la tabla `tbl_operador`
--
ALTER TABLE `tbl_operador`
  ADD PRIMARY KEY (`idx_operador`);

--
-- Indices de la tabla `tbl_parametros`
--
ALTER TABLE `tbl_parametros`
  ADD PRIMARY KEY (`idx`);

--
-- Indices de la tabla `tbl_perdido`
--
ALTER TABLE `tbl_perdido`
  ADD PRIMARY KEY (`idx_perdido`),
  ADD KEY `operador` (`idx_operador`),
  ADD KEY `cliente` (`idx_clientes`);

--
-- Indices de la tabla `tbl_rutas`
--
ALTER TABLE `tbl_rutas`
  ADD PRIMARY KEY (`idx_rutas`),
  ADD KEY `ciudades` (`idx_ciudades`);

--
-- Indices de la tabla `tbl_sql`
--
ALTER TABLE `tbl_sql`
  ADD PRIMARY KEY (`idx_sql`);

--
-- Indices de la tabla `tbl_tipo`
--
ALTER TABLE `tbl_tipo`
  ADD PRIMARY KEY (`idx_tipo`);

--
-- Indices de la tabla `tbl_visitas`
--
ALTER TABLE `tbl_visitas`
  ADD PRIMARY KEY (`idx_visita`),
  ADD KEY `especialidades` (`idx_especialidades`),
  ADD KEY `fk2` (`idx_operador`),
  ADD KEY `fk1` (`idx_rutas`);

--
-- Indices de la tabla `tbl_visitas_detalle`
--
ALTER TABLE `tbl_visitas_detalle`
  ADD PRIMARY KEY (`idx_visitas_detalle`),
  ADD KEY `visita` (`idx_visitas`);

--
-- Indices de la tabla `tmp_coti_detalle`
--
ALTER TABLE `tmp_coti_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tmp_det_muestra`
--
ALTER TABLE `tmp_det_muestra`
  ADD PRIMARY KEY (`id_tmp_det`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  MODIFY `id_citas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador DE  LA  TABLA', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_ciudades`
--
ALTER TABLE `tbl_ciudades`
  MODIFY `idx_ciudades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `idx_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_det_pedido`
--
ALTER TABLE `tbl_det_pedido`
  MODIFY `idx_det_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_especialidades`
--
ALTER TABLE `tbl_especialidades`
  MODIFY `idx_especialidades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `idx_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tbl_medico`
--
ALTER TABLE `tbl_medico`
  MODIFY `idxm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `idx_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_muestra`
--
ALTER TABLE `tbl_muestra`
  MODIFY `idx_muestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_operador`
--
ALTER TABLE `tbl_operador`
  MODIFY `idx_operador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_parametros`
--
ALTER TABLE `tbl_parametros`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_rutas`
--
ALTER TABLE `tbl_rutas`
  MODIFY `idx_rutas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tbl_sql`
--
ALTER TABLE `tbl_sql`
  MODIFY `idx_sql` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo`
--
ALTER TABLE `tbl_tipo`
  MODIFY `idx_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tbl_visitas`
--
ALTER TABLE `tbl_visitas`
  MODIFY `idx_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tbl_visitas_detalle`
--
ALTER TABLE `tbl_visitas_detalle`
  MODIFY `idx_visitas_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tmp_coti_detalle`
--
ALTER TABLE `tmp_coti_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tmp_det_muestra`
--
ALTER TABLE `tmp_det_muestra`
  MODIFY `id_tmp_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD CONSTRAINT `ruta` FOREIGN KEY (`idx_rutas`) REFERENCES `tbl_rutas` (`idx_rutas`);

--
-- Filtros para la tabla `tbl_det_pedido`
--
ALTER TABLE `tbl_det_pedido`
  ADD CONSTRAINT `inventario` FOREIGN KEY (`idx_producto`) REFERENCES `tbl_inventario` (`idx_producto`),
  ADD CONSTRAINT `pedido` FOREIGN KEY (`idx_perdido`) REFERENCES `tbl_perdido` (`idx_perdido`);

--
-- Filtros para la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `tipo` FOREIGN KEY (`idx_tipo`) REFERENCES `tbl_tipo` (`idx_tipo`);

--
-- Filtros para la tabla `tbl_perdido`
--
ALTER TABLE `tbl_perdido`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`idx_clientes`) REFERENCES `tbl_clientes` (`idx_clientes`),
  ADD CONSTRAINT `operador` FOREIGN KEY (`idx_operador`) REFERENCES `tbl_operador` (`idx_operador`);

--
-- Filtros para la tabla `tbl_rutas`
--
ALTER TABLE `tbl_rutas`
  ADD CONSTRAINT `ciudades` FOREIGN KEY (`idx_ciudades`) REFERENCES `tbl_ciudades` (`idx_ciudades`);

--
-- Filtros para la tabla `tbl_visitas`
--
ALTER TABLE `tbl_visitas`
  ADD CONSTRAINT `especialidades` FOREIGN KEY (`idx_especialidades`) REFERENCES `tbl_especialidades` (`idx_especialidades`),
  ADD CONSTRAINT `fk1` FOREIGN KEY (`idx_rutas`) REFERENCES `tbl_rutas` (`idx_rutas`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`idx_operador`) REFERENCES `tbl_operador` (`idx_operador`);

--
-- Filtros para la tabla `tbl_visitas_detalle`
--
ALTER TABLE `tbl_visitas_detalle`
  ADD CONSTRAINT `visita` FOREIGN KEY (`idx_visitas`) REFERENCES `tbl_visitas` (`idx_visita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
