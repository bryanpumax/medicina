
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
            case 7:
            $eli = '<body onload="existencia2();"></body> '; 
            
            break;
    }


    return $eli;
}
function formulario($id)
{

    if (isset($id)) {
        $cn = conectar();
        $sql = "SELECT * FROM tbl_operador WHERE idx_operador =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
        $tbl_operador = mysqli_fetch_array($res);
    } else {
        $tbl_operador['idx_operador'] = null;
        $tbl_operador['ced_operador'] = null;
        $tbl_operador['nom_operador'] = null;
        $tbl_operador['ape_operador'] = null;
        $tbl_operador['tel_operador'] = null;
        $tbl_operador['dir_operador'] = null;
        $tbl_operador['email_operador'] = null;
        $tbl_operador['usu_operador'] = null;
        $tbl_operador['pass_operador'] = null;
        $tbl_operador['rol_operador'] = '1';
        $tbl_operador['img_operador'] = 'foto.jpg';
    }
    $cont = ' 
    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-4">
        <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario de operador</h5>
          
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal"   name="tbl_operador" action="" method="POST"  onSubmit="return validaop(this);" enctype="multipart/form-data"> 

                <div class="form-group">
                    <label for="text1" class="control-label  col-lg-4 col-md-4 col-sm-4">Cedula</label>
 
                    <div class=" col-lg-8 col-md-8 col-sm-8">
                        <input type="text" id="ced_operador" name="ced_operador" placeholder="Cedula" value="' .  $tbl_operador['ced_operador'] . '" class="form-control"
                        onchange="validarcedula()"   onkeypress="return  numeros(event);" onkeyup="return limitar(event,this.value,10);" onkeydown="return limitar(event,this.value,10);">
                        <labell id="opuesto" name="opuesto" class=""> </label>
                        </div>
                        
               
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                <label for="pass1" class="control-label col-md-4 col-sm-4 col-lg-4">Nombre Apellido</label>


                <div class="  col-lg-4 col-md-4 col-sm-4">

                        <input class="form-control" type="text" id="nom_operador"  name="nom_operador"  placeholder="Nombre"
                        value="' .  $tbl_operador['nom_operador'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                        onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                        >
                    </div>
                       <div class="  col-lg-4 col-md-4 col-sm-4">
                        <input class="form-control" type="text" id="ape_operador" name="ape_operador"   placeholder="Apellido"
                        onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                        value="' .  $tbl_operador['ape_operador'] . '"     data-original-title="Please use your secure password" data-placement="top" >
                    </div>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Telefono</label>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="tel_operador" name="tel_operador"   placeholder="Telefono"
                    onkeypress="return  numeros(event);" onkeyup="return limitar(event,this.value,10);" onkeydown="return limitar(event,this.value,10);"
                    value="' .  $tbl_operador['tel_operador'] . '"     data-original-title="Please use your secure password" data-placement="top" >
                </div>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
            <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Direccion</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input class="form-control" type="text" id="dir_operador" name="dir_operador"   placeholder="Direccion"
                onkeypress="return  letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                value="' .  $tbl_operador['dir_operador'] . '"     data-original-title="Please use your secure password" data-placement="top" >
            </div>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for="pass1" class="control-label col-lg-4 col-md-4 col-sm-4">Correo electronico</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input class="form-control" type="text" id="email_operador" name="email_operador"   placeholder="mail@domain.com"
                value="' .  $tbl_operador['email_operador'] . '"     data-original-title="Please use your secure password" data-placement="top" >
            </div>
        </div>
   
   
<!-- /.form-group -->  
 <!-- imagen-->
 <div class="form-group">
 <label   class="control-label col-lg-4 col-md-4 col-sm-4">Imagen</label>
 <div class="col-lg-4 col-md-4 col-sm-4">
     <div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
<img       data-src="holder.js/100%x100%"  src="../assets/imagen/operador/' .  $tbl_operador['img_operador'] . '"      alt="...">

</div>
<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
</div>
<div>
<span class="btn btn-default btn-file">
<span class="fileinput-new">Select image</span>
<span class="fileinput-exists">Change</span>
<input type="file" name="img_operador" id="img_operador"></span>
<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
</div>
</div>

 </div>
</div>
                    
      
 
<div class="form-actions  ">
<input type="hidden" name="idx_operador" id="idx_operador"  value="' .  $tbl_operador['idx_operador'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}
//tbl_operador <option value="0">Dueño de la  mascota</option>




function elimina_tbl_operador($id)
{

    $cn = conectar();
    $sql = "call p_e_operador (" . $id . ");";
    $sqlval = "SELECT * from tbl_perdido tbl_p,tbl_operador tbl_o  where tbl_p.idx_operador=tbl_o.idx_operador 
    and tbl_o.idx_operador=" . $id . "";
    if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
        
        echo mensaje('1');
        echo consulta();
} else {

        if (mysqli_query($cn, $sql)) {
            $_GET['gettis'] = null;
            echo mensaje('2');
            echo consulta();
           
        } else {
            $_GET['gettis'] = null;
            echo mensaje('3');
        
        }
    }
    //
}
//tbl_operador
function registro($tbl_operador)
{
    $ced_operador =  limpiar_cadena_sin_espacio($tbl_operador['ced_operador']);
    $nom_operador = strtoupper(limpiar_cadena($tbl_operador['nom_operador']));
    $ape_operador =  strtoupper(limpiar_cadena($tbl_operador['ape_operador']));
    $tel_operador = limpiar_cadena_sin_espacio($tbl_operador['tel_operador']);
    $dir_operador = strtoupper(limpiar_cadena($tbl_operador['dir_operador']));
    $email_operador = (limpiar_cadena_email($tbl_operador['email_operador']));
    $usu_operador = 'us-'.(limpiar_cadena_sin_espacio($tbl_operador['ced_operador']));
    $pass_operador = 'us-'.(limpiar_cadena_sin_espacio($tbl_operador['ced_operador']));
    $rol_operador = '1';
   
    $formatos   = array('.jpg');
	$directorio = '../assets/imagen/operador/'; 
        $nombreArchivo    = $_FILES['img_operador']['name'];
		$nombreTmpArchivo = $_FILES['img_operador']['tmp_name'];
		$ext              = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
      $img_operador = $ced_operador .'.jpg' ;

    $cn = conectar();
    //codigo de actualización 
    $sqlval1 = "select * from tbl_operador where tbl_operador.ced_operador='".$ced_operador."';";
    $sqlval2 = "select * from tbl_operador where  tbl_operador.email_operador='". $email_operador."'";
 
    if ($tbl_operador['idx_operador']   != null) {
        if ($nombreArchivo == "") {
            
            $sql = "UPDATE tbl_operador 
		SET 
        ced_operador = '" . $ced_operador . "',
        nom_operador = upper('" . $nom_operador . "'),
        ape_operador = upper('" . $ape_operador . "'),
        tel_operador = '" . $tel_operador . "',
        dir_operador=upper('" . $dir_operador . "'),
         email_operador='" . $email_operador . "',
         img_operador='foto.jpg'
		 WHERE idx_operador = " . $tbl_operador['idx_operador']  . " ";
        } else {
            
            $sql = "UPDATE tbl_operador 
		SET 
        ced_operador = '" . $ced_operador . "',
        nom_operador = upper('" . $nom_operador . "'),
        ape_operador = upper('" . $ape_operador . "'),
        tel_operador = '" . $tel_operador . "',
        dir_operador=upper('" . $dir_operador . "'),
         email_operador='" . $email_operador . "',
         img_operador='" . $img_operador . "'
		 WHERE idx_operador = " . $tbl_operador['idx_operador']  . " ";
        }
        
        if (mysqli_query($cn, $sql)) {
            if (in_array($ext, $formatos)){
                if (move_uploaded_file($nombreTmpArchivo, "$directorio/$img_operador")){
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
            echo mensaje(6);
            $_GET['gettis'] = null;
        } else {

            echo  mensaje(3);
            $_GET['gettis'] = null;
        }
    } else {
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval1)) > 0) {
            echo mensaje('4');
            
        }else if (mysqli_num_rows(mysqli_query(conectar(), $sqlval2)) > 0) {
            echo mensaje('7');
            
        }else{
        if ($nombreArchivo == "") {
            
            $sql1 = "call  p_i_operador('" . $ced_operador . "', upper('" . $nom_operador . "'),upper( '" . $ape_operador . "'), '" . $tel_operador . "', upper('" . $dir_operador . "'), '" . $email_operador . "', '" . $usu_operador . "', '" . $pass_operador . "', 1,'Vendedor' ,'foto.jpg');";
        } else {
            $sql1 = "call  p_i_operador('" . $ced_operador . "', upper('" . $nom_operador . "'),upper( '" . $ape_operador . "'), '" . $tel_operador . "', upper('" . $dir_operador . "'), '" . $email_operador . "', '" . $usu_operador . "', '" . $pass_operador . "', 1, 'Vendedor','".$img_operador."');";
        }
        if (mysqli_query($cn, $sql1)) {
            if (in_array($ext, $formatos)){if (move_uploaded_file($nombreTmpArchivo, "$directorio/$img_operador")){
                echo "<script>
            alertify.success('LA IMAGEN   FUE ALMACENADA CORRECTAMENTE'); 
             </script>";
            }else{echo "<script>
                alertify.error('OCURRIÓ UN ERROR SUBIENDO EL ARCHIVO  AL  SERVIDOR'); 
                 
                </script>";}}else{echo '';}
            echo mensaje(5);
            $_GET['gettis'] = null;
        } else {
            echo $sql1;
            $_GET['gettis'] = null;
           echo mensaje(3);
        }
    }
     
    }
}


function consulta()
{
    $idx_operador=$_SESSION['idx_operador'];
    $sql = "SELECT * FROM `tbl_operador` ORDER BY `tbl_operador`.`rol_operador` ASC ;";
    $res = mysqli_query(conectar(), $sql);
    $tabla="view_operador ";
    $arch="OPERADOR";
    $campo="idx_operador";
    $arriba="menorth width='2px'>CEDULA menor/th>
       menorth width='10px'>OPERADOR menor/th>
       menorth width='2px'>TEL menor/th>
       menorth width='10px'>DIRECCION menor/th>
       menorth width='10px'>EMAIL menor/th>
       menorth width='10px'>ROL menor/th>
       ";
   $n=6;

    echo ' 
 
        
            <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Operador</h5>
<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  
<a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
</div> 
</header>
 
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>
    
    <tr>
        <th class="hidden-xs" >Cedula</th>
        <th>Nombre Apellido</th>
        <th class="hidden-xs">Telefono</th>
        <th class="hidden-xs">Direccion</th>
        <th class="hidden-xs">Email</th>
        <th>Actividades</th>
    </tr>
    </thead>
    <tbody  >';

    while ($operador = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td class="hidden-xs" >' . $operador['ced_operador'] . '</td> 
<td class="mayuscula">' . ($operador['nom_operador']) . ' ' . ($operador['ape_operador']) . '</td> 
<td class="hidden-xs" >' . $operador['tel_operador'] . '</td> 
<td class="hidden-xs mayuscula" >' . ($operador['dir_operador']) . '</td> 
  
<td class="hidden-xs" >' . ($operador['email_operador']) . '</td> 
<td ><a href="index.php?id=' . $operador['idx_operador'] . '&gettis=editar"> <button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>'; 
if($idx_operador!=$operador['idx_operador']){
echo '<a href="index.php?id=' . $operador['idx_operador'] . '&gettis=eliminar"><button class="btn  btn-danger"><i class="fas fa-trash"></i></button></a>';
}
echo '

<a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$operador['idx_operador'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
</td>   </tr>';
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