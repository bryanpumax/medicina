<?php
session_start();
include("../../include/conexionPdo.php");




$nroCoti=$_POST['nroCoti'];
$codProdcuto=$_POST['id'];
$producto=$_POST['producto']; 
$cantidad=$_POST['cant'];
$idx_visita=$_POST['idx_visita']; 
$n_muestra=$_POST['n_muestra3']; 
$consulta_Detalle=$pdo->query("SELECT * from tbl_det_muestra WHERE idx_muestra=$codProdcuto and idx_det_muestra='$n_muestra'"); 

$sql="SELECT * from tbl_det_muestra WHERE idx_muestra=$codProdcuto and idx_det_muestra='$n_muestra'";
/* echo $sql; */
 $contar = $consulta_Detalle->rowCount();
 
if($contar === 0){
    $agrega_Detalle=$pdo->query("INSERT INTO tbl_det_muestra(idx_det_muestra, idx_vista, idx_muestra, cant_det_muestra, fecha_det_muestra)VALUES('$n_muestra',$idx_visita,'$codProdcuto','$cantidad',curdate())"); 
    
 
}

  echo $idx_visita  ; 
 

?>



 



