<?php

include("../../include/conexion.php");
include("../../include/conexionPdo.php");

session_start();
include("../../include/head3.php");
$idx_perdido=$_GET['id'];

?>
<table class="table table-hover table-condensed">
 
 <thead class="text-primary alert-warning">
     <tr>
         <th width="60%">Descripcion del Producto</th>
         <th width="10%">Cant</th>
         <th width="10%">Valor</th>
         <th width="10%">Promo</th>
         <th width="10%">Iva</th>
         
          <th width="10%">Seleccionar</th>
     </tr>
 </thead>
<tbody>
<?php

 $sql=$pdo->query("SELECT * FROM  view_tbl_det_pedidos where idx_perdido='$idx_perdido'");
 $cuenta = $sql->rowCount();  

 if($cuenta > 0){
  $suma=0;  $bono=0;
  $sumaiva=0;
     $cuenta=0;

    $sql=$pdo->query("SELECT * FROM  view_tbl_det_pedidos where idx_perdido='$idx_perdido'");
    $sql1=$pdo->query("SELECT * FROM  tbl_parametros where idx_perdido='$idx_perdido'");
  
   while ($row = $sql->fetch()) {
      $cuenta++;
          ?> 
     <tr>
         <td><?=$row['nomp_producto']?></td>
         <td ><?=$row['cantidad']?>  </td>
         <td><?=$row['precio']?></td>
         <td><?=$row['promocion']?></td>
         <td><?=$row['iva']?></td>
         
         <td>
         <button type="button" class="btn btn-alert  e_producto" data-idx_perdido="<?=$row['idx_perdido']?>" data-idproducto="<?=$row['idx_producto']?>">
         <i class="far fa-minus-square"></i></button>

         </td>
     </tr>



     <?php
     $suma=$suma + (($row['cantidad'] + $row['promocion']) * $row['precio']);
$bono=$bono +($row['promocion']*$row['precio']);
$sumaiva=$sumaiva +  $row['iva'];       

}
     ?>
</tbody>


<?php

}else{    $suma=0;  $bono=0;
  $sumaiva=0;}
?>
<tfoot>

<tr>
  <th colspan="3"></th>
  <th>Suman</th>
  <th class="suman">$<?= $suma ?></th>
</tr>

<tr>
<th colspan="3"></th>
  <th >Iva 12%</th>
   <th class="ivadoce">$<?= $sumaiva ?></th>
</tr>
<tr>
<th colspan="3"></th>
  <th>Iva 0%</th>
   <th class="ivacero">$0.00</th>
</tr>
<th colspan="3"></th>
  <th>Bonificacion</th>
   <th class="bono">$<?= $bono?></th>
</tr>

<tr>
<th colspan="3"></th>
  <th>Total</th>
   <th class="total">$<?= ($suma - $bono) ?></th>
</tr>


</tfoot>
 

</table>

 </div>


<script src="js/app.js"></script>

