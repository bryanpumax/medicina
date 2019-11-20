<?php
include("../../include/conexionPdo.php");

$id=$_POST['id'];
$n_muestra=$_POST['nmuestra'];

$elimina=$pdo->query("DELETE FROM tbl_det_muestra WHERE idx_muestra=$id and idx_det_muestra='$n_muestra'" );
$sql="DELETE FROM tbl_det_muestra WHERE id_tmp_det=$id and idx_det_muestra='$n_muestra'";
echo 2;


?>