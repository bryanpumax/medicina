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
 
$nom_visita = strtoupper(limpiar_cadena($_POST['nom_visita']));
$dir_visita = strtoupper(limpiar_cadena($_POST['dir_visita']));
$idx_ruta =  ($_POST['idx_ruta']);
$idx_especialidades=    ($_POST['idx_especialidades']);
$n_muestra =  ($_POST['n_muestra']);
$total_cant =  ($_POST['total_cant']);



$consultam=$pdo->query("SELECT * FROM view_visitas WHERE cedu_visita='$cod_visita' and mes_visita='$fecha_m'");
$cuentam=$consultam->rowCount();
if($cuentam>0){
    echo 3;
    return;
}  


$consulta=$pdo->query("SELECT * FROM tmp_det_muestra WHERE n_muestra='$n_muestra'");
$cuenta=$consulta->rowCount();
if($cuenta==0){
    echo 1;
    return;
}  


$idx_det_muestra=GeneraCodigoPedido('PAR','tbl_parametros','n_muestra');

$idx_visita=null;

if($cod_visita==''){
$cedula=GeneraCodigoPedido('CLI','tbl_parametros','con_cliente');
} else {
$cedula=$cod_visita;
}
$idx_visita=registro_visita( $cedula,$nom_visita,$dir_visita,$idx_ruta,$idx_especialidades,$idxOperador);
$guardatbl_visitas_detalle=$pdo->query("INSERT INTO tbl_visitas_detalle (idx_visitas, n_muestra, total_cant) VALUES (  '$idx_visita','$idx_det_muestra', '$total_cant')");
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
} 
      

function registro_visita($cedula,$nom_visita,$dir_visita,$idx_ruta,$idx_especialidades,$idxOperador ){
 
    $sql = "INSERT into tbl_visitas values(null,curdate(),'$cedula','$nom_visita','$dir_visita',$idx_especialidades,$idx_ruta,$idxOperador,DATE_FORMAT(now(), '%H:%i:00'));";

  if (mysqli_query(conectar(), $sql)) {  

       $sqldet = "SELECT * from tbl_visitas where fech_visita=curdate() and hora_visitas=DATE_FORMAT(now(), '%H:%i:00')        and nom_visita='$nom_visita' and idx_operador=$idxOperador; ";

        $resdet = mysqli_query(conectar(), $sqldet);
        $tbl_visitas = mysqli_fetch_array($resdet);
        $idx_visita = $tbl_visitas['idx_visita'];

        return  $idx_visita;
    }  
 
}
 

function existen_medico($cedula){
 
  $sql = "SELECT * from tbl_visitas where cedu_visita='$cedula'";


  
      $resdet = mysqli_query(conectar(), $sql);
      $tbl_visitas = mysqli_fetch_array($resdet);
      $idx_visita = $tbl_visitas['idx_visita'];

      return  $idx_visita;
   

}


    function GeneraCodigoPedido($identificador=NULL, $tabla=NULL, $campo){
        global $pdo;
        $digitos=8;
  
        $sql_buscar = $pdo->query("SELECT * FROM $tabla");
        $row = $sql_buscar->fetch();
  
  
        $cant = $row[$campo];
        $str_ceros = "";
     
        $nletra = strlen($identificador);
        $ncant = strlen($cant);
      
        $ceros = $digitos - ($nletra + $ncant);
        $i = 1;
      
        while($i <= $ceros){
          $str_ceros .= "0";
          $i += 1;
        }
      
       
        $codigo = $identificador.$str_ceros.$cant;
        return $codigo;
      }


 
    function ActualizaCodigoPedido($tabla,$campo){
      global $pdo;

      $sql_buscar = $pdo->query("SELECT * FROM $tabla");
      $row = $sql_buscar->fetch();
      $cant = $row[$campo]+1;


      $sql_buscar = $pdo->query("UPDATE tbl_parametros set $campo='$cant'");
           
      return $sql_buscar;
    } 
     