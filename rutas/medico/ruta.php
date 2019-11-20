
<?php
	require ('../include/conexion.php');
    $idx_operador= $_SESSION['idx_operador'];
    $id_especie = $_POST['idx_ciudadesselect'];
 
	$sql = "SELECT * FROM tbl_rutas WHERE tbl_rutas.idx_ciudades = $id_especie and idx_operador=$idx_operador" ; 
$res = mysqli_query(conectar(),$sql); 

$tbl_medico = mysqli_fetch_array($res);
    $id=$tbl_medico['idx_rutas'];
    $nom=$tbl_medico['nom_rutas'];
	
echo '<option value="'.$id.'">'.$nom.'</option>';
    while($mostrar=mysqli_fetch_array($res))
    {
        echo  '<option value="'. $mostrar['idx_rutas'] .'">'.$mostrar['nom_rutas'].'</option>';
    }

	
?>
