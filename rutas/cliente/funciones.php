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

        $sql = "SELECT * FROM tbl_clientes tblc,tbl_rutas tblr,tbl_ciudades tblcd WHERE tblr.idx_ciudades=tblcd.idx_ciudades and tblr.idx_rutas=tblc.idx_rutas and  tblc.idx_clientes =  " . $id . " ;";
        $res = mysqli_query(conectar(), $sql);
        $res1 = mysqli_query(conectar(), $sql);
        $tbl_clientes = mysqli_fetch_array($res);
    } else {
        $tbl_clientes['idx_clientes'] = null;
        $tbl_clientes['cru_clientes'] = null;
        $tbl_clientes['nom_clientes'] = null;
        $tbl_clientes['ape_clientes'] = null;
        $tbl_clientes['telf_clientes'] = null;
        $tbl_clientes['dir_clientes'] = null;
        $tbl_clientes['email_clientes'] = null;
        $tbl_clientes['cel_clientes'] = null;
        $tbl_clientes['emp_clientes'] = null;
        $tbl_clientes['rol_operador'] = '1';
        $tbl_clientes['cel_clientes'] = null;
        $sql = "SELECT * FROM  tbl_ciudades ;";
        $res1 = mysqli_query(conectar(), $sql);
    }
    $cont = ' 
    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario Cliente</h5>
 
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal" enctype="multipart/form-data" name="tbl_clientes" action="" method="POST"  onSubmit="return validacl(this);"> 

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4 col-md-4 col-sm-4">Cedula</label>

                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <input type="text" id="cru_clientes" name="cru_clientes" placeholder="Cedula" value="' .  $tbl_clientes['cru_clientes'] . '" class="form-control"
                        onchange="validarcedula()"   onkeypress="return  numeros(event);" onkeyup="return limitar(event,this.value,10);" onkeydown="return limitar(event,this.value,10);">
                        <labell id="opuesto" name="opuesto" class="transparente"> </label>
                    </div>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label for="pass1" class="control-label col-md-4 col-sm-4 col-lg-4">Nombre Apellido</label>

                    <div class="  col-lg-4 col-md-4 col-sm-4">
                        <input class="form-control" type="text" id="nom_clientes"  name="nom_clientes"  placeholder="Nombre"
                        value="' .  $tbl_clientes['nom_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                        onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                    <input class="form-control" type="text" id="ape_clientes" name="ape_clientes"   placeholder="Apellido"
                    value="' .  $tbl_clientes['ape_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                    onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                    >
                </div>
                </div>
          
                
<!-- /.form-group -->  
            <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ciudad</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <select data-placeholder="Your Favorite Football Team" onchange="CargarProductos(this.value);" class="form-control chzn-select mayuscula" tabindex="5" name="idx_ciudadesselect" id="idx_ciudadeselect">
                        <option value="0"></option><optgroup label="Ciudades">';
    while ($ciudades = mysqli_fetch_array($res1)) {
        $cont .= '<option value="' . $ciudades['idx_ciudades'] . '">' . ($ciudades['nom_ciudades']) . '</option>';
    }

    $cont .= ' </optgroup></select>
                </div>
            </div>
            <!-- /.form-group -->  
            <div id="respuesta"></div>
            <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ruta</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <select data-placeholder="Your Favorite Football Team" class="form-control chzn-select mayuscula" tabindex="5" name="idx_ruta" id="idx_ruta">
                    </optgroup></select>
                </div>
            </div>
                <!-- /.form-group -->
                <div class="form-group">
                <label for="pass1" class="control-label col-lg-4 col-lg-4 col-md-4 col-sm-4">Direccion</label>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="dir_clientes" name="dir_clientes"   placeholder="Direccion"
                    value="' .  $tbl_clientes['dir_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                    onkeypress="return  letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                    >
                </div>
            </div>
            
                <!-- /.form-group -->
                <div class="form-group">
                <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Telefono</label>
                <div class="col-lg-4 col-md-4 col-sm-4 ">
                    <input class="form-control" type="text" id="telf_clientes" name="telf_clientes"   placeholder="Telefono"
                    value="' .  $tbl_clientes['telf_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                    onkeypress="return  numeros(event);" onkeyup="return limitar(event,this.value,10);" onkeydown="return limitar(event,this.value,10);">
                    </div>  
                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                <input class="form-control" type="text" id="cel_clientes" name="cel_clientes"   placeholder="Celular"
                value="' .  $tbl_clientes['cel_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                onkeypress="return  numeros(event);" onkeyup="return limitar(event,this.value,10);" onkeydown="return limitar(event,this.value,10);">
            </div>
            </div>
            
            <!-- /.form-group -->
         
        <div class="form-group">
            <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Correo electronico</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input class="form-control" type="text" id="email_clientes" name="email_clientes"   placeholder="mail@domain.com"
                value="' .  $tbl_clientes['email_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" >
            </div>
        </div>
        <!-- /.form-group -->
       <!-- <div class="form-group">
        <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Celular</label>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <input class="form-control" type="text" id="cel_clientes" name="cel_clientes"   placeholder="Celular"
            value="' .  $tbl_clientes['cel_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" >
        </div>
    </div>-->
    <!-- /.form-group -->
    <div class="form-group">
    <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Empresa</label>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <input class="form-control" type="text" id="emp_clientes" name="emp_clientes"   placeholder="Empresa"
        value="' .  $tbl_clientes['emp_clientes'] . '"     data-original-title="Please use your secure password" data-placement="top" 
        onkeypress="return  letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
        >
    </div>
