<script src="validar.js"></script>
<?php
include("../include/conexion.php");

function formulario($id)
{

    if (isset($id)) {
        $cn = conectar();
        $sql = "SELECT * FROM tbl_tipo WHERE idx_tipo =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
        $tbl_tipo = mysqli_fetch_array($res);
    } else {
        $tbl_tipo['idx_tipo'] = null;
        $tbl_tipo['desc_tipo'] = null;
    }
    $cont = ' 
    <div class="row">
<div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Categorias de Medicinas</h5>
      
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal"   name="tbl_tipo" action="" method="POST"  onSubmit="return valida(this);"> 

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Categoria del producto</label>

                    <div class="col-lg-8">
 
                        <input type="text" id="desc_tipo" name="desc_tipo" placeholder="Categoria" value="' .  $tbl_tipo['desc_tipo'] . '" class="form-control"
                        onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                        >
                    </div>
                </div>
                <!-- /.form-group -->
 
                
<div class="form-actions  ">
<input type="hidden" name="idx_tipo" id="idx_tipo"  value="' .  $tbl_tipo['idx_tipo'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}



function elimina_tbl_tipo($id)
{

    $cn = conectar();
    $sql = "call p_e_tipo (" . $id . ");";
    $sqlval = "SELECT * from tbl_inventario where idx_tipo =" . $id . "";
    if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
        echo mensaje("1");
echo consulta();
   
    } else {
        
        if (mysqli_query($cn, $sql)) {
            echo mensaje("2");
            echo consulta();
        } else {
            
            echo mensaje("3");
            echo consulta();
            
        }
       
    }
    //
}
//tbl_tipo
function registro($tbl_tipo)
{

    $desc_tipo = strtoupper((limpiar_cadena($tbl_tipo['desc_tipo'])));


    $cn = conectar();
    //codigo de actualización 

    if ($tbl_tipo['idx_tipo']   != null) {

        $sql1 = "UPDATE tbl_tipo 
		SET desc_tipo = '" . $desc_tipo . "' WHERE idx_tipo = " . $tbl_tipo['idx_tipo']  . " ";
        if (mysqli_query($cn, $sql1)) {
            echo mensaje("6");
            
            $_GET['gettis'] = null;
        } else {

            echo mensaje("3");
            $_GET['gettis'] = null;
        }
    } else {
        $sqlval = "SELECT * FROM  tbl_tipo where tbl_tipo.desc_tipo='$desc_tipo';";
        
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
            echo mensaje(4);
            } else {
            //inicio
            $sql1 = "call  p_i_tipo('" . $desc_tipo .  "');";
          
            if (mysqli_query($cn, $sql1)) {
                ?><body onload="correctamente();"></body><?php
               
              $_GET['gettis'] = null;
            } else {

                echo mensaje("3");
          
                $_GET['gettis'] = null;
            }
            //fin registro
        }
    }
}


function consulta()
{
$tabla="tbl_tipo";
$arch="CATEGORIA";
$campo="idx_tipo";
 $sql = "SELECT  *     from $tabla;";
    $res = mysqli_query(conectar(), $sql);
 $arriba="menorth width='350px'>Categoria menor/th>
    menorth width='100px'>Productos menor/th>";
$n=2;
    echo ' 
 
  <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Categoria</h5>
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
  
        <th width="70%">Categoria de producto</th>
       
        <th width="10%" class="hidden-xs">Cantidad <BR> productos </th>
        <th width="20%"> Actividades</th>
    </tr>
    </thead>
    <tbody>';

    while ($tipo = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td  class="mayuscula">' . ($tipo['desc_tipo']) . '</td> 
</td> <td class="hidden-xs"><span class="badge">' . $tipo['contar_tipo'] . '</span> </td> 
 
<td ><a href="index.php?id=' . $tipo['idx_tipo'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>
 
<a href="index.php?id=' . $tipo['idx_tipo'] . '&gettis=eliminar"><button  class="  btn btn-danger"><i class="fas fa-trash"></i></button> </a>
<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$tipo['idx_tipo'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  

';

        echo ' </tr>';
    }


    echo ' 
    </tbody></table>

</div></div></div></div>
<!-- /.row -->
<!--End Datatables-->


 </div>
 
 
  ';
}
include("../include/script1.php");
function mensaje($m)
{

    switch ($m) {
            /* para  eliminar */
        case 1:
          
        $eli = '<body onload="prohibido();"></body>';
            break;
        case 2:
            $eli ='<body onload="eliminar();"></body>';
            break;
        case 3:
        $eli ='<body onload="error();"></body>';
            break;
            //registro
        case 4:
            $eli = '<body onload="existencia();"></body> '; 
            
            break;
        case 5:
        $eli ='<body onload="correctamente();"></body>' ;
        
            break;
        case 6:
        $eli ='<body onload="actualizar();"></body>';
        
            break;
    }


    return $eli;
}

?> 