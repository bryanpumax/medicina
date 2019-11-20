<style>
    .ver_muestra {
        display: none;
        position: absolute !important;
        top: 2em;
        left: 10%;
        background: #fff;
        border: 1px solid #000;
        padding: .2em;
        z-index: 9999;
    }

    .espacio {
        margin-top: 1em !important;
    }

    .milista {
        position: absolute !important;
        top: 2em;
        left: 10%;
        border: 1px solid #000;
        padding: .2em;
        z-index: 9999;
        font-size: 9px !important;
        color: #000 !important;
        text-transform: uppercase;
        -ms-text-justify: center;
        font-weight: bold;
    }
</style>
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
            $eli = '<body onload="existencia2();"></body> ';

            break;
    }


    return $eli;
}
function formulario($id)
{

    if (isset($id)) {

        $sql = "SELECT * FROM tbl_visitas tblc,tbl_rutas tblr,tbl_ciudades tblcd,tbl_especialidades tbl_e WHERE tblr.idx_ciudades=tblcd.idx_ciudades and tblr.idx_rutas=tblc.idx_rutas and tbl_e.idx_especialidades=tblc.idx_especialidades and tblc.idx_visita =  " . $id . " ;";
        $res = mysqli_query(conectar(), $sql);
    } else {
        $tbl_visitas['idx_visita'] = null;
        $tbl_visitas['cedu_visita'] = null;
        $tbl_visitas['nom_visita'] = null;

        $tbl_visitas['dir_visita'] = null;


        $sql_ciu = "SELECT * FROM  tbl_ciudades ;";
        $res1 = mysqli_query(conectar(), $sql_ciu);

        $sql_esp = "SELECT * FROM  tbl_especialidades ;";
        $res2 = mysqli_query(conectar(), $sql_esp);
    }
    $cont = ' 
    <div class="col-lg-8 col-md-8 col-sm-8 ver_muestra"> </div>
    <input type="text" id="n_muestra" name="n_muestra" value="0">
    <input type="text" id="n_muestra2" name="n_muestra2" value="0">
    <div class="col-lg-12 bg-yellow milista" style="display:none"></div>

    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    
   
    <div class=" ">
       
        <div id="div-1" class="body">
            <form class="form-horizontal" name="tbl_visitas" action="" method="POST"  onSubmit="return validacl(this);"> 

              <input type="hidden" id="cod_visita" value=' . $tbl_visitas['cedu_visita'] . '>
                <div class="form-group espacio">
                    <label for="text1" class="control-label col-md-4 col-sm-4 col-lg-4">Nombre Apellido del Medico</label>

                    <div class="col-lg-6 col-md-6 col-sm-6 espacio">
                        <input class="form-control" type="text" id="nom_visita"  name="nom_visita"  placeholder="Nombre Apellido"
                        value="' .  $tbl_visitas['nom_visita'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                        onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);">
                        </div>

                        <div class="  col-lg-2 col-md-2 col-sm-2 espacio">

                        <button type="button" class="btn btn-info pull-right listaMedico" ><i class="fas fa-street-view fa-border"></i> Lista Medicos</button>
</div>
                        
                </div>
                </div>
          
                
<!-- /.form-group -->  
<div class="form-group ">

<label for="text1" class="control-label col-md-4  col-sm-4  col-lg-4  ">Direccion</label>

<div class="col-lg-8 col-md-8 col-sm-8 espacio">
    <input class="form-control" type="text" id="dir_visita" name="dir_visita"   placeholder="Direccion"
    value="' .  $tbl_visitas['dir_visita'] . '"     data-original-title="Please use your secure password" data-placement="top" 
    onkeypress="return  letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"    >
</div>
</div>

<!-- /.form-group -->
 
            <div class="form-group espacio">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ciudad</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8 espacio">
                    <select data-placeholder="Seleccione la ciudad" 
                    onchange="CargarProductos(this.value);" class="form-control chzn-select mayuscula" 
                    tabindex="5" name="idx_ciudadesselect" id="idx_ciudadesselect">
                        <option name="ciu" id="ciu" value="0"></option> ';
    while ($ciudades = mysqli_fetch_array($res1)) {
        $cont .= '<option value="' . $ciudades['idx_ciudades'] . '">' . ($ciudades['nom_ciudades']) . '</option>';
    }

    $cont .= '  </select>
                </div>
            </div>
            <!-- /.form-group -->  
            <div id="respuesta"></div>
            <div class="form-group espacio">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ruta</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8 espacio">
                    <select data-placeholder="Your Favorite Football Team" class="form-control chzn-select mayuscula" tabindex="5" name="idx_ruta" id="idx_ruta">
                    <option name="rut" id="rut" value="0"></option>
                    </select>
                </div>
            </div>
                <!-- /.form-group -->
                <div class="form-group espacio">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione especialidad</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8 espacio">
                    <select data-placeholder="Your Favorite Football Team"  class="form-control chzn-select mayuscula" tabindex="5" name="idx_especialidades" id="idx_especialidades">
                        <option name="idxespecial" id="idxespecial" value="0"></option><optgroup label="Especialidad medica">';
    while ($ciudades = mysqli_fetch_array($res2)) {
        $cont .= '<option  value="' . $ciudades['idx_especialidades'] . '">' . ($ciudades['esp_especialidades']) . '</option>';
    }

    $cont .= ' </optgroup></select>
                </div>
            </div>
            <!-- /.form-group -->  
    
 
          
<div class="form-actions espacio  ">
<input type="hidden" name="idx_visita" id="idx_visita"  value="' .  $tbl_visitas['idx_visita'] . '"  >
<input type="hidden" name="idx_operador" id="idx_operador"  value="' .  $_SESSION['idx_operador'] . '"  >

 
</div>

             
            </form>
            <button class="btn btn-info pull-right muestra espacio"><i class="far fa-clipboard fa-border"></i>Listar muestra</button>
        </div>
    </div> 
    
</div>
<br>
<div class="col-md-8 col-md-offset-2 productos">

<table class="table table-hover table-condensed table-bordered">
    <thead>
      
        <th>Descripcion del Producto</th>
        <th>Cant</th>
       
    </thead>
<tbody>
    <tr id="detallesProducto">
     
        <td>-</td>
        <td>-</td>
         
    </tr>
</tbody>
 </table>


</div>

<div class=" col-md-4  pull-right">
<button class="btn btn-success GuardaPedido"><i class="fas fa-fax fa-border"></i>&nbsp;Guardar</button>

<button class="btn btn-warning cancelaPedido"><i class="fas fa-times fa-border"></i>&nbsp;Cancelar</button>
  
 <input type="hidden" name="codigo" id="codigo">
</div>

';
    return $cont;
}
//tbl_visitas <option value="0">Dueño de la  mascota</option>
//editar
function formulario2($id)
{

    if (isset($id)) {
        $sql = "SELECT * FROM tbl_visitas tblc,tbl_rutas tblr,tbl_ciudades tblcd,tbl_especialidades tbl_e,tbl_visitas_detalle WHERE tblr.idx_ciudades=tblcd.idx_ciudades and tblr.idx_rutas=tblc.idx_rutas and tbl_e.idx_especialidades=tblc.idx_especialidades and tbl_visitas_detalle.idx_visitas=tblc.idx_visita and tblc.idx_visita = " . $id . "";
        /*         $sql = "SELECT * FROM tbl_visitas tblc,tbl_rutas tblr,tbl_ciudades tblcd,tbl_especialidades tbl_e WHERE tblr.idx_ciudades=tblcd.idx_ciudades and tblr.idx_rutas=tblc.idx_rutas and tbl_e.idx_especialidades=tblc.idx_especialidades and tblc.idx_visita =  " . $id . " ;"; */
        $res = mysqli_query(conectar(), $sql);
        //while donde sale  todos los  datos de la condicion 
        $reses = mysqli_query(conectar(), $sql);
        $resci = mysqli_query(conectar(), $sql);
        $resru = mysqli_query(conectar(), $sql);
        //muestra  todo en  el  while
        $sql_ciu = "SELECT * FROM  tbl_ciudades ;";
        $res1 = mysqli_query(conectar(), $sql_ciu);
        $sql_esp = "SELECT * FROM  tbl_especialidades ;";
        $res2 = mysqli_query(conectar(), $sql_esp);
        $tbl_visitas = mysqli_fetch_array($res);

        $tbl_ciudades = mysqli_fetch_array($resci);
        $tbl_ruta = mysqli_fetch_array($resru);
        $tbl_esp = mysqli_fetch_array($reses);
        $idespe = $tbl_esp['idx_especialidades'];
        $espe = $tbl_esp['esp_especialidades'];
        $idx_ruta = $tbl_ruta['idx_rutas'];
        $nom_ruta = $tbl_ruta['nom_rutas'];
        $idx_ciudad = $tbl_ciudades['idx_ciudades'];
        $nom_ciudad = $tbl_ciudades['nom_ciudades'];

        //     $n_muestra=;
    }
    $cont = ' 
    <div class="col-lg-8 col-md-8 col-sm-8 ver_muestra"> </div>
    <input type="hidden" id="n_muestra" value="0">
    <input type="hidden" id="n_muestra2" value="">
    <input type="hidden" name="n_muestra3" id="n_muestra3" value="' . $tbl_visitas['n_muestra'] . '"> 
    <div class="col-lg-12 bg-yellow milista"  style="display:none"></div>

    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    
   
    <div class=" ">
       
        <div id="div-1" class="body">
            <form class="form-horizontal" name="tbl_visitas" action="" method="POST"  onSubmit="return validacl(this);"> 

              <input type="hidden" id="cod_visita" value=' . $tbl_visitas['cedu_visita'] . '>
                <div class="form-group espacio">
                    <label for="text1" class="control-label col-md-4 col-sm-4 col-lg-4">Nombre Apellido del Medico</label>

                    <div class="col-lg-6 col-md-6 col-sm-6 espacio">
                        <input class="form-control" type="text" id="nom_visita"  name="nom_visita"  placeholder="Nombre Apellido"
                        value="' .  $tbl_visitas['nom_visita'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                        onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);">
                        </div>

                        <div class="  col-lg-2 col-md-2 col-sm-2 espacio">

                        <button type="button" class="btn btn-info pull-right listaMedico" ><i class="fas fa-street-view fa-border"></i> Lista Medicos</button>
</div>
                        
                </div>
                </div>
          
                
<!-- /.form-group -->  
<div class="form-group ">

<label for="text1" class="control-label col-md-4  col-sm-4  col-lg-4  ">Direccion</label>

<div class="col-lg-8 col-md-8 col-sm-8 espacio">
    <input class="form-control" type="text" id="dir_visita" name="dir_visita"   placeholder="Direccion"
    value="' .  $tbl_visitas['dir_visita'] . '"     data-original-title="Please use your secure password" data-placement="top" 
    onkeypress="return  letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"    >
</div>
</div>

<!-- /.form-group -->
 
            <div class="form-group espacio">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ciudad</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8 espacio">
                    <select data-placeholder="Seleccione la ciudad" 
                    onchange="CargarProductos(this.value);" class="form-control chzn-select mayuscula" 
                    tabindex="5" name="idx_ciudadesselect" id="idx_ciudadesselect">
                        <option name="ciu" id="ciu" value="' . $idx_ciudad . '">' . $nom_ciudad . '</option> ';
    while ($ciudades = mysqli_fetch_array($res1)) {
        $cont .= '<option value="' . $ciudades['idx_ciudades'] . '">' . ($ciudades['nom_ciudades']) . '</option>';
    }

    $cont .= '  </select>
                </div>
            </div>
            <!-- /.form-group -->  
            <div id="respuesta"></div>
            <div class="form-group espacio">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ruta</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8 espacio">
                    <select data-placeholder="Your Favorite Football Team" class="form-control chzn-select mayuscula" tabindex="5" name="idx_ruta" id="idx_ruta">
                    <option name="rut" id="rut" value="' . $idx_ruta . '">' . $nom_ruta . '</option>
                    </select>
                </div>
            </div>
                <!-- /.form-group -->
                <div class="form-group espacio">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione especialidad</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8 espacio">
                    <select data-placeholder="Your Favorite Football Team"  class="form-control chzn-select mayuscula" tabindex="5" name="idx_especialidades" id="idx_especialidades">
                        <option name="idxespecial" id="idxespecial" value="' . $idespe . '">' . $espe . '</option>';
    while ($ciudades = mysqli_fetch_array($res2)) {
        $cont .= '<option  value="' . $ciudades['idx_especialidades'] . '">' . ($ciudades['esp_especialidades']) . '</option>';
    }

    $cont .= ' </select>
                </div>
            </div>
            <!-- /.form-group -->  
    
 
          
<div class="form-actions espacio  ">
<input type="hidden" name="idx_visita" id="idx_visita"  value="' .  $tbl_visitas['idx_visita'] . '"  >
<input type="hidden" name="idx_operador" id="idx_operador"  value="' .  $_SESSION['idx_operador'] . '"  >

 
</div>

            
            </form>
            <button class="btn btn-info pull-right muestra2 espacio" ><i class="far fa-clipboard fa-border"></i>Listar muestra</button>
        </div>
    </div> 
    
</div>
<br>
<div class="col-md-8 col-md-offset-3 productos">' . detallemuestra($id) . '


</div>

<div class=" col-md-4  pull-right">
<button class="btn btn-success GuardaPedido2"><i class="fas fa-fax fa-border"></i>&nbsp;Guardar</button>

<button class="btn btn-warning cancelaPedido2"><i class="fas fa-times fa-border"></i>&nbsp;Regresar</button>
  
 <input type="hidden" name="codigo" id="codigo">
</div>

';
    return $cont;
}

