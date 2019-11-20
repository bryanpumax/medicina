
<?php
include("../../include/conexion.php");

session_start();
$idx_operador= $_SESSION['idx_operador'];
?>

<table id="dataTable" class="table table-condensed table-bordered table-hover">
    <thead class="text-primary alert-warning">
        <tr>
            <th width="30%">Medico</th>
            <th width="30%">Ruta</th>
         
            <th width="5%">Seleccionar</th>
            
             
        </tr>
    </thead>
<tbody>
<?php
    $inicio=date("Y-m")."-01"  ;
    $fin=date("Y-m")."-31"  ;
$sql="SELECT * from v_medico where idx_operador= $idx_operador";
$res=mysqli_query(conectar(),$sql);
if (mysqli_num_rows(mysqli_query(conectar(), $sql)) > 0) {
    $res = mysqli_query(conectar(), $sql);
while ($row = mysqli_fetch_array($res)) {
?> 
<tr>
    <td><?=$row['Medico']?></td>
    <td><?=$row['Localizacion']?></td>
   
    <td>
    <button type="button" class="btn btn-alert  _medico" data-id="<?=$row['ced_medico']?>" 
    data-nombre="<?=$row['Medico']?>" data-dir="<?=$row['Direccion']?>" data-ciudad="<?=$row['idx_ciudades']?>"
    data-ruta="<?=$row['ruta']?>" data-especialidad="<?=$row['especialidad']?>" ><i class="far fa-check-circle"></i></button>

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


    </div>
<?php include("../../include/clientescript1.php");?>
 <script>
 
 (function() {
 
    $("._medico").click(function(e){
var espe=e.currentTarget.dataset.especialidad
var ruta=e.currentTarget.dataset.ruta
var ciudad=e.currentTarget.dataset.ciudad
var id=e.currentTarget.dataset.id
var dir=e.currentTarget.dataset.dir
var nombre=e.currentTarget.dataset.nombre



$("#idx_especialidades").val(espe);
$("#idx_ciudadesselect").val(ciudad);
$("#cod_visita").val(id);
$("#dir_visita").val(dir);
$("#nom_visita").val(nombre);
     

$.ajax({
type:"post",
url:"ruta_medico.php",
data:{idx_ciudadesselect:ciudad}
}).done(function(data){
    var dato = JSON.parse(data);
 
    var ul = document.getElementById("idx_ruta");
                for (var i in dato) {
                   var item = dato[i].nro

                   var hora=dato[i].ruta
                   $('#idx_ruta').append('<option value='+item+' >'+hora+'</option>');
                        $('#idx_ruta').addClass("color-1")
         }     



    $("#idx_ruta").val(ruta);
   

})

$(".milista").fadeOut()

})

 
 $(".cerrarc").on("click",function(){
  
  
    $(".milista").fadeOut()
 
  });

  $(".cerrarp2").on("click",function(){
        $(".detalle_Producto").fadeOut()
    })
  $("._producto").on("click",function(e){
      
      var id=e.currentTarget.dataset.id
     
      var producto=e.currentTarget.dataset.nombre
      
           
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
  
   
        $.ajax({
            type:"POST",
            dataType:"JSON",
            url:"php/guardar_tmp_muestra.php",
            data: {id:id, nroCoti:nroCoti, producto:producto,cant:cant  },
        })
        .done(function (data){
       $("#n_muestra").val(data) 
       $("#n_muestra2").val(data) 
 
           $("#idproducto").val('')
           $("#producto").val('')
          
           $("#canti").val('')
          
           $(".productos").load('detalle_muestra.php?id='+data)  
        })
   /*      $(".ver_Producto").fadeOut() */
        $(".detalle_Producto").fadeOut()
        $(".ver_muestra").fadeOut()
  
    })
})();
 </script>