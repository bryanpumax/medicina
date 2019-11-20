<?php
include("../../include/conexionPdo.php");

$id=$_POST['id'];

$elimina=$pdo->query("DELETE FROM tmp_det_muestra WHERE id_tmp_det=$id" );

echo 2;


?>