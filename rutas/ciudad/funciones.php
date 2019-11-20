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
        $sql = "SELECT * FROM tbl_ciudades WHERE idx_ciudades =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
        $tbl_ciudades = mysqli_fetch_array($res);
    } else {
        $tbl_ciudades['idx_ciudades'] = null;
        $tbl_ciudades['nom_ciudades'] = null;
    }
    $cont = ' 
    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario de  ciudad</h5>
     
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal" enctype="multipart/form-data" name="tbl_ciudades" action="" method="POST"  onSubmit="return valida(this);"> 

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Ciudades</label>

                    <div class="col-lg-8">
                        <input type="text" id="nom_ciudades" name="nom_ciudades" placeholder="Ciudad" value="' .  $tbl_ciudades['nom_ciudades'] . '" class="form-control"
                        onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                        >
                    </div>
                </div>
                <!-- /.form-group -->
 
                
<div class="form-actions  ">
<input type="hidden" name="idx_ciudades" id="idx_ciudades"  value="' .  $tbl_ciudades['idx_ciudades'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}



function elimina_tbl_ciudades($id)
{

    $cn = conectar();
    $sql = "call p_e_ciudades (" . $id . ");";
    $sqlval = "SELECT * from  tbl_rutas tbl_r,tbl_ciudades tbl_c where tbl_r.idx_ciudades=tbl_c.idx_ciudades 
    and tbl_c.idx_ciudades=" . $id . "";
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
//tbl_ciudades
function registro($tbl_ciudades)
{

    $nom_ciudades = tilde_utfdecode(strtoupper(utf8_encode(limpiar_cadena($tbl_ciudades['nom_ciudades']))));


    $cn = conectar();
    //codigo de actualización 

    if ($tbl_ciudades['idx_ciudades']   != null) {

        $sql = "UPDATE tbl_ciudades 
		SET nom_ciudades = '" . $nom_ciudades . "' WHERE idx_ciudades = " . $tbl_ciudades['idx_ciudades']  . " ";
        if (mysqli_query($cn, $sql)) {
            echo mensaje('6');
            $_GET['gettis'] = null;
        } else {
            echo mensaje('3');
        }
    } else {
        //

        //nuevo
        $sqlval = "SELECT * from tbl_ciudades  where tbl_ciudades.nom_ciudades='$nom_ciudades';";
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
            echo mensaje('4');
        } else {
            //inicio
            $sql1 = "call  p_i_ciudades('" . $nom_ciudades .  "');";

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

    $tabla="tbl_ciudades";
    $arch="CIUDADES";
    $campo="idx_ciudades";
    $sql = "SELECT  *     from $tabla;";
    $arriba="menorth width='350px'>CIUDAD menor/th>
    menorth width='100px'>RUTAS menor/th>";
$n=2;
    $res  = mysqli_query(conectar(), $sql);

    echo ' 
 
  <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Ciudades</h5>
 
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
  
        <th width=70% class="justify-content-center">Ciudad</th>
        <th width=10% class="hidden-xs justify-content-center">Cantidad <BR> rutas </th>
        <th width=20% class="justify-content-center">Actividades</th>
     
    </tr>
    </thead>
    <tbody>';

    while ($ciudades = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td  class="mayuscula">' . ($ciudades['nom_ciudades']) . '</td> 

<td class="hidden-xs"><span class="badge">' . $ciudades['cont_ciudades'] . '</span>  </td>
<td ><a href="index.php?id=' . $ciudades['idx_ciudades'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a> 
 
<a href="index.php?id=' . $ciudades['idx_ciudades'] . '&gettis=eliminar"> <button class="  btn btn-danger"><i class="fas fa-trash"></i></button></a>
<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$ciudades['idx_ciudades'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
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