 
<?php
include("../../include/conexionPdo.php");
 
$nom_visita=$_POST['nom_visita'];

$consulta=$pdo->query("SELECT * FROM view_visitas WHERE view_visitas.nom_visita='$nom_visita'" );

while($rowmedico=$consulta->fetch()){
    echo  $rowmedico['nom_ciudades'] ;
 
}


 
?>