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

        $sql = "SELECT * FROM tbl_medico tblc WHERE tblc.idxm =  " . $id . " ;";
        $res = mysqli_query(conectar(), $sql);
        $tbl_medico = mysqli_fetch_array($res);
        $idr=$tbl_medico['ruta'];
        $ide=$tbl_medico['especialidad'];
        $sqlciudad_con = "SELECT * FROM tbl_ciudades,tbl_rutas WHERE tbl_ciudades.idx_ciudades=tbl_rutas.idx_rutas and tbl_rutas.idx_rutas =  " .$idr . " ;";
        $res_ciudad_con= mysqli_query(conectar(), $sqlciudad_con);
        $sqlciudad = "SELECT * FROM tbl_ciudades";$res_ciudad = mysqli_query(conectar(), $sqlciudad);
        $tbl_ciudad = mysqli_fetch_array($res_ciudad_con);
        $v_cid=$tbl_ciudad['idx_ciudades'];
        $v_cn=$tbl_ciudad['nom_ciudades'];
        
        $sql3 = "SELECT * FROM  tbl_especialidades ;";
        $res2 = mysqli_query(conectar(), $sql3);
        //
         $sql_espe = "SELECT * FROM  tbl_especialidades where tbl_especialidades.idx_especialidades=$ide ;";
        $res_espe = mysqli_query(conectar(), $sql_espe);
        
        $tbl_medico3 = mysqli_fetch_array($res_espe);
    $espe=$tbl_medico3['esp_especialidades'];
        $sql4 = "SELECT * FROM tbl_rutas WHERE  tbl_rutas.idx_rutas =  " .$idr . " ;";
        $res4= mysqli_query(conectar(), $sql4);
        $tb_ruta = mysqli_fetch_array($res4);
    $id=$idr;
    $nom=$tb_ruta['nom_rutas'];
    } 
    $cont = ' 
    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario Medico</h5>
 
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal" enctype="multipart/form-data" name="tbl_medico" action="" method="POST"  onSubmit="return validacl(this);"> 

               

                <div class="form-group">
                    <label for="pass1" class="control-label col-md-4 col-sm-4 col-lg-4">Nombre Apellido</label>

                    <div class="col-lg-8 col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="nom_medi" name="nom_medi"   placeholder="Apellido"
                    value="' .  $tbl_medico['nom_medi'] . '"     data-original-title="Please use your secure password" data-placement="top" 
                    onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
                    >
                </div>
                </div>
          
                
<!-- /.form-group -->  
<div class="form-group">
<label for="pass1" class="control-label col-md-4 col-sm-4 col-lg-4">Direccion</label>

<div class="col-lg-8 col-md-8 col-sm-8">
<input class="form-control" type="text" id="dir_medico" name="dir_medico"   placeholder="Direccion"
value="' .  $tbl_medico['dir_medico'] . '"     data-original-title="Please use your secure password" data-placement="top" 
onkeypress="return  letra(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);"
>
</div>
</div>


<!-- /.form-group -->  
            <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ciudad</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <select data-placeholder="Your Favorite Football Team" onchange="CargarProductos(this.value);" class="form-control chzn-select mayuscula" tabindex="5" name="idx_ciudadesselect" id="idx_ciudadeselect">
                        <option value="'.$v_cid.'">'.$v_cn.'</option>';
    while ($ciudades = mysqli_fetch_array($res_ciudad)) {
        $cont .= '<option value="' . $ciudades['idx_ciudades'] . '">' . ($ciudades['nom_ciudades']) . '</option>';
    }

    $cont .= ' </select>
                </div>
            </div>
            <!-- /.form-group -->  
            <div id="respuesta"></div>
            <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione ruta</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <select data-placeholder="Your Favorite Football Team" class="form-control chzn-select mayuscula" tabindex="5" name="idx_ruta" id="idx_ruta">
                    <option value="'.$id.'">'.$nom.'</option>
                    </select>
                </div>
            </div>
                <!-- /.form-group -->
               
              
     
      
                <div class="form-group espacio">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">Seleccione especialidad</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8 espacio">
                    <select data-placeholder="Your Favorite Football Team"  class="form-control chzn-select mayuscula" tabindex="5" name="idx_especialidades" id="idx_especialidades">
                        <option  value="'.$ide.'">'.$espe.'</option>';
    while ($ciudades = mysqli_fetch_array($res2)) {
        $cont .= '<option  value="' . $ciudades['idx_especialidades'] . '">' . ($ciudades['esp_especialidades']) . '</option>';
    }

    $cont .= ' </optgroup></select>
                </div>
            </div>
            <!-- /.form-group -->  
 
                 
<div class="form-actions  ">
<input type="hidden" name="idxm" id="idxm"  value="' .  $tbl_medico['idxm'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div> 
</div>';
    return $cont;
}
//tbl_medico <option value="0">Dueño de la  mascota</option>