</div>
<!-- /.form-group -->
 
                 
<div class="form-actions  ">
<input type="hidden" name="idx_clientes" id="idx_clientes"  value="' .  $tbl_clientes['idx_clientes'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div> 
</div>';
    return $cont;
}
//tbl_clientes <option value="0">Dueño de la  mascota</option>


function elimina_tbl_clientes($id)
{

    $sql = "call p_e_clientes(" . $id . ");";
    $sqlval = "SELECT * from   tbl_perdido,tbl_clientes tbl_o  where tbl_perdido.idx_clientes=tbl_o.idx_clientes 
    and tbl_o.idx_clientes=" . $id . "";
    if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
        echo mensaje('1');

       echo '<script>window.location="index.php";</script>';
    } else {

        if (mysqli_query(conectar(), $sql)) {
            echo mensaje('2');
           echo '<script>window.location="index.php";</script>';
        } else {
            echo mensaje('3');
           echo '<script>window.location="index.php";</script>';
        }
    }
    //
}
//tbl_clientes
function registro($tbl_clientes)
{
    $cru_clientes =  limpiar_cadena_sin_espacio($tbl_clientes['cru_clientes']);
    $nom_clientes = strtoupper((limpiar_cadena($tbl_clientes['nom_clientes'])));
    $_SESSION['nom_clientes']=$nom_clientes;
    $ape_clientes =  strtoupper((limpiar_cadena($tbl_clientes['ape_clientes'])));
    $telf_clientes = limpiar_cadena_sin_espacio($tbl_clientes['telf_clientes']);
    $dir_clientes = strtoupper((limpiar_cadena($tbl_clientes['dir_clientes'])));
    $email_clientes = (limpiar_cadena_email($tbl_clientes['email_clientes']));
    $cel_clientes = (limpiar_cadena_sin_espacio($tbl_clientes['cel_clientes']));
    $emp_clientes = strtoupper((limpiar_cadena_sin_espacio($tbl_clientes['emp_clientes'])));
    $idx_ruta =  limpiar_cadena_sin_espacio($tbl_clientes['idx_ruta']);;

    $sqlval1 = "select * from tbl_clientes where tbl_clientes.cru_clientes='" . $cru_clientes . "';";
    $sqlval2 = "select * from tbl_clientes where  tbl_clientes.email_clientes='" . $email_clientes . "'";
    $idx_operador= $_SESSION['idx_operador'];

    //codigo de actualización 

    if ($tbl_clientes['idx_clientes']   != null) {

        $sql = "UPDATE tbl_clientes 
		SET 
        cru_clientes = '" . $cru_clientes . "',
        nom_clientes = '" . $nom_clientes . "',
        ape_clientes = '" . $ape_clientes . "',
        telf_clientes = '" . $telf_clientes . "',
        dir_clientes='" . $dir_clientes . "',
         email_clientes='" . $email_clientes . "',
         cel_clientes='" . $cel_clientes . "'
		 WHERE idx_clientes = " . $tbl_clientes['idx_clientes']  . " ";



        if (mysqli_query(conectar(), $sql)) {
echo mensaje(6);
            $_GET['gettis'] = null;
        } else {

            echo mensaje(3);
            $_GET['gettis'] = null;
        }
    } else {
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval1)) > 0) {
            echo mensaje('4');
           
        } else if (mysqli_num_rows(mysqli_query(conectar(), $sqlval2)) > 0) {
            echo mensaje('7');
        } else {
            $sql1 = "call  p_i_clientes('" . $cru_clientes . "', '" .
                $nom_clientes . "', '" .
                $ape_clientes . "', " . $idx_ruta . ", '" .
                $dir_clientes . "', '" . $telf_clientes . "', '" .
                $cel_clientes . "', '" . $email_clientes . "', '" . $emp_clientes . "',".$idx_operador.");";



            if (mysqli_query(conectar(), $sql1)) {
                echo mensaje('5');
                $_GET['gettis'] = null;
            } else {
                echo mensaje('3');
                $_GET['gettis'] = null;
            }
        }
    }
}

