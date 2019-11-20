
<?php
include("../../include/conexion.php");
session_start();
$idx_operador= $_SESSION['idx_operador'];
?>

<table id="dataTable" class="table table-condensed table-bordered table-hover">
    <thead class="text-primary alert-warning">
        <tr>
            <th width="30%">MUESTRAS</th>
     
            
             
        </tr>
    </thead>
<tbody>
<?php
    $inicio=date("Y-m")."-01"  ;
    $fin=date("Y-m")."-31"  ;
$sql="SELECT * from view_muestra  where fecha_muestra>='".$inicio."' and fecha_muestra<='".$fin."' and idx_operador=$idx_operador ";
$res=mysqli_query(conectar(),$sql);
if (mysqli_num_rows(mysqli_query(conectar(), $sql)) > 0) {
    $res = mysqli_query(conectar(), $sql);
while ($row = mysqli_fetch_array($res)) {
?> 
<tr>
    <td><?=$row['nomp_producto']?></td>
    
  
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

 


<script>
 (function() {
 
 $(".cerrarc").on("click",function(){
    $(".tbl_producto").show();
 
   $(".ver_muestra").hide()
 
 });
 
})();
 </script>