function detallemuestra($codigo)
{
    include("../include/conexionPdo.php");

    $cont = '
<table class="table table-hover table-condensed">
 
<thead class="text-primary alert-warning">
    <tr>
        <th width="60%">Descripcion del Producto</th>
        <th width="10%">Cant</th>
 
        
         <th width="10%">Seleccionar</th>
    </tr>
</thead>
<tbody>';

    $sql = $pdo->query("SELECT * FROM  view_tbl_det_muestra where idx_vista='$codigo'");
    $cuenta = $sql->rowCount();
    if ($cuenta > 0) {
        $cuenta = 0;
        $suma = 0;
        $sql = $pdo->query("SELECT * FROM  view_tbl_det_muestra where idx_vista='$codigo'");


        while ($row = $sql->fetch()) {
            $cuenta++;
            $cont .= '
    <tr>
        <td>' . $row['nomp_producto'] . '</td>
        <td >' . $row['cantidad'] . '  </td>
        
        <td>
        <button type="button" class="btn btn-alert  e_producto2" data-id="' . $row['id_tmp_det'] . '" 
        data-nmuestra="' . $row['n_muestra'] . '" data-codigo="' . $codigo . '"        >
        <i class="far fa-minus-square"></i></button>

        </td>
    </tr>';

            $suma = $suma + ($row['cantidad']);
        }
    } else {
        $suma = 0;
    }
    $cont .= '
</tbody>
<tfoot>

<tr>
 <th colspan="3"></th>
 <th>Suman</th>
 <th class="suman">' . $suma . '</th>
 <th> muestra</th>
</tr>

</tfoot></table>
';


    $cont .= '</table>';
    return $cont;
}


