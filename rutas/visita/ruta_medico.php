
<?php
	require ('../include/conexionPdo.php');

    $id_especie = $_POST['idx_ciudadesselect'];

$sql =$pdo->query("SELECT * FROM tbl_rutas WHERE idx_ciudades =" .$id_especie) ; 
$detalle = array();

while($reg = $sql->fetch()){
    $nro_rta = $reg["idx_rutas"];
    $ciudad = $reg["idx_ciudades"];
    $nombre = $reg["nom_rutas"];

       $detalle[] = array('nro'=>$nro_rta, 'ciudad'=>$ciudad, 'ruta'=>$nombre);
}
$json = json_encode($detalle);
echo $json;


?>
