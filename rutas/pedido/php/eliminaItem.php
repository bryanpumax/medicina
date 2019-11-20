<?php
include("../../include/conexionPdo.php");

$nroCoti=$_POST['codcotizacion'];
$codProducto=$_POST['codproducto'];

$elimina=$pdo->query("DELETE FROM tmp_coti_detalle WHERE idcoti='$nroCoti' AND idproducto='$codProducto'" );

echo 2;


?>