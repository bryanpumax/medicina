<?php
include("../../include/conexion.php");

session_start();
$idx_operador= $_SESSION['idx_operador'];
?>

<table id="dataTable" class="table table-condensed table-bordered table-hover">
    <thead class="text-primary alert-warning">
        <tr>
            <th width="10%">Cedula</th>
            <th width="50%">Cliente</th>
            <th width="10%">Farmacia</th>
            
             <th width="10%">Selecciionar</th>
        </tr>
    </thead>
<tbody>
<?php

$sql="SELECT * from tbl_clientes where idx_operador=$idx_operador" ;
$res=mysqli_query(conectar(),$sql);
if (mysqli_num_rows(mysqli_query(conectar(), $sql)) > 0) {
    $res = mysqli_query(conectar(), $sql);
while ($row = mysqli_fetch_array($res)) {
?> 
<tr>
    <td><?=$row['cru_clientes']?></td>
    <td><?=$row['nom_clientes']?><?=' '?><?=$row['ape_clientes']?></td>
    <td><?=$row['emp_clientes']?></td>
    <td>
    <button type="button" class="btn btn-alert  _cliente" data-id="<?=$row['cru_clientes']?>" 
    data-idx="<?=$row['idx_clientes']?>" 
    data-nombre="<?=$row['nom_clientes'].' '.$row['ape_clientes']?>" data-dir="<?=$row['dir_clientes']?>" data-telf="<?=$row['telf_clientes']?>"  data-cel="<?=$row['cel_clientes']?>"  data-correo="<?=$row['email_clientes']?>"><i class="far fa-check-circle"></i></button>

    </td>
</tr>


<?php
}
?>
</tbody>

<?php

}
?>

    
</table>
<button class="btn btn-danger pull-right cerrarc">Cancelar</button>
<?php include("../../include/clientescript1.php");?>

<script src="js/app.js"></script>


