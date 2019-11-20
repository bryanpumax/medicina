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
    }


    return $eli;
}
function formulario($id)
{

    if (isset($id)) {
        $cn = conectar();
        $sql = "SELECT * FROM tbl_especialidades WHERE idx_especialidades =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
        $tbl_especialidades = mysqli_fetch_array($res);
    } else {
        $tbl_especialidades['idx_especialidades'] = null;
        $tbl_especialidades['esp_especialidades'] = null;
    }
    $cont = ' 
    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario de  Especialidad</h5>
     
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal" enctype="multipart/form-data" name="tbl_especialidades" action="" method="POST"  onSubmit="return valida(this);"> 

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Especialidades</label>

                    <div class="col-lg-8">
                        <input type="text" id="esp_especialidades" name="esp_especialidades" placeholder="Especialidad" value="' .  $tbl_especialidades['esp_especialidades'] . '" class="form-control"
                        onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                        >
                    </div>
                </div>
                <!-- /.form-group -->
 
                
<div class="form-actions  ">
<input type="hidden" name="idx_especialidades" id="idx_especialidades"  value="' .  $tbl_especialidades['idx_especialidades'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}



function elimina_tbl_especialidades($id)
{

    $cn = conectar();
    $sql = "call p_e_Especialidades (" . $id . ");";
    $sqlval = "SELECT * from  tbl_rutas tbl_r,tbl_especialidades tbl_c where tbl_r.idx_especialidades=tbl_c.idx_especialidades 
    and tbl_c.idx_especialidades=" . $id . "";
    if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
        echo mensaje('1');

        echo consulta();
    } else {
        if (mysqli_query($cn, $sql)) {
            echo mensaje('2');
            echo consulta();
        } else {
            echo mensaje('3');
            echo consulta();
        }
    }
    //
}
//tbl_especialidades
function registro($tbl_especialidades)
{

    $esp_especialidades = tilde_utfdecode(strtoupper(utf8_encode(limpiar_cadena($tbl_especialidades['esp_especialidades']))));


    $cn = conectar();
    //codigo de actualización 

    if ($tbl_especialidades['idx_especialidades']   != null) {

        $sql = "UPDATE tbl_especialidades 
		SET esp_especialidades = '" . $esp_especialidades . "' WHERE idx_especialidades = " . $tbl_especialidades['idx_especialidades']  . " ";
        if (mysqli_query($cn, $sql)) {
            echo mensaje('6');
            $_GET['gettis'] = null;
        } else {
            echo mensaje('3');
        }
    } else {
        //

        //nuevo
        $sqlval = "SELECT * from tbl_especialidades  where tbl_especialidades.esp_especialidades='$esp_especialidades';";
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
            echo mensaje('4');
        } else {
            //inicio
            $sql1 = "call  p_i_Especialidades('" . $esp_especialidades .  "');";

            if (mysqli_query($cn, $sql1)) {
                echo mensaje('5');
              
                $_GET['gettis'] = null;
            } else {

                echo mensaje('3');
                $_GET['gettis'] = null;
            }
            //fin registro
        }
        //
    }
}


function consulta()
{

    $tabla="tbl_especialidades";
    $arch="Especialidades";
    $campo="idx_especialidades";
    $sql = "SELECT  *     from $tabla;";
    $arriba="menorth width='350px'>Especialidad menor/th>
    menorth width='100px'>Doctores menor/th>";
$n=2;
    $res  = mysqli_query(conectar(), $sql);

    echo ' 
 
  <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Especialidades</h5>
 
<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  
<a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
</div> 
</header>

 
<div id="collapse3" class="body">

  
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>
    
    <tr>
  
        <th width=70% class="justify-content-center">Especialidad</th>
       
        <th width=20% class="justify-content-center">Actividades</th>
     
    </tr>
    </thead>
    <tbody>';

    while ($Especialidades = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td  class="mayuscula">' . ($Especialidades['esp_especialidades']) . '</td> 


<td ><a href="index.php?id=' . $Especialidades['idx_especialidades'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a> 
 
<a href="index.php?id=' . $Especialidades['idx_especialidades'] . '&gettis=eliminar"> <button class="  btn btn-danger"><i class="fas fa-trash"></i></button></a>
<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$Especialidades['idx_especialidades'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
';


        echo '</td>  </tr>';
    }
    echo ' 
            
    </tbody>                </table>
</div>
</div>
</div>
</div>
<!-- /.row -->
<!--End Datatables-->


 </div>
 
 
  ';
}

?> 