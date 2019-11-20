 
<?php
include("../../include/conexionPdo.php");
 
$nom_visita=$_POST['nom_visita'];

$consulta=$pdo->query("SELECT * FROM tbl_visitas WHERE tbl_visitas.nom_visita='$nom_visita'" );
while($rowmedico=$consulta->fetch()){
    echo  $rowmedico['dir_visita'] ;
 
}


 
?>
