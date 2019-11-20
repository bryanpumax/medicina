
<?php
	require ('../include/conexion.php');
    session_start();
    $id_especie = $_POST['idx_ciudadesselect'];
    $idx_operador= $_SESSION['idx_operador'];
	$sql = "SELECT * FROM tbl_rutas WHERE idx_operador=$idx_operador AND tbl_rutas.idx_ciudades = $id_especie " ; 
$res = mysqli_query(conectar(),$sql); 
$sql1 = "SELECT * FROM tbl_ciudades t  WHERE t.idx_ciudades=" . $id_especie . " ;";
$res1 = mysqli_query(conectar(), $sql1);
$ciudad = mysqli_fetch_array($res1);
	
	
echo '<option value="0"></option>

<optgroup label="'.$ciudad['nom_ciudades'].'">';
    while($mostrar=mysqli_fetch_array($res))
    {
        echo  '<option value="'. $mostrar['idx_rutas'] .'">'.$mostrar['nom_rutas'].'</option>';
    }

	
?>