function consulta($rol)
{
    $idx_operador= $_SESSION['idx_operador'];
    if($rol==1){
        $tabla="view_clientes  ";
        $arch="CLIENTES";
        $campo="idx_clientes";
        $arriba="menorth width='1%'>CEDULA menor/th>
           menorth width='2%'>CLIENTE menor/th>
           menorth width='2%'>CIUDAD menor/th>
           menorth width='2%'>RUTA menor/th>
           menorth width='2%'>DIRECCION menor/th>
           menorth width='2%'>EMPRESA menor/th>
           ";
       $n=6;
        $sql = "SELECT * FROM `tbl_clientes` where idx_operador=$idx_operador ORDER BY `tbl_clientes`.`ape_clientes` ASC ;";
        $res = mysqli_query(conectar(), $sql);
    
    
        echo ' 
     
                <!--Begin Datatables-->
    <div class="row">
    <div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
    <div class="box">
    <header>
    <div class="icons"><i class="fa fa-table"></i></div>
    <h5>Cliente</h5>
    <div class="pull-right" style="margin:.2em">
    <a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
    <i class="fas fa-plus-circle"></i></button></a>  
    <a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
    <i class="fas fa-print"></i></button></a>  
    </div> 
    </header>
    <br>
    <div id="collapse6" class="body ">
     
    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
        <thead>
        
        <tr>
            <th width="15%">Cedula</th>
            <th width="45%">Nombre Apellido</th>
            <th class="hidden-xs" width="25%">Email</th>
            <th width="15%">Actividades</th>
        </tr>
        </thead>
        <tbody>';
    
        while ($operador = mysqli_fetch_array($res)) {
    
            echo '
    <tr > 
    
    <td  >' . $operador['cru_clientes'] . '</td> 
    <td  >' . $operador['nom_clientes'] . ' ' . $operador['ape_clientes'] . '</td> 
      
    <td class="hidden-xs" >' . $operador['email_clientes'] . '</td> 
    <td ><a href="index.php?id=' . $operador['idx_clientes'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a> 
     
    <a href="index.php?id=' . $operador['idx_clientes'] . '&gettis=eliminar"> <button class=" BTN btn-danger"><i class="fas fa-trash"></i></button></a>
    <a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
    &n='.$n.'&id='.$operador['idx_clientes'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
    <i class="fas fa-print"></i></button></a>  
    
    ';
    
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
    $tabla="view_clientes  ";
    $arch="CLIENTES";
    $campo="idx_clientes";
    $arriba="menorth width='1%'>CEDULA menor/th>
       menorth width='2%'>CLIENTE menor/th>
       menorth width='2%'>CIUDAD menor/th>
       menorth width='2%'>RUTA menor/th>
       menorth width='2%'>DIRECCION menor/th>
       menorth width='2%'>EMPRESA menor/th>
       ";
   $n=6;
    $sql = "SELECT * FROM `tbl_clientes`  INNER JOIN tbl_operador on tbl_operador.idx_operador=tbl_clientes.idx_operador ORDER BY `tbl_clientes`.`ape_clientes` ASC ;";
    $res = mysqli_query(conectar(), $sql);


    echo ' 
 
            <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Cliente</h5>
<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  
<a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
</div> 
</header>
<br>
<div id="collapse6" class="body ">
 
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>
    
    <tr>
        <th width="15%">Cedula</th>
        <th width="45%">Nombre Apellido</th>
        <th class="hidden-xs" width="25%">Email</th>
        <th class="hidden-xs" width="35%">Operador</th>
        <th width="15%">Actividades</th>
    </tr>
    </thead>
    <tbody>';

    while ($operador = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td  >' . $operador['cru_clientes'] . '</td> 
<td  >' . $operador['nom_clientes'] . ' ' . $operador['ape_clientes'] . '</td> 
  
<td class="hidden-xs" >' . $operador['email_clientes'] . '</td> 
<td  >' . $operador['nom_operador'] . ' ' . $operador['ape_operador'] . '</td> 
<td ><a href="index.php?id=' . $operador['idx_clientes'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a> 
 
<a href="index.php?id=' . $operador['idx_clientes'] . '&gettis=eliminar"> <button class=" BTN btn-danger"><i class="fas fa-trash"></i></button></a>
<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$operador['idx_clientes'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  

';

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
 