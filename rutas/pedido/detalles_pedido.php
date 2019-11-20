<?php

include("../include/conexionPdo.php");
include("../include/head1.php");
$codigo=$_GET['id'];
echo '<script>$("#codigo").val("'.$codigo.'")</script>';
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

    $sql=$pdo->query("SELECT * FROM  v_detalle where idcoti='$codigo'");
    $cuenta = $sql->rowCount();
    if($cuenta > 0){
        $cuenta=0;
        $suma=0;
       $sql=$pdo->query("SELECT * FROM  v_detalle where idcoti='$codigo'");
       $sql1=$pdo->query("SELECT * FROM  tbl_parametros where idcoti='$codigo'");
       $bono=0;
       $sumaiva=0;
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
            <button type="button" class="btn btn-alert  e_producto" data-idcotizacion="<?=$row['idcoti']?>" data-idproducto="<?=$row['idproducto']?>">
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


  </tfoot></table>

<?php

}
?>

    
</table>


 </div>


<script src="js/app.js"></script>

