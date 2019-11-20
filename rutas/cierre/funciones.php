<script src="validar.js"></script>
<?php
include("../include/conexion.php");
date_default_timezone_set('America/Guayaquil');
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
    }


    return $eli;
}
function formulario($id)
{
    date_default_timezone_set('America/Guayaquil');
    if (isset($id)) {
        $cn = conectar();
        $sql = "SELECT * FROM tbl_citas WHERE id_citas =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
        $sql1 = "SELECT * FROM  tbl_clientes ;";
        $res1 = mysqli_query(conectar(), $sql1);
        $tbl_citas = mysqli_fetch_array($res);
    } else {
        $tbl_citas['id_citas'] = null;
        $tbl_citas['fecha_citas'] = date("Y-m-d");
        $tbl_citas['hora_citas'] = date("H:i", time());
        $sql = "SELECT * FROM  tbl_clientes ;";
        $res1 = mysqli_query(conectar(), $sql);
    }
    $cont = ' 
    <div class="row">
<div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario de  citas</h5>
      
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal"   name="tbl_citas" action="" method="POST"  onSubmit="return valida(this);"> 
            <div class="form-group">
            <label class="control-label col-lg-4 col-md-4 col-sm-4" for="dp1">Tiempo de la cita</label>

            <div class="col-lg-5 col-md-5 col-sm-5">
                <input type="date" name="fecha_citas" class="form-control" min="'.date("Y-m-d", time()) .'" max="' . date('Y-m-d', strtotime(date("Y-m-d", time()) . "+5 years")) . '" value="' . $tbl_citas['fecha_citas'] . '" id="fecha_citas">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
 
            <input type="time" id="hora_citas" name="hora_citas" placeholder="Hora" value="' .  $tbl_citas['hora_citas'] . '" class="form-control"
            onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);" >
        </div>
        </div>
        <!-- /.form-group -->
            
                <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione cliente</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <select data-placeholder="Your Favorite Football Team"  class="form-control chzn-select mayuscula" tabindex="5" name="idx_clientes" id="idx_clientes">
                        <option value="0"></option><optgroup label="Cliente">';
    while ($clientes = mysqli_fetch_array($res1)) {
        $cont .= '<option value="' . $clientes['idx_clientes'] . '">' . ($clientes['nom_clientes']) . ' ' . ($clientes['ape_clientes']) . '</option>';
    }

    $cont .= ' </optgroup></select>
                </div>
            </div>
            <!-- /.form-group -->  
        
<div class="form-actions  ">
<input type="hidden" name="idx_operador" id="idx_operador"  value="' .  $_SESSION['idx_operador'] . '"  >
<input type="hidden" name="id_citas" id="id_citas"  value="' .  $tbl_citas['id_citas'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}



function elimina_tbl_citas($id)
{

    $cn = conectar();
    $sql = "delete from tbl_citas where id_citas=(" . $id . ");";
    if (mysqli_query($cn, $sql)) {
        echo mensaje('2', '');
        header('Location: index.php');
    } else {
        echo mensaje('3', $sql);
        header('Location: index.php');
    }
}

//tbl_citas
function registro($tbl_citas)
{

    $hora_citas = ((limpiar_cadena($tbl_citas['hora_citas'])));
    $fecha_citas = ((limpiar_cadena($tbl_citas['fecha_citas'])));
    $idx_clientes = ((($tbl_citas['idx_clientes'])));
    $idx_operador = ((($tbl_citas['idx_operador'])));
    $cn = conectar();
    //codigo de actualización 

    if ($tbl_citas['id_citas']   != null) {

        $sql1 = "UPDATE tbl_citas 
		SET fecha_citas= '" . $fecha_citas . "',hora_citas = '" . $hora_citas . "',
        idx_clientes=" . $idx_clientes . " WHERE id_citas = " . $tbl_citas['id_citas']  . " ";
        if (mysqli_query($cn, $sql1)) {
            echo mensaje('6', '');
            $_GET['gettis'] = null;
        } else {

            echo mensaje('3', $sql1);
            $_GET['gettis'] = null;
        }
    } else {

        //inicio
        $sql1 = "INSERT into tbl_citas values(null,'" . $fecha_citas . "','" . $hora_citas .  "'," . $idx_clientes . "," . $idx_operador . ",'activo','');";


        if (mysqli_query($cn, $sql1)) {
            echo mensaje('5', '');
            $_GET['gettis'] = null;
        } else {

            echo mensaje('3', $sql1);
            $_GET['gettis'] = null;
        }
        //fin registro
    }
}