function elimina_tbl_visitas($id)
{

    $sql = "delete from tbl_det_muestra where idx_vista=$id;";
    $sql1 = "DELETE FROM tbl_visitas_detalle WHERE idx_visitas=$id;";
    $sql2 = "DELETE FROM tbl_visitas WHERE idx_visita=$id;";

    if (mysqli_query(conectar(), $sql)) {
        if (mysqli_query(conectar(), $sql1)) {
            if (mysqli_query(conectar(), $sql2)) {
                echo mensaje('2');
                echo consulta($_SESSION['rol_operador']);
            }
        }
    } else {
        echo mensaje('3');
        echo consulta($_SESSION['rol_operador']);
    }
    //
}
//tbl_visitas
function registro($tbl_visitas)
{
    $cedu_visita =  limpiar_cadena_sin_espacio($tbl_visitas['cedu_visita']);
    $nom_visita = strtoupper((limpiar_cadena($tbl_visitas['nom_visita'])));
    $_SESSION['nom_visita'] = $nom_visita;
    $ape_visita =  strtoupper((limpiar_cadena($tbl_visitas['ape_visita'])));
    $telf_visita = limpiar_cadena_sin_espacio($tbl_visitas['telf_visita']);
    $dir_visita = strtoupper((limpiar_cadena($tbl_visitas['dir_visita'])));
    $email_visita = (limpiar_cadena_email($tbl_visitas['email_visita']));
    $cel_visita = (limpiar_cadena_sin_espacio($tbl_visitas['cel_visita']));
    $emp_visita = strtoupper((limpiar_cadena_sin_espacio($tbl_visitas['emp_visita'])));
    $idx_ruta =  limpiar_cadena_sin_espacio($tbl_visitas['idx_ruta']);;

    $sqlval1 = "select * from tbl_visitas where tbl_visitas.cedu_visita='" . $cedu_visita . "';";
    $sqlval2 = "select * from tbl_visitas where  tbl_visitas.email_visita='" . $email_visita . "'";


    //codigo de actualización 

    if ($tbl_visitas['idx_visita']   != null) {

        $sql = "UPDATE tbl_visitas 
		SET 
        cedu_visita = '" . $cedu_visita . "',
        nom_visita = '" . $nom_visita . "',
        ape_visita = '" . $ape_visita . "',
        telf_visita = '" . $telf_visita . "',
        dir_visita='" . $dir_visita . "',
         email_visita='" . $email_visita . "',
         cel_visita='" . $cel_visita . "'
		 WHERE idx_visita = " . $tbl_visitas['idx_visita']  . " ";



        if (mysqli_query(conectar(), $sql)) {
            echo mensaje(6);
            echo consulta($_SESSION['rol_operador']);
        } else {

            echo mensaje(3);
            echo consulta($_SESSION['rol_operador']);
        }
    } else {
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval1)) > 0) {
            echo mensaje('4');
        } else if (mysqli_num_rows(mysqli_query(conectar(), $sqlval2)) > 0) {
            echo mensaje('7');
        } else {
            $sql1 = "call  p_i_visita('" . $cedu_visita . "', '" .
                $nom_visita . "', '" .
                $ape_visita . "', " . $idx_ruta . ", '" .
                $dir_visita . "', '" . $telf_visita . "', '" .
                $cel_visita . "', '" . $email_visita . "', '" . $emp_visita . "');";



            if (mysqli_query(conectar(), $sql1)) {
                echo mensaje('5');
                echo consulta($_SESSION['rol_operador']);
            } else {
                echo mensaje('3');
                echo consulta($_SESSION['rol_operador']);
            }
        }
    }
}



