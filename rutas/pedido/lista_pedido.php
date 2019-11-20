<?php
include("../include/conexionPdo.php"); 
$idx_operador= $_SESSION['idx_operador'];
$rol=$_SESSION['rol_operador'];
if($rol==1){
?>
    <div class="col-xs-6">
    <span class=" text-danger" for="Txt_Buscar">
        <img src="../assets/img/buscar.png" width="20" height="20" />&nbsp;BUSCAR:</span>
    <input class="form-control " type="text" id="Txt_Buscar" name="Txt_Buscar" 
        placeholder="Escriba el Número de Pedido o Cliente a  buscar"  />
    </div>

<table id="Tab_Filter" class="table table-striped table-hover table-bordered">
<caption class="h5 text-center alert-warning">LISTA DE PEDIDOS REALIZDOS</caption>
<thead>
    <th>Nro</th>
    <th>Cliente</th>
    <th>Fecha</th>
    <th>Accion</th>
</thead>

<tbody>
<?php
$consulta=$pdo->query("SELECT * FROM v_pedido where idx_operador='$idx_operador'");
while($row=$consulta->fetch()){
?>

    <tr>
        <td><?= $row['idx_perdido'];?></td>
        <td><?= $row['Cliente'];?></td>
        <td><?= $row['fech_perdido'];?></td>
        <td> <button class="btn btn-primary imprimeIndividual" data-id="<?=$row['idx_perdido']; ?>"><i class="fas fa-print"></i></button>           
   <button class="btn btn-danger eliminar" data-id="<?=$row['idx_perdido']; ?>"><i class="fas fa-trash"></i></button>         
   </button>           
        
<a href="actualizar/index.php?idx_perdido=<?=$row['idx_perdido']; ?>">
<button class="btn btn-success" ><i class="fas fa-pen"></i></button>  
</a>
</td>
    </tr>
  <?php
  }
  ?>  
</tbody>



</table>

<div  style="display:inline-block; background:#d9edf7; color:#000; border:1px solid #ccc; margin:3px; padding-left:5px; padding-right:5px;" id="NavPosicion_b"></div>
<?php
}else{
?>
  <div class="col-xs-6">
    <span class=" text-danger" for="Txt_Buscar">
        <img src="../assets/img/buscar.png" width="20" height="20" />&nbsp;BUSCAR:</span>
    <input class="form-control " type="text" id="Txt_Buscar" name="Txt_Buscar" 
        placeholder="Escriba el Número de Pedido o Cliente a  buscar"  />
    </div>

<table id="Tab_Filter" class="table table-striped table-hover table-bordered">
<caption class="h5 text-center alert-warning">LISTA DE PEDIDOS REALIZDOS</caption>
<thead>
    <th>Nro</th>
    <th>Cliente</th>
    <th>Operador</th>
    <th>Fecha</th>
    <th>Accion</th>
</thead>

<tbody>
<?php
$consulta=$pdo->query("SELECT * FROM v_pedido inner join view_operador on v_pedido.idx_operador=view_operador.idx_operador  ");
while($row=$consulta->fetch()){
?>

    <tr>
        <td><?= $row['idx_perdido'];?></td>
        <td><?= $row['Cliente'];?></td>
        <td><?= $row['operador'];?></td>
        <td><?= $row['fech_perdido'];?></td>
        <td> <button class="btn btn-primary imprimeIndividual" data-id="<?=$row['idx_perdido']; ?>"><i class="fas fa-print"></i></button>           
   <button class="btn btn-danger eliminar" data-id="<?=$row['idx_perdido']; ?>"><i class="fas fa-trash"></i></button>         
   </button>           
        
<a href="actualizar/index.php?idx_perdido=<?=$row['idx_perdido']; ?>">
<button class="btn btn-success" ><i class="fas fa-pen"></i></button>  
</a>
</td>
    </tr>
  <?php
  }
  ?>  
</tbody>



</table>

<div  style="display:inline-block; background:#d9edf7; color:#000; border:1px solid #ccc; margin:3px; padding-left:5px; padding-right:5px;" id="NavPosicion_b"></div>

<?php
}

?>
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


   <script type="text/javascript">
var pager = new Pager('Tab_Filter', 8);
pager.init();
pager.showPageNav('pager', 'NavPosicion_b');
pager.showPage(1);
</script>

<script>
$(function() {


$(".imprimeIndividual").click(function(e) {
  num=e.currentTarget.dataset.id
  location.href = "../imprimir/crearPdf.php?gettis=imprimir&idx_perdido="+num;

});


$(".eliminar").click(function(e) {
  num=e.currentTarget.dataset.id
  location.href = "php/eliminarpps.php?idx_perdido="+num;
 
});


});

</script>