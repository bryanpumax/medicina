<?php
include("../../include/conexionPdo.php");

$nroCoti=$_POST['idxp'];



$consulta=$pdo->query("DELETE FROM tmp_coti_detalle WHERE idcoti='$nroCoti'");
echo 2;


?>