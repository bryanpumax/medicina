<?php
session_start();

include("../../include/conexion.php");
include("../../include/conexionPdo.php");

date_default_timezone_set('America/Guayaquil');

$idxOperador=$_SESSION['idx_operador'];


$fecha_r = date("Y/m/d");

$fecha_m = date("m") *1;


$fecha = new DateTime( $fecha_r);
$linea['fecha'] = $fecha->format("Y-m-d");  
$mifecha=$linea['fecha'] ;
$hora = date('H:i:00') ;


$cod_visita = strtoupper(limpiar_cadena($_POST['cod_visita']));
$idx_visita = (limpiar_cadena($_POST['idx_visita']));

$nom_visita = strtoupper(limpiar_cadena($_POST['nom_visita']));
$dir_visita = strtoupper(limpiar_cadena($_POST['dir_visita']));
$idx_ruta =  ($_POST['idx_ruta']);
$idx_especialidades=    ($_POST['idx_especialidades']);
$n_muestra =  ($_POST['n_muestra']);
$total_cant =  ($_POST['total_cant']);

$consultam=$pdo->query("SELECT * FROM view_visitas WHERE cedu_visita='$cod_visita' and mes_visita='$fecha_m'");
$consulta=$pdo->query("SELECT *  from tbl_det_muestra  where idx_vista=$idx_visita");
$cuentam=$consulta->rowCount();
if($cuentam=0){
    echo 0;
    return;
}   
if($total_cant=="0"){ echo 0;
    return;}
        $mensaje= actualizar_visita( $cod_visita,$nom_visita,$dir_visita,$idx_ruta,$idx_especialidades,$idxOperador,$idx_visita,$total_cant);

if($mensaje==="bien"){
    echo 8;
    return;
}
//SELECT * FROM tbl_visitas tblc,tbl_rutas tblr,tbl_ciudades tblcd,tbl_especialidades tbl_e,tbl_visitas_detalle WHERE tblr.idx_ciudades=tblcd.idx_ciudades and tblr.idx_rutas=tblc.idx_rutas and tbl_e.idx_especialidades=tblc.idx_especialidades and tbl_visitas_detalle.idx_visitas=tblc.idx_visita and tblc.idx_visita = 26


/* $guardatbl_visitas_detalle=$pdo->query("INSERT INTO tbl_visitas_detalle (idx_visitas, n_muestra, total_cant) VALUES (  '$idx_visita','$idx_det_muestra', '$total_cant')");
 $consulta_detalle=$pdo->query("SELECT * FROM tmp_det_muestra WHERE n_muestra=$n_muestra");
 
while($row=$consulta_detalle->fetch()){
$idx_muestra=$row['idx_muestra'];
$cantidad=$row['cantidad'];
$fecha=$row['fecha'];
 
 
    $guardadetallePedido=$pdo->query("INSERT INTO tbl_det_muestra (idx_det_muestra, idx_vista, idx_muestra, cant_det_muestra, fecha_det_muestra)VALUES('$idx_det_muestra',$idx_visita,$idx_muestra,'$cantidad','$fecha' );");
 
}  

  
if($guardadetallePedido){
    $consulta=$pdo->query("DELETE FROM tmp_det_muestra WHERE n_muestra=$n_muestra");
     //$update_parametro=ActualizaCodigoPedido('tbl_parametros', 'n_muestra');   
     $update_parametro=ActualizaCodigoPedido('tbl_parametros', 'con_cliente'); 

     echo 2;  
return;    
}  */
      

function actualizar_visita($cedula,$nom_visita,$dir_visita,$idx_ruta,$idx_especialidades,$idxOperador,$idx_visita,$total_cant ){
 //tabla  de  visita
    $sql = "UPDATE tbl_visitas SET 
    fech_visita=curdate(),
    cedu_visita='$cedula',
    nom_visita='$nom_visita',
    dir_visita='$dir_visita',
    idx_especialidades=$idx_especialidades,
    idx_rutas=$idx_ruta,
    idx_operador=$idxOperador,
    hora_visitas=DATE_FORMAT(now(), '%H:%i:00') where idx_visita=$idx_visita";
//tbl_visitas_detalle
$sql2="UPDATE tbl_visitas_detalle set total_cant=$total_cant where idx_visitas=$idx_visita";
  if (mysqli_query(conectar(), $sql)) {  

    if (mysqli_query(conectar(), $sql2)) {  

      
        $mensaje= "bien";
                return $mensaje;
            } 
    }  
 
}
 