function elimina_tbl_medico($id)
{

     $sql = "DELETE from tbl_medico where tbl_medico.idxm=" . $id . ";";  
    //ced_medico
    $sqlval = "SELECT * from   tbl_visitas,tbl_medico where  tbl_visitas.cedu_visita=tbl_medico.ced_medico and
    tbl_medico.idxm=" . $id . "";
    if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
        echo mensaje('1');

        echo consulta();
    } else {

        if (mysqli_query(conectar(), $sql)) {
            echo mensaje('2');
            echo consulta();
        } else {
            echo mensaje('3');
            echo consulta();
        }
    }
    //
}
//tbl_medico
function registro($tbl_medico)
{
    
    $nom_medi = strtoupper((limpiar_cadena($tbl_medico['nom_medi'])));
    
    $nom_medi =  strtoupper((limpiar_cadena($tbl_medico['nom_medi'])));
    
    $dir_medico = strtoupper((limpiar_cadena($tbl_medico['dir_medico'])));
    
    $cel_clientes = (limpiar_cadena_sin_espacio($tbl_medico['idx_especialidades']));
    
    $idx_ruta =  limpiar_cadena_sin_espacio($tbl_medico['idx_ruta']);;

    //codigo de actualización 

    if ($tbl_medico['idxm']   != null) {

        $sql = "UPDATE tbl_medico 
		SET 
        
        nom_medi = '" . $nom_medi . "',
        dir_medico='" . $dir_medico . "',
        ruta='" .$idx_ruta . "',
        especialidad='" . $cel_clientes . "'
		 WHERE idxm = " . $tbl_medico['idxm']  . " ";



        if (mysqli_query(conectar(), $sql)) {
echo mensaje(6);
            $_GET['gettis'] = null;
        } else {
echo $sql;
            echo mensaje(3);
            $_GET['gettis'] = null;
        }
    } 
    
}

function consulta($rol)
{
    $idx_operador= $_SESSION['idx_operador'];
    if($rol==1){
        $tabla="v_medico  ";
        $arch="Medicos";
        $campo="idxm";
        $arriba="
           menorth width='2%'>Medico menor/th>
           menorth width='2%'>Direccion menor/th>
           menorth width='2%'>Localizacion menor/th>
           menorth width='2%'>Especialidades menor/th>
           
           ";
       $n=4;
        $sql = "SELECT * FROM `v_medico` where idx_operador=$idx_operador ORDER BY `Medico` ASC ;";
        $res = mysqli_query(conectar(), $sql);
    
    
        echo ' 
     
                <!--Begin Datatables-->
    <div class="row">
    <div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
    <div class="box">
    <header>
    <div class="icons"><i class="fa fa-table"></i></div>
    <h5>Medico</h5>
    <div class="pull-right" style="margin:.2em">
     
    <a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
    <i class="fas fa-print"></i></button></a>  
    </div> 
    </header>
    <br>
    <div id="collapse6" class="body ">
     
    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
        <thead>
        
        <tr>
            
            <th width="25%">Nombre Apellido</th>
            <th class="hidden-xs" width="25%">Direccion</th>
            <th class="hidden-xs" width="25%">Localizacion</th>
            <th class="hidden-xs" width="15%">Especialidad</th>
            <th width="15%">Actividades</th>
        </tr>
        </thead>
        <tbody>';
    
        while ($operador = mysqli_fetch_array($res)) {
    
            echo '
    <tr > 
    
    
    <td  >' .  $operador['Medico'] . '</td> 
      
    <td class="hidden-xs" >' . $operador['Direccion'] . '</td> 
    <td class="hidden-xs" >' . $operador['Localizacion'] . '</td> 
    <td class="hidden-xs" >' . $operador['esp_especialidades'] . '</td> 
    <td ><a href="index.php?id=' . $operador['idxm'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a> 
     
    <a href="index.php?id=' . $operador['idxm'] . '&gettis=eliminar"> <button class=" BTN btn-danger"><i class="fas fa-trash"></i></button></a>
    <a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
    &n='.$n.'&id='.$operador['idxm'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
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
        $tabla="v_medico  ";
        $arch="Medicos";
        $campo="idxm";
        $arriba="
           menorth width='2%'>Medico menor/th>
           menorth width='2%'>Direccion menor/th>
           menorth width='2%'>Localizacion menor/th>
           menorth width='2%'>Especialidades menor/th>
           
           ";
       $n=4;
        $sql = "SELECT * FROM `v_medico` inner join view_operador on
        v_medico.idx_operador=view_operador.idx_operador
        
           ORDER BY `Medico` ASC ;";
        $res = mysqli_query(conectar(), $sql);
    
    
        echo ' 
     
                <!--Begin Datatables-->
    <div class="row">
    <div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
    <div class="box">
    <header>
    <div class="icons"><i class="fa fa-table"></i></div>
    <h5>Medico</h5>
    <div class="pull-right" style="margin:.2em">
     
    <a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
    <i class="fas fa-print"></i></button></a>  
    </div> 
    </header>
    <br>
    <div id="collapse6" class="body ">
     
    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
        <thead>
        
        <tr>
            
            <th width="25%">Nombre Apellido</th>
            <th class="hidden-xs" width="25%">Direccion</th>
            <th class="hidden-xs" width="25%">Localizacion</th>
            <th class="hidden-xs" width="15%">Especialidad</th>
            <th class="hidden-xs" width="15%">Operador</th>
            <th width="15%">Actividades</th>
        </tr>
        </thead>
        <tbody>';
    
        while ($operador = mysqli_fetch_array($res)) {
    
            echo '
    <tr > 
    
    
    <td  >' .  $operador['Medico'] . '</td> 
      
    <td class="hidden-xs" >' . $operador['Direccion'] . '</td> 
    <td class="hidden-xs" >' . $operador['Localizacion'] . '</td> 
    <td class="hidden-xs" >' . $operador['esp_especialidades'] . '</td> 
    <td class="hidden-xs" >' . $operador['operador'] . '</td> 
    <td ><a href="index.php?id=' . $operador['idxm'] . '&gettis=editar"><button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a> 
     
    <a href="index.php?id=' . $operador['idxm'] . '&gettis=eliminar"> <button class=" BTN btn-danger"><i class="fas fa-trash"></i></button></a>
    <a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
    &n='.$n.'&id='.$operador['idxm'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
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

 