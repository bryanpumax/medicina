<?php
include("../../include/conexionPdo.php");

$nroCoti=$_POST['idxp'];



$consulta=$pdo->query("SELECT *  from tbl_det_muestra  where idx_det_muestra='$nroCoti'");
$cuentam=$consulta->rowCount();
if($cuentam>0){
    echo 0;
    return;
}   

 


?>