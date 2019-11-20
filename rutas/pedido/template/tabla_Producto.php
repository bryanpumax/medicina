<style>
.detalle_Producto  {
 position:absolute!important;
top:.2em;
left:10%;
background:#fff;
border:1px solid #000;
padding:.6em;
z-index:9999;
display:none;
background:#faebcc;
font-size: 9px!important;
}



}
</style>
<!-- <link rel="stylesheet" href="../../assets/lib/bootstrap/css/bootstrap.min.css"> -->

<?php
//include("../include/conexion.php");
?>

<table id="dataTable" class=" table table-condensed table-bordered table-hover">
    <thead class="text-primary alert-warning">
        <tr>
            <th width="75%">Descripcion del Producto</th>
            <th width="10%">Valor</th>
            <th width="10%">Promo</th>
             <th width="5%">Seleccionar</th>
        </tr>
    </thead>
<tbody>
<?php

$sql = "SELECT * FROM tbl_inventario ORDER BY prec_producto ASC ;";
$res=mysqli_query(conectar(),$sql);
if (mysqli_num_rows(mysqli_query(conectar(), $sql)) > 0) {
    $res = mysqli_query(conectar(), $sql);
while ($row = mysqli_fetch_array($res)) {
?> 
<tr class="odd gradeX">
    <td><?=$row['nomp_producto']?></td>
    <td><?=$row['prec_producto']?></td>
    <td><?=$row['promo_producto']?></td>
    <td>
    <button type="button" class="btn btn-alert  _producto" data-id="<?=$row['idx_producto']?>" 
    data-nombre="<?=$row['nomp_producto']?>"  data-precio="<?=$row['prec_producto']?>" data-promo="<?=$row['promo_producto']?>"
    data-iva="<?=$row['iva_producto']?>"
    ><i class="far fa-check-circle"></i></button>

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
<button class="btn btn-danger pull-right cerrarp1">Cancelar</button>
<div class=" col-md-10 form-horizontal  detalle_Producto ">
<input type="hidden" id="idproducto">

<div class="col-md-12  ">

        <div class="form-group">
		<label class="col-md-4  control-label pull-left" for="producto">Descripción del Producto</label>
        <div class="col-md-8">                
        <input type="text" class="form-control"  id="producto" name="producto" placeholder="Descripcion del producto">
        </div>
        </div>
</div>
 <div class="col-md-4  ">

        <div class="form-group">
        <label class="col-sm-2 control-label" for="producto">Valor</label>
            <div class="col-sm-10">                      
            <input type="text"   id="precio" name="precio" placeholder="Valor del producto"   class="form-control"> 
            </div>        
        </div>
</div>       
<div class="col-md-4  ">
 
<div class="form-group">
               <label class="col-sm-2 control-label" for="producto">Cant</label>
          <div class="col-sm-10">                      
              <input type="text"   id="canti" name="canti" placeholder="Cantidad  del producto"   class="form-control"> 
          </div>
        </div>
</div>
<div class="col-md-4  ">

        <div class="form-group">
              <label class="col-sm-4 control-label" for="producto">Bonificacion</label>
                     <div class="col-sm-8">                      
                            <input type="text"   id="promo" name="promo" placeholder="Cant Promocional"   class="form-control"> 
                        </div>
        </div>
 </div>

                    <input type="hidden"   id="iva" name="iva"     class="form-control"> 
 <div class="col-md-6 pull-right">
<button type="button" class="btn btn-primary" id="productoGuarda">Aceptar</button>
<button type="button" class="btn btn-danger cerrarp2">Cancelar</button>

 </div>


    </div>

    <?php include("../include/clientescript1.php");?>
<script src="js/app.js"></script>


<script>
$("#canti").on("click",function(e){
    $("#canti").val('');
})


</script>