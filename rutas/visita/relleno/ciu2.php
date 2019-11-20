<?php
include("../../include/conexionPdo.php");
 
$nom_visita=$_POST['nom_visita'];

$consulta=$pdo->query("SELECT * FROM view_visitas WHERE view_visitas.nom_visita='$nom_visita'" );
while($rowmedico=$consulta->fetch()){
    $ciu=$rowmedico['nom_ciudades'];
    $consulta2=$pdo->query("SELECT * FROM tbl_ciudades WHERE tbl_ciudades.nom_ciudades='$ciu' " );
    while($rowmedico2=$consulta2->fetch()){
        echo $rowmedico2['idx_ciudades'];
}}


 
?>