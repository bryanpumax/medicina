<?php
include("../../../include/conexionPdo2.php");

$nroCoti=$_POST['idx_perdido'];
$codProducto=$_POST['codproducto'];

$elimina=$pdo->query("DELETE FROM tbl_det_pedido WHERE idx_perdido='$nroCoti' AND idX_producto='$codProducto'" );

echo 2;


?>