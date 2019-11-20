 
<?php
include("../../include/conexionPdo.php");
 
$nom_visita=$_POST['nom_visita'];

$consulta=$pdo->query("SELECT * FROM view_visitas WHERE nom_visita='$nom_visita'" );
$rowcedula=$consulta->fetch();
//echo  $rowcedula['cedu_visita'] ;
echo json_encode($rowcedula);
 
?>