function consulta($rol_operador)
{

    include("../include/conexionPdo.php");
 if($rol_operador==1){
    $tabla = "view_visitas_detalle";
    $arch = "VISITAS";
    $campo = "n_muestra";
    $arriba = "menorth width='1%'>Fecha menor/th>
       menorth width='2%'>Cedula menor/th>
       menorth width='2%'>Nombre Apellido menor/th>
       menorth width='2%'>Direccion menor/th>
       menorth width='2%'>Especialidad menor/th>
       menorth width='2%'>RUTA menor/th>
     
       ";
    $n = 6;
$_idx_operador=$_SESSION['idx_operador'];
    $consulta_visita = $pdo->query("SELECT * FROM view_visitas where fech_visita=curdate() and idx_operador= $_idx_operador");

    // $sql = "SELECT * FROM view_visitas1 ";
    //  $res = mysqli_query(conectar(), $sql);
    $hora = date("H:i");

    echo ' 
            <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Registro de visitas Diarias </h5>
<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  ';
    if ($hora >= "00:00") {
        echo '<a href="#" class="imprime"><button title="imprimir excel diario"  class=" btn btn-info">
<i class="far fa-file-excel"></i></button></a> 
<a href="#" class="imprime_mensual"><button title="imprimir excel mensual"  class="btn btn-outline-info"><i class="fas fa-copy"></i></button></a>  
 ';
    }
    echo '
</div> 
</header>
<br>
<div id="collapse6" class="body ">
 
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>
    
    <tr>
    <th class="hidden-xs" width="15%">Fecha</th>
 
        <th width="40%">Nombre y Apellido</th>
        <th width="30%">Ruta</th>
       
        <th width="15%">Actividades</th>
    </tr>
    </thead>
    <tbody>';

    while ($operador = $consulta_visita->fetch()) {

        echo '
<tr > 
<td  class="hidden-xs">' . $operador['fech_visita'] . '</td> 
 
<td  >' . strtoupper($operador['nom_visita']) . '</td> 

<td  >' . $operador['localizacion'] . '</td> 

  

<td >
 

<a href="../imprimir/crearPdf.php?gettis=3&idx=' . $operador['idx_visita'] . ' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a> 
 ';
        if ($hora <= "18:30") {
            echo '<a href="index.php?n_muestra=' . $operador['idx_visita'] . '&gettis=eliminar"> <button title="Elimiinar" class=" BTN btn-danger"><i class="fas fa-trash"></i></button></a><a href="index.php?idx_visita=' . $operador['idx_visita'] . '&gettis=editar"> <button title="Editar" class=" BTN btn-success"><i class="fas fa-pen"></i></button></a>
';
        }

        echo '</td>   </tr>';
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
}else{
    $tabla = "view_visitas_detalle";
    $arch = "VISITAS";
    $campo = "n_muestra";
    $arriba = "menorth width='1%'>Fecha menor/th>
       menorth width='2%'>Cedula menor/th>
       menorth width='2%'>Nombre Apellido menor/th>
       menorth width='2%'>Direccion menor/th>
       menorth width='2%'>Especialidad menor/th>
       menorth width='2%'>RUTA menor/th>
     
       ";
    $n = 6;
$_idx_operador=$_SESSION['idx_operador'];
    $consulta_visita = $pdo->query("SELECT * FROM view_visitas where fech_visita=curdate() ");

    // $sql = "SELECT * FROM view_visitas1 ";
    //  $res = mysqli_query(conectar(), $sql);
    $hora = date("H:i");

    echo ' 
            <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Registro de visitas Diarias </h5>
<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  ';
    if ($hora >= "00:00") {
        echo '<a href="#" class="imprime"><button title="imprimir excel diario"  class=" btn btn-info">
<i class="far fa-file-excel"></i></button></a> 
<a href="#" class="imprime_mensual"><button title="imprimir excel mensual"  class="btn btn-outline-info"><i class="fas fa-copy"></i></button></a>  
 ';
    }
    echo '
</div> 
</header>
<br>
<div id="collapse6" class="body ">
 
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>
    
    <tr>
    <th class="hidden-xs" width="15%">Fecha</th>
 
        <th width="40%">Nombre y Apellido</th>
        <th width="30%">Ruta</th>
        <th width="30%">Visitador</th>
        <th width="15%">Actividades</th>
    </tr>
    </thead>
    <tbody>';

    while ($operador = $consulta_visita->fetch()) {

        echo '
<tr > 
<td  class="hidden-xs">' . $operador['fech_visita'] . '</td> 
 
<td  >' . strtoupper($operador['nom_visita']) . '</td> 

<td  >' . $operador['localizacion'] . '</td> 
<td  >' . strtoupper($operador['nom_operador']) . '</td> 
  

<td >
 

<a href="../imprimir/crearPdf.php?gettis=3&idx=' . $operador['idx_visita'] . ' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a> 
 ';
        if ($hora <= "18:30") {
            echo '<a href="index.php?n_muestra=' . $operador['idx_visita'] . '&gettis=eliminar"> <button title="Elimiinar" class=" BTN btn-danger"><i class="fas fa-trash"></i></button></a><a href="index.php?idx_visita=' . $operador['idx_visita'] . '&gettis=editar"> <button title="Editar" class=" BTN btn-success"><i class="fas fa-pen"></i></button></a>
';
        }

        echo '</td>   </tr>';
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
   
}
echo '

<script>
// A $( document ).ready() block.
$( document ).ready(function() {
$(".imprime").click(function(){
    $(".loader").fadeIn("slow");
   
   miventa= window.open (`reporte/diario.php`,"toolbar=no, fullscreen=no, channelmode=no, scrollbars=no, resizable=yes, top=10, left=10, width=10, height=10")
   miventa.close();   // Closes the new window

   setTimeout(function()
   {    alertify.warning("GENERANDO--ESPERE POR FAVOR")  }, 100);
setTimeout(function()
{$(".loader").fadeOut("slow");

alertify.warning("ARCHIVO GENERADO POR DIA")
}, 5000);

})

//mensual
$(".imprime_mensual").click(function(){
    $(".loader").fadeIn("slow");
   
   miventa= window.open (`reporte/mensual.php`,"toolbar=no, fullscreen=no, channelmode=no, scrollbars=no, resizable=yes, top=10, left=10, width=10, height=10")
   miventa.close();   // Closes the new window

   setTimeout(function()
   {    alertify.warning("GENERANDO--ESPERE POR FAVOR")  }, 100);
setTimeout(function()
{$(".loader").fadeOut("slow");

alertify.warning("ARCHIVO GENERADO POR MES")
}, 5000);

})
});
   
</script>';
