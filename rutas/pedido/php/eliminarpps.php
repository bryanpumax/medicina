<?php
include("../../include/conexionPdo.php");

$idx_perdido=$_GET['idx_perdido'];


$consulta1=$pdo->query("DELETE FROM tbl_det_pedido WHERE idx_perdido='$idx_perdido'");
$consulta=$pdo->query("DELETE FROM tbl_perdido WHERE idx_perdido='$idx_perdido'");


?>
<script> window.location="../index.php";</script>