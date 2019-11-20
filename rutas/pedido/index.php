<link rel="stylesheet" href="../assets/lib/bootstrap/css/bootstrap.min.css">



<style>
.tabla_cliente{position:absolute;
top:1px;
}


.ver_cliente{
position:absolute!important;
top:2em;
left:10%;
background:#fff;
border:1px solid #000;
padding:.2em;
display:none;
z-index:9999;
}



.ver_Producto{
display:none;
position:absolute!important;
top:2em;
left:10%;
background:#fff;
border:1px solid #000;
padding:.2em;
z-index:9999;
}

</style>
 <?php
    include("../include/conexion.php");
    include("../include/conexionPdo.php");
 
    session_start();
    $idx_operador= $_SESSION['idx_operador'];
 include("../include/head1.php");
 

 
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


<div class=" col-md-2 col-md-offset-10 bnuevo"  style="margin-top:2em">
        <button class="btn btn-primary Pedido"><i class="fas fa-fax"></i>&nbsp;Nuevo Pedido</button>
    </div>

<div class="col-md-10 col-md-offset-1 milistaPedido" style="margin-top:2em;">

 <?php include("lista_pedido.php");?>
</div>

<div class="form-horizontal pedidos" style=" display:none;margin-top:2em;"> 
    <input type="hidden" id="nroCoti" value="0">
            <div class="form-group">
                    <label for="text1" class="control-label col-lg-3 col-md-3 col-sm-3">CEDULA/RUC: </label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        <input type="text"  onchange="validarcedula()" id="cedula" name="cedula" placeholder="CEDULA"   class="form-control"
                       onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"                       >
                       </div>
              <div class="col-lg-2 col-md-2 col-sm-2">
                   <input type="button" id="listar" name="listar" class="btn btn-success "  value="LISTAR">
              </div>
                </div>

            <!-- /.form-group -->
            <div class="form-group infcliente">
                <label for="text1" class="control-label col-lg-2 col-md-2 col-sm-2"> CLIENTE</label>
                <div class="col-lg-10 col-md-10 col-sm-10"><span name="resultado" id="resultado"></span></div>
                </div>
                
            <!-- /.form-group -->
            <div class="form-group infcliente" >
            <label for="direccion" class="control-label col-lg-2 col-md-2 col-sm-2"> DIRECCION</label>
    
            <div class="col-lg-8 col-md-8 col-sm-8">
            <input type="text" name="direccion" id="direccion"  class="form-control" disabled>
            
            </div>
        </div>
        <!-- /.form-group -->
       
        <div class="form-group  infcliente">
        <label for="telef" class="control-label col-lg-2 col-md-2 col-sm-2"> Telefono</label>

        <div class="col-lg-3 col-md-3 col-sm-3">
        <input type="text" name="telef" id="telef"  class="form-control" disabled>
        
        </div>
        <label for="cel" class="control-label col-lg-2 col-md-2 col-sm-2"> Celular</label>
        <div class="col-lg-3 col-md-3 col-sm-3">
        <input type="text" name="cel" id="cel"  class="form-control" disabled>
        
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group infcliente" >
    <label for="mail" class="control-label col-lg-2 col-md-2 col-sm-2"> EMAIL</label>

    <div class="col-lg-8 col-md-8 col-sm-8">
    <input type="text" name="mail" id="mail"  class="form-control" disabled>
    
    </div>
</div>






<div class="col-md-4 col-md-offset-8">
<button class="btn btn-warning" id="listaProducto">Listar Productos</button>
<button class="btn btn-info" onclick="myFunction();"><span class="glyphicon glyphicon-print"></span> Cotizar </button>

</div>

<input type="hidden" name="idxc" id="idxc"  class="form-control" disabled>
<input type="hidden" value="<?php echo $_SESSION['idx_operador'];?>"  name="idxv" id="idxv">
 



<div class="col-md-10 col-md-offset-1 productos">

<table class="table table-hover table-condensed">
    <thead>
      
        <th>Descripcion del Producto</th>
        <th>Cant</th>
        <th>Promo</th>
        <th>Valor</th>
    </thead>
<tbody>
    <tr id="detallesProducto">
     
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
</tbody>
<tfoot>

<tr>
     <th colspan="3"></th>
     <th>Suman</th>
     <th class="suman">$0,0.00</th>
</tr>

<tr>
<th colspan="3"></th>
     <th>Iva 12%</th>
      <th class="ivadoce">$0,00</th>
</tr>
<tr>
<th colspan="3"></th>
     <th>Iva 0%</th>
      <th class="ivacero">$0.00</th>
</tr>
<tr>
<th colspan="3"></th>
     <th>Bonificacion</th>
      <th class="bono">$0.00</th>
</tr>

<tr>
<th colspan="3"></th>
     <th class="total">Total</th>
      <th>$0,000.00</th>
</tr>


  </tfoot></table>


</div>


<div class=" col-md-4 col-md-offset-8">
<button class="btn btn-success GuardaPedido"><i class="fas fa-fax"></i>&nbsp;Guardar Pedido</button>

<button class="btn btn-warning cancelaPedido"><i class="fas fa-fax"></i>&nbsp;Cancelar Pedido</button>
<input type="hidden" id="contadordeproductos" class="contadordeproductos"  >
 
 <span  id="resultado78" name="resultado78"></span>
 <input type="hidden" name="codigo" id="codigo">
</div>
    </div><!-- form horizontal-->
    <script src="../assets/lib/jquery/jquery.js"> </script>
    
 
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
   
   
   <script type="text/javascript">
var pager = new Pager('Tab_Filter', 8);
pager.init();
pager.showPageNav('pager', 'NavPosicion_b');
pager.showPage(1);
</script>

</body>
</html>


<!--onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"-->