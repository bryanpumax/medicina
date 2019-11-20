<?php
session_start();
include("../../include/conexionPdo.php");




$nroCoti=$_POST['nroCoti'];
$codProdcuto=$_POST['id'];
$producto=$_POST['producto'];
 
$cantidad=$_POST['cant'];
 

$consulta_parametro=$pdo->query("SELECT * from tbl_parametros");
$row= $consulta_parametro->fetch();


if($nroCoti == 0){
    $contador=$row['n_muestra']+1;
    $consulta_parametros=$pdo->query("UPDATE tbl_parametros SET n_muestra='$contador'");
} else {
    $contador = $nroCoti;
}


$consulta_Detalle=$pdo->query("SELECT * from tmp_det_muestra WHERE idx_muestra=$codProdcuto and n_muestra=$contador");
$contar = $consulta_Detalle->rowCount();

 
if($contar === 0){
    $agrega_Detalle=$pdo->query("INSERT INTO tmp_det_muestra (n_muestra,idx_muestra, cantidad, fecha)VALUES($contador,'$codProdcuto','$cantidad',curdate())"); 
    $sql="INSERT INTO tmp_det_muestra (id_tmp_det,cont_tmp_muestra,idx_muestra, cantidad, fecha)VALUES(null,'$contador','$codProdcuto','$cantidad',curdate())";
 
}

  echo $contador  ; 


?>



 



