 
<?php
include("../../include/conexionPdo.php");
 
$nom_visita=$_POST['nom_visita'];

$consulta=$pdo->query("SELECT * FROM view_visitas WHERE .nom_visita='$nom_visita'" );
while($rowmedico=$consulta->fetch()){
    echo  $rowmedico['esp_especialidades'] ;
 
}


 
?>