<?php
include("../../include/conexionPdo.php");

$nroCoti=$_POST['idxp'];



$consulta=$pdo->query("DELETE FROM tmp_det_muestra WHERE n_muestra=$nroCoti");

 


?>