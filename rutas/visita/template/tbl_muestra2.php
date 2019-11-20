
<?php
include("../../include/conexion.php");
?>

<table id="dataTable" class="table table-condensed table-bordered table-hover">
    <thead class="text-primary alert-warning">
        <tr>
            <th width="30%">MUESTRAS</th>
            <th width="5%">Seleccionar</th>
            
             
        </tr>
    </thead>
<tbody>
<?php
    $inicio=date("Y-m")."-01"  ;
    $fin=date("Y-m")."-31"  ;
$sql="SELECT * from view_muestra  where fecha_muestra>='".$inicio."' and fecha_muestra<='".$fin."' ";
$res=mysqli_query(conectar(),$sql);
if (mysqli_num_rows(mysqli_query(conectar(), $sql)) > 0) {
    $res = mysqli_query(conectar(), $sql);
while ($row = mysqli_fetch_array($res)) {
?> 
<tr>
    <td><?=$row['nomp_producto']?></td>
    <td>
    <button type="button" class="btn btn-alert  _producto" data-id="<?=$row['idx_muestra']?>" 
    data-nombre="<?=$row['nomp_producto']?>"  
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
<button class="btn btn-danger pull-right cerrarc">Cancelar</button>
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
               <label class="col-sm-2 control-label" for="producto">Cant</label>
          <div class="col-sm-10">                      
              <input type="number" min="1" max="10" maxlength="2" id="canti" name="canti" placeholder="0"   class="form-control"> 
          </div>
        </div>
</div>
 

      <input type="hidden" class="n_muestra3">               
      <input type="hidden" class="idx_visita">     
 <div class="col-md-4 col-md-offset-8">
<button type="button" class="btn btn-primary" id="productoGuarda">Aceptar</button>
<button type="button" class="btn btn-danger cerrarp2">Cancelar</button>

 </div>


    </div>
<?php include("../../include/clientescript1.php");?>
 <script>
 
 (function() {
 
 
 $(".cerrarc").on("click",function(){
  
  
    $(".ver_muestra").hide()
  
  });
  $(".cerrarp2").on("click",function(){
        $(".detalle_Producto").fadeOut()
    })
  $("._producto").on("click",function(e){
      
      var id=e.currentTarget.dataset.id
     
      var producto=e.currentTarget.dataset.nombre
      var n_muestra=  $("#n_muestra3").val();
       $(".n_muestra3").val(n_muestra);
       var idx_visita = $("#idx_visita").val();
       $(".idx_visita").val(idx_visita); 
        $("#idproducto").val(id)
        $("#producto").val(producto)
       
        $("#canti").val('')
        $("#canti").focus()
        $(".detalle_Producto").fadeIn()
   })
  
 
 
   $("#productoGuarda").on("click",function(){
        
        var nroCoti=$("#n_muestra").val()
        var id=$("#idproducto").val()
        var producto = $("#producto").val()
         
        var cant = $("#canti").val()
        var n_muestra3=  $(".n_muestra3").val();
        var idx_visita = $(".idx_visita").val();
   
        $.ajax({
            type:"POST",
            dataType:"JSON",
            url:"php/guardar_tbl_det_muestra_tmp.php",
            data: {id:id, nroCoti:nroCoti, producto:producto,cant:cant,idx_visita:idx_visita ,n_muestra3:n_muestra3 },
        })
        .done(function (data){
     /*   $("#n_muestra").val(data) 
       $("#n_muestra2").val(data) */
 
           $("#idproducto").val('')
           $("#producto").val('')
          
           $("#canti").val('')
          
           $(".productos").load('tbl_det_muestra.php?id='+data)   
           
        })
   /*      $(".ver_Producto").fadeOut() */
        $(".detalle_Producto").fadeOut()
        $(".ver_muestra").fadeOut()
  
    })
})();
 </script>