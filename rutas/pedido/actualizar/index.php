<link rel="stylesheet" href="../../assets/lib/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">

 
 <?php
    include("../../include/conexion.php");
    include("../../include/conexionPdo.php");

    session_start();
 include("../../include/head3.php");
 $idx_perdido=$_GET['idx_perdido'];
 $consulta=$pdo->query("SELECT * FROM v_pedido where idx_perdido='$idx_perdido' ");
 
 while($row=$consulta->fetch()){
 
$cedula=$row['cru_clientes'];
$cliente=$row['Cliente'];
$dir_cliente=$row['dir_clientes'];
$telefono=$row['telf_clientes'];
 
$email=$row['email_clientes'];
$idx_clientes=$row['idx_clientes'];
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    

</head>
<body>
<div class="col-lg-8 col-md-8 col-sm-8 ver_cliente"> </div>

<div class="col-lg-8 col-md-8 col-sm-8 ver_Producto"><?php include("template/tabla_Producto.php");?> </div>




<div class="form-horizontal pedidos" style="margin-top:2em;"> 
    <input type="hidden" id="idx_perdido" value="<?= $idx_perdido; ?>">
            <div class="form-group">
                    <label for="text1" class="control-label col-lg-3 col-md-3 col-sm-3">CEDULA/RUC: </label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        <input type="text"  onchange="validarcedula()" id="cedula" name="cedula" placeholder="CEDULA"   class="form-control" value="<?= $cedula?>"
                       onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"                       >
                       </div>
              <div class="col-lg-2 col-md-2 col-sm-2">
                   <input type="button" id="listar" name="listar" class="btn btn-success "  value="LISTAR">
              </div>
                </div>

            <!-- /.form-group -->
            <div class="form-group ">
                <label for="text1" class="control-label col-lg-2 col-md-2 col-sm-2"> CLIENTE</label>
                <div class="col-lg-10 col-md-10 col-sm-10"><span name="resultado" id="resultado"><?=$cliente;?></span></div>
                </div>
                
            <!-- /.form-group -->
            <div class="form-group infcliente" >
            <label for="direccion" class="control-label col-lg-2 col-md-2 col-sm-2"> DIRECCION</label>
    
            <div class="col-lg-8 col-md-8 col-sm-8">
            <input type="text" name="direccion" id="direccion" value="<?= $dir_cliente;?>" class="form-control" disabled>
            
            </div>
        </div>
        <!-- /.form-group -->
       
        <div class="form-group  infcliente">
        <label for="telef" class="control-label col-lg-2 col-md-2 col-sm-2"> Telefono</label>

        <div class="col-lg-8 col-md-8 col-sm-8">
        <input type="text" name="telef" id="telef" value="<?=$telefono;?>" class="form-control" disabled>
        
        </div>
      
    </div>
    <!-- /.form-group -->
    <div class="form-group infcliente" >
    <label for="mail" class="control-label col-lg-2 col-md-2 col-sm-2"> EMAIL</label>

    <div class="col-lg-8 col-md-8 col-sm-8">
    <input type="text" name="mail" id="mail" value="<?= $email;?>" class="form-control" disabled>
    
    </div>
</div>






<div class="col-md-4 col-md-offset-8">
<button class="btn btn-warning" id="listaProducto">Listar Productos</button>


</div>

<input type="hidden" name="idxc" id="idxc" value="<?= $idx_clientes;?>"class="form-control" >
<input type="hidden" value="<?php echo $_SESSION['idx_operador'];?>"  name="idxv" id="idxv">
 



<div class="col-md-10 col-md-offset-1 productos">

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
        $cuenta=0;
        $suma=0;
       $sql=$pdo->query("SELECT * FROM  view_tbl_det_pedidos where idx_perdido='$idx_perdido'");
       $sql1=$pdo->query("SELECT * FROM  tbl_parametros where idx_perdido='$idx_perdido'");
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

<?php

}else{
    $suma=0;  $bono=0;
    $sumaiva=0;
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
<?php 
}

?>

</table> 



 </div>

</div>


<div class=" col-md-4 col-md-offset-8">
<button class="btn btn-success GuardaPedido"><i class="fas fa-fax"></i>&nbsp;Actualizar Pedido</button>
<!-- 
<button class="btn btn-warning cancelaPedido"><i class="fas fa-fax"></i>&nbsp;Cancelar Pedido</button> -->
<input type="hidden" id="contadordeproductos" class="contadordeproductos"  >
 
 <span  id="resultado78" name="resultado78"></span>
 <input type="hidden" name="codigo" id="codigo">
</div>
    </div><!-- form horizontal-->
    
    <script src="../../assets/lib/jquery/jquery.js"></script>
    
 
    <script src="jquery.dataTables.js"></script>

 
   <script src="js/pedido.js"> </script>
   <script type="text/javascript" src="js/paging.js"></script>
	
   <script type="text/javascript" src="js/jquery_searchtable.js"></script>

   <script type="text/javascript">
            $(document).ready(function() {
                $(function() {
                    theTable = $("#Tab_Filter");
                    $("#Txt_Buscar").keyup(function() {
                        $.uiTableFilter(theTable, this.value);
                    });
                });
            });



        </script>
   
   
  
<script src="js/app.js"></script>
</body>
</html>
<!-- DELIMITER //
CREATE view  view_tbl_det_pedidos as 
SELECT
   tbl_det_pedido. `idx_det_pedido`,
    tbl_det_pedido.`idx_perdido`,
    tbl_det_pedido.`idx_producto`,
    tbl_det_pedido.`cant_det_pedido` as 'cantidad',
    tbl_det_pedido.`pre_det_pedido` as 'precio',
    tbl_det_pedido.`pro_det_pedido` as 'promocion',
    tbl_det_pedido.`iva_det_pedido` as 'iva',
    tbl_det_pedido.`subt_det_pedido`,
    tbl_inventario.nomp_producto as 'nomp_producto'
FROM
    `tbl_det_pedido` INNER JOIN tbl_inventario on tbl_det_pedido.idx_producto=tbl_inventario.idx_producto
    // DELIMITER ; -->