function consultaoperador($idx_operador)
{
    $tabla="view_tbl_citas where idx_operador=$idx_operador;";
    $arch="CITAS";
    $tabla2="view_tbl_citas ;";
    
    $campo="id_citas";
    $arriba="menorth width='10px'>FECHA menor/th>
       menorth width='10px'>HORA menor/th>
       menorth width='100px'>CLIENTE menor/th>
       menorth width='8px'>ESTADO menor/th>
       menorth width='100px'>OPINION menor/th>
       
       ";
   $n=5;
    /* $sql = "SELECT * FROM tbl_inventario,`tbl_citas` ORDER BY `tbl_citas`.`hora_citas` ASC ;"; */
    $sql = "SELECT  *     from ( view_tbl_citas) where idx_operador=$idx_operador;";
    $res = mysqli_query(conectar(), $sql);


    echo ' 
 
  <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<H5>CITAS OPERADOR</H5>
 

<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  
<a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
</div> 
</header>

<div id="collapse3" class="body ">

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>

    <tr>
  
        <th  width="15%">FECHA</th>
        <th width="15%">HORA</th>
        <th width="50%">CLIENTE</th>
    
        <th width="15%">ACTIVIDADES</th>
       
       
    </tr>
    </thead>
    <tbody>';

    while ($tipo = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td  class="mayuscula">' . ($tipo['fecha_citas']) . '</td> 
<td  class="mayuscula">' . ($tipo['hora_citas']) . '</td> 
<td  class="mayuscula">' . ($tipo['cliente']) . '</td> 
 
<td ><a href="index.php?id=' . $tipo['id_citas'] . '&gettis=editar"><button class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>
 
<a href="index.php?id=' . $tipo['id_citas'] . '&gettis=eliminar"><button class="  btn btn-danger"><i class="fas fa-trash"></i></button> </a>
<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla2.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$tipo['id_citas'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
';

        echo '</td> </tr>';
    }


    echo ' 
    </tbody></table>

</div></div></div></div>
<!-- /.row -->
<!--End Datatables-->


 </div>
 
 
  ';
}
function consultaadministrador()
{
    $tabla="view_tbl_citas  ORDER BY `view_tbl_citas`.`id_citas` desc";
    $tabla2="view_tbl_citas  ";
    $arch="CITAS";$campo="id_citas";
    $sql = "SELECT  *     from view_tbl_citas;";
       $res = mysqli_query(conectar(), $sql);
    $arriba="menorth width='10px'>FECHA menor/th>
    menorth width='10px'>HORA menor/th>
    menorth width='100px'>CLIENTE menor/th>
    menorth width='8px'>ESTADO menor/th>
    menorth width='100px'>OPINION menor/th>
    menorth width='100px'>OPERADOR menor/th>
       ";
   $n=6;
    /* $sql = "SELECT * FROM tbl_inventario,`tbl_citas` ORDER BY `tbl_citas`.`hora_citas` ASC ;"; */
 
    $res = mysqli_query(conectar(), $sql);


    echo ' 
 
  <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<H5>CITAS</H5>
 

<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  
<a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
</div> 
</header>
  
<div id="collapse3" class="body ">

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>

    <tr>
    <th width="15%">FECHA</th>
    <th width="10%" class="hidden-xs">HORA</th>
    <th width="30%">CLIENTE</th>
    <th width="15%">ACTIVIDADES</th>
       
    </tr>
    </thead>
    <tbody>';

    while ($tipo = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td  class="mayuscula">' . ($tipo['fecha_citas']) . '</td> 
<td  class="hidden-xs">' . ($tipo['hora_citas']) . '</td> 
<td  class="mayuscula">' . ($tipo['cliente']) . '</td> 
 
 
<td ><a href="index.php?id=' . $tipo['id_citas'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>
 
<a href="index.php?id=' . $tipo['id_citas'] . '&gettis=eliminar"><button class="  btn btn-danger"><i class="fas fa-trash"></i></button> </a>
<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla2.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$tipo['id_citas'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
';

        echo '</td> </tr>';
    }


    echo ' 
    </tbody></table>

</div></div></div></div>
<!-- /.row -->
<!--End Datatables-->
 </div>
  ';
}
