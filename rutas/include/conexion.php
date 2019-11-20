<?php
date_default_timezone_set('America/Guayaquil');


function conectar()
{
    $servername='localhost';
    $username='root';
    $password='';
    $base='bdd_ruta';
    $conexion = mysqli_connect($servername, $username,$password,$base);
 
    if(!$conexion){die('Pagina  fuera de  servicio');}
    return $conexion;
}

function TildesHtml($cadena) 
    { 
        return (str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
     array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena));     
    }
function tilde_utfdecode($cadena){
    $cadena=utf8_decode($cadena);
    return $cadena;
}

function limpiar_cadena_sin_espacio($cadena){
    $cadena=trim($cadena);//elimina espacio
    $cadena=stripslashes($cadena);//elimia  \
    $cadena=str_ireplace("<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("/<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("<script src","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("SELECT * FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("DELETE FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("INSERT INTO","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("--","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("^","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("{","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("}","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("'","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("=","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("#","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("%","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(".","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("&","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("/","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("//","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("@","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("(","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(")","",$cadena);//elimina la etiqueta

        
return $cadena;
}

function limpiar_cadena($cadena){
    
    $cadena=stripslashes($cadena);//elimia  \
    $cadena=str_ireplace("<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("/<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("<script src","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("SELECT * FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("DELETE FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("INSERT INTO","",$cadena);//elimina la etiqueta
   $cadena=str_ireplace("--","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("^","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("{","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("}","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("'","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("=","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("#","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("%","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(".","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("&","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("/","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("@","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("(","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(")","",$cadena);//elimina la etiqueta
return $cadena;
}


function limpiar_cadena_coma_punto($cadena){
    
    $cadena=stripslashes($cadena);//elimia  \
    $cadena=str_ireplace("<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("/<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("<script src","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("SELECT * FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("DELETE FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("INSERT INTO","",$cadena);//elimina la etiqueta
   $cadena=str_ireplace("--","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("^","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("{","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("}","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("'","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("$","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("=","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("#","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("%","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(",",".",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(".",".",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("&","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("/","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("@","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("(","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(")","",$cadena);//elimina la etiqueta
return $cadena;
}
function limpiar_cadena_email($cadena){
    
    $cadena=stripslashes($cadena);//elimia  \
    $cadena=str_ireplace("<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("/<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("<script src","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("SELECT * FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("DELETE FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("INSERT INTO","",$cadena);//elimina la etiqueta
   $cadena=str_ireplace("--","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("^","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("{","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("}","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("'","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("=","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("#","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("%","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(",",".",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(".",".",$cadena);//elimina la etiqueta
         
        $cadena=str_ireplace("/","",$cadena);//elimina la etiqueta
        
        $cadena=str_ireplace("(","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(")","",$cadena);//elimina la etiqueta
return $cadena;
}

function limpiar_cadena_guion($cadena){
    
    $cadena=stripslashes($cadena);//elimia  \
    $cadena=str_ireplace("<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("/<script>","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("<script src","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("SELECT * FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("DELETE FROM","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("INSERT INTO","",$cadena);//elimina la etiqueta
   $cadena=str_ireplace("_","&nbsp;",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("^","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("{","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("}","",$cadena);//elimina la etiqueta
    $cadena=str_ireplace("'","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("=","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("#","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace("%","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(",",".",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(".",".",$cadena);//elimina la etiqueta
         
        $cadena=str_ireplace("/","",$cadena);//elimina la etiqueta
        
        $cadena=str_ireplace("(","",$cadena);//elimina la etiqueta
        $cadena=str_ireplace(")","",$cadena);//elimina la etiqueta
return $cadena;
}
function procedimiento(){
$sql="
DELIMITER //
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_operador` (`id` INT)  begin
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_rutas` (`id` INT)  BEGIN
declare contar int;
declare idx_ciudades int;
select tbl_rutas.idx_ciudades into idx_ciudades from tbl_rutas where tbl_rutas.idx_rutas=id;
if not exists(SELECT * from tbl_clientes tbl_p,tbl_rutas tbl_o  where tbl_p.idx_rutas=tbl_o.idx_rutas     and tbl_o.idx_rutas=id)then
delete from tbl_rutas where idx_rutas=id;

select count(*) into contar from tbl_rutas where tbl_rutas.idx_ciudades=idx_ciudades;
 update tbl_ciudades set cont_ciudades=contar where tbl_ciudades.idx_ciudades=idx_ciudades;
end  if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_e_tipo` (`id` INT)  BEGIN
if not exists(select * from tbl_inventario where idx_tipo=id )then
delete from tbl_tipo where idx_tipo =id;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_ciudades` (`nom_ciudades` VARCHAR(120))  BEGIN
 if not exists(select * from tbl_ciudades where tbl_ciudades.nom_ciudades=nom_ciudades  )then
 insert into tbl_ciudades values(null,nom_ciudades,0);
 end if;
 
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_clientes` (`cru_clientes` VARCHAR(10), `nom_clientes` VARCHAR(120), `ape_clientes` VARCHAR(120), `idx_ruta` INT, `dir_clientes` VARCHAR(120), `telf_clientes` VARCHAR(10), `cel_clientes` VARCHAR(10), `email_clientes` VARCHAR(120), `emp_clientes` VARCHAR(120))  BEGIN
if not exists(Select * from tbl_clientes where tbl_clientes.cru_clientes=cru_clientes)then 
insert into tbl_clientes value(null,cru_clientes,nom_clientes,ape_clientes,idx_ruta,dir_clientes,telf_clientes,cel_clientes,email_clientes,emp_clientes);
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_det_pedido` (`idx_perdido` INT, `idx_producto` INT, `cant` INT)  begin
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_Especialidades` (`esp_especialidades` VARCHAR(120))  BEGIN
 if not exists(select * from tbl_especialidades where tbl_especialidades.esp_especialidades=esp_especialidades) then
 insert into tbl_especialidades values(null,esp_especialidades);
 end if;
 
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_invetario` (IN `nomp_producto` VARCHAR(120), IN `idx_tipo` INT, IN `prec_producto` DECIMAL(7,2), IN `img_producto` LONGTEXT, IN `iva_producto` INT, IN `promo_producto` INT, IN `caract_inventario` LONGTEXT)  BEGIN 
declare contar int;

 if not exists(select * from tbl_inventario where tbl_inventario.nomp_producto=nomp_producto and tbl_inventario.idx_tipo=idx_tipo)then
 insert into tbl_inventario value(null,nomp_producto,idx_tipo,prec_producto,img_producto,iva_producto,promo_producto,caract_inventario,0);
 select count(*) into contar from tbl_inventario where tbl_inventario.idx_tipo=idx_tipo;
 update tbl_tipo set contar_tipo=contar where tbl_tipo.idx_tipo=idx_tipo;
 end if;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_operador` (`ced_operador` VARCHAR(10), `nom_operador` VARCHAR(120), `ape_operador` VARCHAR(120), `tel_operador` VARCHAR(10), `dir_operador` VARCHAR(120), `email_operador` VARCHAR(120), `usu_operador` VARCHAR(120), `pass_operador` VARCHAR(120), `rol_operador` INT, `nrol_operador` VARCHAR(120), `img_operador` LONGTEXT)  begin

declare pass_operador2 varchar(120);
if not exists(select * from tbl_operador where tbl_operador.ced_operador=ced_operador  )then
set pass_operador2=md5(pass_operador);
insert into tbl_operador value(null,ced_operador  ,nom_operador  ,ape_operador  ,tel_operador ,dir_operador ,email_operador ,usu_operador ,pass_operador2,rol_operador,nrol_operador,img_operador);
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_ruta` (`nom_ruta` VARCHAR(120), `idx_ciudades` INT)  BEGIN 
declare contar int;
 if not exists(select * from tbl_rutas where tbl_rutas.nom_rutas=nom_ruta and tbl_rutas.idx_ciudades=idx_ciudades )then
 insert into tbl_rutas value(null,idx_ciudades,nom_ruta);
 select count(*) into contar from tbl_rutas where tbl_rutas.idx_ciudades=idx_ciudades;
 update tbl_ciudades set cont_ciudades=contar where tbl_ciudades.idx_ciudades=idx_ciudades;
 end if;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_i_tipo` (IN `desc_tipo` VARCHAR(120))  BEGIN
 if not exists(select *  from tbl_tipo where tbl_tipo.desc_tipo=desc_tipo) then
 insert into tbl_tipo value(null,desc_tipo,0);
 end if;
 END$$

// DELIMITER ;";
   
   echo $sql;
}
?>
