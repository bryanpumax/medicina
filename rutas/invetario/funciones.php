<script src="validar.js"></script>
<?php

include("../include/conexion.php");
function mensaje($m)
{

    switch ($m) {
            /* para  eliminar */
        case 1:

            $eli = '<body onload="prohibido();"></body>';
            break;
        case 2:
            $eli = '<body onload="eliminar();"></body>';
            break;
        case 3:
            $eli = '<body onload="error();"></body>';
            break;
            //registro
        case 4:
            $eli = '<body onload="existencia();"></body> ';

            break;
        case 5:
            $eli = '<body onload="correctamente();"></body>';

            break;
        case 6:
            $eli = '<body onload="actualizar();"></body>';

            break;
            case 7:
            $eli = '<body onload="parrilla();"></body>';

            break;
            case 8:
            $eli = '<body onload="parrilla_0();"></body>';

            break;
    }


    return $eli;
}
function formulario($id)
{

    if (isset($id)) {

        $sql = "SELECT * FROM tbl_inventario where  idx_producto=   $id  ;";
        $res = mysqli_query(conectar(), $sql);
        $tbl_inventario = mysqli_fetch_array($res);
        
        $sql1 = "SELECT * FROM  tbl_tipo ;";
        $res1 = mysqli_query(conectar(), $sql1);
        $idxt=$tbl_inventario['idx_tipo'];
        $sql2 = "SELECT * FROM  tbl_tipo where idx_tipo=  $idxt;";
        $res2 = mysqli_query(conectar(), $sql2);
        $tbltipo = mysqli_fetch_array($res2);
        $nom=$tbltipo['desc_tipo'];
        $fmiva="";
        if($tbl_inventario['iva_producto']==0){
            $fmiva="NO";
        }
        else {
            $fmiva="Si";
        }
    } else {
        $tbl_inventario['idx_producto'] = null;
        $tbl_inventario['nomp_producto'] = null;
        $tbl_inventario['prec_producto'] = null;
        $tbl_inventario['img_producto'] = 'foto.jpg';
        $tbl_inventario['iva_producto'] = 3;
        $fmiva="";
        $tbl_inventario['idx_tipo'] =0;
        $nom="";
        $tbl_inventario['promo_producto'] = null;
        $tbl_inventario['caract_inventario'] = null;


        $sql1 = "SELECT * FROM  tbl_tipo ;";
        $res1 = mysqli_query(conectar(), $sql1);
    }

    $cont = ' 
    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header class="col-lg-12 col-md-12 col-sm-12">
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario Producto</h5>
           
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal" enctype="multipart/form-data" name="tbl_inventario" action="" method="POST"  onSubmit="return valida(this);"> 
 
                <div class="form-group">
                    <label for="pass1" class="control-label col-lg-2 col-md-2 col-sm-2">Producto</label>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input class="form-control" type="text" id="nomp_producto"  name="nomp_producto"  placeholder="Producto"
                        onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                        value="' .  $tbl_inventario['nomp_producto'] . '"     data-original-title="Please use your secure password" data-placement="top" >
                    </div>
                    <label for="pass1" class="control-label col-lg-2 col-md-2 col-sm-2">Precio</label>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                    <input class="form-control" type="text" id="prec_producto" name="prec_producto"   placeholder="Precio"
                    onkeypress="return decimales(event,this);"  onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                    value="' .  $tbl_inventario['prec_producto'] . '"     data-original-title="Please use your secure password" data-placement="top" >
                </div>
          
<!-- /.form-group -->  

<div class="form-group">
<label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4"></label>
<div class="col-lg-8 col-md-8 col-sm-8">
</div>
</div>
<!-- /.form-group -->

            <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4 ">Seleccion categoria</label>
            
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <select data-placeholder="Your Favorite Football Team"   class="form-control chzn-select mayuscula" tabindex="5" name="idx_tipo" id="idx_tipo">
                        <option value="'.$tbl_inventario['idx_tipo'] .'"> '.$nom.'</option>';
    while ($tipo = mysqli_fetch_array($res1)) {
        $cont .= '<option value="' . $tipo['idx_tipo'] . '">' . TildesHtml($tipo['desc_tipo']) . '</option>';
    }

    $cont .= '  </select>
                </div>
                <label for="pass1" class="control-label col-lg-1 col-md-1 col-sm-1">Iva</label>
                <div class="col-lg-2 col-md-2 col-sm-2">
                <select data-placeholder="Your Favorite Football Team"   class="max-width form-control chzn-select mayuscula" tabindex="5" name="iva_producto" id="iva_producto">
                <option value="'.$tbl_inventario['iva_producto'].'">'.$fmiva.' </option>
                <option value="0">No</option>
                <option value="1">Si</option></select>
             
            </div>
            <div class="form-group">
<label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4"></label>
<div class="col-lg-8 col-md-8 col-sm-8">
</div>
</div>
<!-- /.form-group -->
            <div class="form-group">
            <label class="control-label col-lg-4 col-md-4 col-sm-4  ">Presentacion del producto</label>
            <div class="col-lg-7 col-md-7 col-sm-7">
                <div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
      <img       data-src="holder.js/100%x100%"  src="../assets/imagen/producto/' .  $tbl_inventario['img_producto'] . '"      alt="...">
 
      </div>
    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
    </div>
    <div>
      <span class="btn btn-default btn-file">
      <span class="fileinput-new">Select image</span>
      <span class="fileinput-exists">Change</span>
      <input type="file" name="img_producto" id="img_producto"></span>
      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
    </div>
      </div>

            </div>
        </div>



        <div class="form-group">
            <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">bonificacion</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input class="form-control" type="text" id="promo_producto" name="promo_producto"   placeholder="Bonificacion"
                onkeypress="return numeros(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                value="' .  $tbl_inventario['promo_producto'] . '"     data-original-title="Please use your secure password" data-placement="top" >
            </div>
        </div>
        <!-- /.form-group -->
   
        
 
        <div class="form-group">
        <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Caracteristicas</label>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <input class="form-control" type="text" id="caract_inventario" name="caract_inventario"   placeholder="Caracteristica"
            onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
            value="' .  $tbl_inventario['caract_inventario'] . '"     data-original-title="Please use your secure password" data-placement="top" >
        </div>
    </div>
  
    <!-- /.form-group -->
<div class="form-actions  ">
<input type="hidden" name="idx_producto" id="idx_producto"  value="' .  $tbl_inventario['idx_producto'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}



function elimina_tbl_inventario($id)
{

    $sql = "call p_e_inventario(" . $id . ");";
    $sqlval = "SELECT * from tbl_det_pedido ,tbl_inventario   where tbl_det_pedido.idx_producto=tbl_inventario.idx_producto 
    and tbl_inventario.idx_producto=" . $id . "";
    if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
        echo mensaje("1");
        $_GET['gettis'] = null;
    } else {

        $sql2 = "SELECT * FROM tbl_inventario where  idx_producto=   $id  ;";
        $res = mysqli_query(conectar(), $sql2);
        $tbl_inventario = mysqli_fetch_array($res);
        if (mysqli_query(conectar(), $sql)) {
            if($tbl_inventario['img_producto']!='foto.jpg'){
            unlink("../assets/imagen/producto/".$tbl_inventario['img_producto']."");}
            
            echo mensaje('2'); $_GET['gettis'] = null;
            echo '<script>window.location="index.php";</script>';     
            
        } else {
            echo mensaje('3');
            $_GET['gettis'] = null;       echo '<script>window.location="index.php";</script>';  
        }
    }
    //
}
//tbl_inventario
function registro($tbl_inventario)
{

    $nomp_producto = TildesHtml(limpiar_cadena($tbl_inventario['nomp_producto']));
    $idx_tipo = (limpiar_cadena_coma_punto($tbl_inventario['idx_tipo']));
    $prec_producto = (limpiar_cadena_coma_punto($tbl_inventario['prec_producto']));
    $iva_producto = TildesHtml(limpiar_cadena($tbl_inventario['iva_producto']));
    $promo_producto = TildesHtml(limpiar_cadena_email($tbl_inventario['promo_producto']));
    $caract_inventario = TildesHtml(limpiar_cadena_email($tbl_inventario['caract_inventario']));
    
    $formatos   = array('.jpg');
	$directorio = '../assets/imagen/producto/'; 
        $nombreArchivo    = $_FILES['img_producto']['name'];
        $nombreTmpArchivo = $_FILES['img_producto']['tmp_name'];
        $ext              = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
      if($nombreArchivo===''){
        $img_producto = 'foto.jpg' ;    
      } 
      else{
      
        $img_producto = $nomp_producto .'.jpg' ;
      }
        
          //codigo de actualización 
          $sqlval = "select * from tbl_inventario where tbl_inventario.nomp_producto='".$nomp_producto."' and tbl_inventario.idx_tipo=". $idx_tipo.";";
        
   
    if ($tbl_inventario['idx_producto']   != null) {
      if (in_array($ext, $formatos)){
                if (move_uploaded_file($nombreTmpArchivo, "$directorio/$img_producto")){
                  
                    echo "<script>
                    alertify.success('LA IMAGEN   FUE ALMACENADA CORRECTAMENTE'); 
                     </script>";
                }else{
                    
                    echo "<script>
                    alertify.error('OCURRIÓ UN ERROR SUBIENDO EL ARCHIVO  AL  SERVIDOR'); 
                     
                    </script>";
                }
            }else{
                echo '';
            }
        $sql = "UPDATE tbl_inventario 
		SET 
      
        nomp_producto = '" . $nomp_producto . "',
        prec_producto = '" . $prec_producto . "',
        img_producto = '" . $img_producto . "',
        iva_producto='" . $iva_producto . "',
         promo_producto='" . $promo_producto . "',
         caract_inventario='" . $caract_inventario . "',
         idx_tipo=" . $idx_tipo . "
		 WHERE idx_producto = " . $tbl_inventario['idx_producto']  . " ";



        if (mysqli_query(conectar(), $sql)) {
echo mensaje("6");
$_GET['gettis']=null;

        } else {
echo mensaje("3");

$_GET['gettis']=null;
        }
    } else {
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
            echo mensaje("4");
        } else {
        $sql1 = "call  p_i_invetario('" . $nomp_producto . "', " . $idx_tipo . "," .
            $prec_producto . ",'" . $img_producto . "'," .
            $iva_producto  . ", " . $promo_producto  . ",'" . $caract_inventario . "');";

            if (in_array($ext, $formatos)){
                if (move_uploaded_file($nombreTmpArchivo, "$directorio/$img_producto")){
                    echo "<script>
                    alertify.success('LA IMAGEN   FUE ALMACENADA CORRECTAMENTE'); 
                     </script>";
                }else{
                    
                    echo "<script>
                    alertify.error('OCURRIÓ UN ERROR SUBIENDO EL ARCHIVO  AL  SERVIDOR'); 
                     
                    </script>";
                }
            }else{echo '';}
            if (mysqli_query(conectar(), $sql1)) {
                echo mensaje("5");
          $_GET['gettis']=null;
        } else {
         
            echo mensaje("3");$_GET['gettis']=null;
        }
    }
 
}
}
function parrilla($id,$nm){
    $idx_operador= $_SESSION['idx_operador'];
    $inicio=date("Y-m")."-01"  ;
    $fin=date("Y-m")."-31"  ;
    $hoy=date("Y-m-d");
    if( $hoy>$fin)
    {
    $cont =$nm+1  ; 
        
        $sql="UPDATE tbl_inventario  SET fecha_parrilla=curdate() WHERE idx_producto = " .$id. "";
        $sql2="UPDATE tbl_parametros set cont_muestra=".$cont." where idx=1";
        $sql3 = "INSERT INTO tbl_muestra values(null,".$id.",curdate(),".$cont.",$idx_operador);";
        if (mysqli_query(conectar(), $sql)) {
            if (mysqli_query(conectar(), $sql2)) {
                if (mysqli_query(conectar(), $sql3)) {
                    echo mensaje("7"); echo '<script>window.location="index.php";</script>';  $_GET['gettis']=null; 
                }
            }
        }
        else 
        { 
            echo mensaje("3"); echo '<script>window.location="index.php";</script>';$_GET['gettis']=null;   
        }
    }

    
    if( $hoy>=$inicio and $hoy<=$fin)
    {
    
        
        $sql="UPDATE tbl_inventario  SET fecha_parrilla=curdate() WHERE idx_producto = " .$id. "";
        
        $sql3 = "INSERT INTO tbl_muestra values(null,".$id.",curdate(),".$nm.",$idx_operador);";
        if (mysqli_query(conectar(), $sql)) {
          
                if (mysqli_query(conectar(), $sql3)) {
                    echo mensaje("7"); echo '<script>window.location="index.php";</script>';  $_GET['gettis']=null; 
                }
           
        }
        else 
        { 
            echo mensaje("3"); echo '<script>window.location="index.php";</script>';$_GET['gettis']=null;   
        }
    }  
}
function parrilla_0($id){
    $idx_operador= $_SESSION['idx_operador'];
    $inicio=date("Y-m")."-01"  ;
    $fin=date("Y-m")."-31"  ;
    $sql = "UPDATE tbl_inventario  
    SET fecha_parrilla='' WHERE idx_producto = " .$id. " ";
     $sql2="DELETE from tbl_muestra where fecha_muestra>='".$inicio."' and fecha_muestra<='".$fin."' and idx_producto=".$id." and idx_operador=$idx_operador";
  if (mysqli_query(conectar(), $sql)) {
    if (mysqli_query(conectar(), $sql2)) {

    echo mensaje("8");$_GET['gettis']=null;     echo '<script>window.location="index.php";</script>';
}}
     else 
    {echo mensaje("3");$_GET['gettis']=null;echo '<script>window.location="index.php";</script>';   }
       
}
function parrilla_all(){
    $idx_operador= $_SESSION['idx_operador'];
    $inicio=date("Y-m")."-01"  ;
    $fin=date("Y-m")."-31"  ;
    $sql = "UPDATE tbl_inventario  SET fecha_parrilla='' ";
     $sql2="DELETE from tbl_muestra where fecha_muestra>='".$inicio."' and fecha_muestra<='".$fin."' and idx_operador=$idx_operador ";
  if (mysqli_query(conectar(), $sql)) {
    if (mysqli_query(conectar(), $sql2)) {
        
    echo mensaje("8");$_GET['gettis']=null;     echo '<script>window.location="index.php";</script>';}} else 
    {echo mensaje("3");$_GET['gettis']=null;echo '<script>window.location="index.php";</script>';   }

}
function consulta($rol)
{
    if($rol==1){
        $inicio=date("Y-m")."-01"  ;
    $fin=date("Y-m")."-31"  ;
    $tabla="view_inventario";
    $arch="INVENTARIO";
    $campo="idx_producto";
    $arriba="menorth width='2%'>PRODUCTO menor/th>
       menorth width='5px'>VALOR menor/th>
       menorth width='5px'>BONO menor/th>
       menorth width='2%'>CATEGORIA menor/th>
       menorth width='3%'>CARACTERISTICA menor/th>
       
       ";
   $n=5;
    $sql = "SELECT * FROM `tbl_inventario` ORDER BY `tbl_inventario`.`prec_producto` ASC ;";
    $res = mysqli_query(conectar(), $sql);
    $sql2 = "SELECT * FROM tbl_parametros where idx=1";
    $res2 = mysqli_query(conectar(), $sql2);
    $tbl_parametros = mysqli_fetch_array($res2);
    
    

    echo ' 
 
        
            <!--Begin Datatables-->
            <div class="col-lg-12 col-md-12 col-sm-12 ver_muestra"> </div>
<div class="row ">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12 tbl_producto">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Inventario</h5>
 
<div class="pull-right" style="margin:.2em">
<button id="muestra" name="muestra" class="muestra btn btn-success">MUESTRA</button>
<a href="index.php?gettis=parrillaall"><button title="Resetear parrilla"  class=" btn btn-warning">
<i class="fas fa-times"></i></button></a>  
 
<a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a> 

</div> 
</header>

 
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>
    
    <tr>
        <th width="35%" class="hidden-xs" >Producto</th>
        <th  width="10%" >Presentacion</th>
        <th  width="10%">Valor</th>
        <th  width="30%" >Caracteristica</th>
 
        <th  width="15">Actividades</th>
    </tr>
    </thead>
    <tbody>';

    while ($operador = mysqli_fetch_array($res)) {

        echo '
<tr > 


<td class="hidden-xs">' . $operador['nomp_producto'] . '</td> 
<td  ><img class="media-object img-thumbnail user-img" alt="' . $operador['nomp_producto'] . '" src="../assets/imagen/producto/' . $operador['img_producto'] . '"></td>
<td class="mayuscula">' .  $operador['prec_producto'] . '</td>';

        echo '
<td   >' . $operador['caract_inventario'] . '</td> 
<td ><a href="index.php?id=' . $operador['idx_producto'] . '&gettis=editar"> <button title="EDITAR" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>
<a href="index.php?id=' . $operador['idx_producto'] . '&gettis=eliminar"> <button title="ELIMINAR" class="btn btn-danger"><i class="fas fa-trash"></i> </button></a>
<hr>
<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$operador['idx_producto'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  ';

 
if($operador['fecha_parrilla']>=$inicio  and $operador['fecha_parrilla']<=$fin ){
    echo '
    
    <a href="index.php?id=' . $operador['idx_producto'] . '&gettis=parrilla_0"> <button title="PARRILLA" class="btn btn-warning"><i class="fas fa-times"></i> </button></a>';
}else{
    echo '
   
    <a href="index.php?id=' . $operador['idx_producto'] . '&gettis=parrilla&cont_muestra='.$tbl_parametros['cont_muestra'].'"> <button title="PARRILLA" class="btn btn-warning"><i class="fas fa-tasks"></i> </button></a>';
    
}

        echo '</td>   </tr>';
    }
    echo ' 
            
    </tbody>                </table>
</div>
</div>
</div>
</div>
</div>';
    }else{
        $inicio=date("Y-m")."-01"  ;
        $fin=date("Y-m")."-31"  ;
        $tabla="view_inventario";
        $arch="INVENTARIO";
        $campo="idx_producto";
        $arriba="menorth width='2%'>PRODUCTO menor/th>
           menorth width='5px'>VALOR menor/th>
           menorth width='5px'>BONO menor/th>
           menorth width='2%'>CATEGORIA menor/th>
           menorth width='3%'>CARACTERISTICA menor/th>
           
           ";
       $n=5;
        $sql = "SELECT * FROM `tbl_inventario` ORDER BY `tbl_inventario`.`prec_producto` ASC ;";
        $res = mysqli_query(conectar(), $sql);
        $sql2 = "SELECT * FROM tbl_parametros where idx=1";
        $res2 = mysqli_query(conectar(), $sql2);
        $tbl_parametros = mysqli_fetch_array($res2);
        
        
    
        echo ' 
     
            
                <!--Begin Datatables-->
                <div class="col-lg-12 col-md-12 col-sm-12 ver_muestra"> </div>
    <div class="row ">
    <div class="col-xs-12 col-md-12  col-sm-12   col-lg-12 tbl_producto">
    <div class="box">
    <header>
    <div class="icons"><i class="fa fa-table"></i></div>
    <h5>Inventario</h5>
     
    <div class="pull-right" style="margin:.2em">
    <button id="muestra" name="muestra" class="muestra btn btn-success">MUESTRA</button>
    <a href="index.php?gettis=parrillaall"><button title="Resetear parrilla"  class=" btn btn-warning">
    <i class="fas fa-times"></i></button></a>  
    <a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
    <i class="fas fa-plus-circle"></i></button></a>  
    <a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
    <i class="fas fa-print"></i></button></a> 
    
    </div> 
    </header>
    
     
    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
        <thead>
        
        <tr>
            <th width="35%" class="hidden-xs" >Producto</th>
            <th  width="10%" >Presentacion</th>
            <th  width="10%">Valor</th>
            <th  width="30%" >Caracteristica</th>
     
            <th  width="15">Actividades</th>
        </tr>
        </thead>
        <tbody>';
    
        while ($operador = mysqli_fetch_array($res)) {
    
            echo '
    <tr > 
    
    
    <td class="hidden-xs">' . $operador['nomp_producto'] . '</td> 
    <td  ><img class="media-object img-thumbnail user-img" alt="' . $operador['nomp_producto'] . '" src="../assets/imagen/producto/' . $operador['img_producto'] . '"></td>
    <td class="mayuscula">' .  $operador['prec_producto'] . '</td>';
    
            echo '
    <td   >' . $operador['caract_inventario'] . '</td> 
    <td ><a href="index.php?id=' . $operador['idx_producto'] . '&gettis=editar"> <button title="EDITAR" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>
    <a href="index.php?id=' . $operador['idx_producto'] . '&gettis=eliminar"> <button title="ELIMINAR" class="btn btn-danger"><i class="fas fa-trash"></i> </button></a>
    <hr>
    <a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
    &n='.$n.'&id='.$operador['idx_producto'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
    <i class="fas fa-print"></i></button></a>  ';
    
     
    if($operador['fecha_parrilla']>=$inicio  and $operador['fecha_parrilla']<=$fin ){
        echo '
        
        <a href="index.php?id=' . $operador['idx_producto'] . '&gettis=parrilla_0"> <button title="PARRILLA" class="btn btn-warning"><i class="fas fa-times"></i> </button></a>';
    }else{
        echo '
       
        <a href="index.php?id=' . $operador['idx_producto'] . '&gettis=parrilla&cont_muestra='.$tbl_parametros['cont_muestra'].'"> <button title="PARRILLA" class="btn btn-warning"><i class="fas fa-tasks"></i> </button></a>';
        
    }
    
            echo '</td>   </tr>';
        }
        echo ' 
                
        </tbody>                </table>
    </div>
    </div>
    </div>
    </div>
    </div>';
    }
    
}

 

?> 