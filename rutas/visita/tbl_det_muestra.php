<?php include("../include/conexionPdo.php");
$codigo=$_GET['id'];
echo '<script>$("#codigo").val("'.$codigo.'")</script>';
?>

 
<table class="table table-hover table-condensed">
 
<thead class="text-primary alert-warning">
    <tr>
        <th width="60%">Descripcion del Producto</th>
        <th width="10%">Cant</th>
 
        
         <th width="10%">Seleccionar</th>
    </tr>
</thead>
<tbody>
 <?php 
$sql=$pdo->query("SELECT * FROM  view_tbl_det_muestra where idx_vista='$codigo'");
$cuenta = $sql->rowCount();
if($cuenta > 0){
    $cuenta=0;
    $suma=0;
    $sql=$pdo->query("SELECT * FROM  view_tbl_det_muestra where idx_vista='$codigo'");


  while ($row = $sql->fetch()) {
     $cuenta++;
     ?>
    <tr>
        <td><?=$row['nomp_producto'];?></td>
        <td ><?=$row['cantidad'];?>  </td>
        
        <td>
        <button type="button" class="btn btn-alert  e_producto2" 
        data-id="<?=$row['id_tmp_det'];?>" 
        data-nmuestra="<?=$row['n_muestra'];?>"        >
        <i class="far fa-minus-square"></i></button>

        </td>
    </tr>
 <?php
    $suma=$suma + ($row['cantidad'] );



}
  
?>
</tbody>
<?php

}
else{$suma=0;}
?>
<tfoot>

<tr>
 <th colspan="3"></th>
 <th>Suman</th>
 <th class="suman"><?= $suma ;?></th>
 <th> muestra</th>
</tr>

</tfoot></table>

</table>