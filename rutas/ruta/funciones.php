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
          
    }


    return $eli;
}
function formulario($id)
{
    $cn = conectar();
    if (isset($id)) {

        $sql = "SELECT * FROM tbl_rutas,tbl_ciudades WHERE tbl_ciudades.idx_ciudades=tbl_rutas.idx_ciudades and tbl_rutas.idx_rutas =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
        $res1 = mysqli_query($cn, $sql);
        $tbl_rutas = mysqli_fetch_array($res);
        $tbl_ciudades = mysqli_fetch_array($res1);
        $v0=$tbl_ciudades['idx_ciudades'];
        $vtext=$tbl_ciudades['nom_ciudades'];
    } else {
        $tbl_rutas['idx_rutas'] = null;
        $tbl_rutas['nom_rutas'] = null;
        $sql = "SELECT * FROM  tbl_ciudades ;";
        $res1 = mysqli_query($cn, $sql);
        $v0=0;
        $vtext="";
    }
    $cont = ' 
    <div class="row">
    <div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario de ruta</h5>
       
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal"  name="tbl_rutas" action="" method="POST"  onSubmit="return valida(this);"> 

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Ruta</label>

                    <div class="col-lg-8">
                        <input type="text" id="nom_rutas" name="nom_rutas" placeholder="Ruta" value="' .  $tbl_rutas['nom_rutas'] . '" class="form-control">
                    </div>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                <label class="control-label col-lg-4">Seleccione ciudad</label>
            
                <div class="col-lg-8">
                    <select data-placeholder="Your Favorite Football Team" class="form-control chzn-select mayuscula" tabindex="5" name="idx_ciudades" id="idx_ciudades">
                        <option value="'.$v0.'">'.$vtext.'</option> ';
    while ($ciudades = mysqli_fetch_array($res1)) {
        $cont .= '<option value="' . $ciudades['idx_ciudades'] . '">' . $ciudades['nom_ciudades'] . '</option>';
    }

    $cont .= '  </select>
                </div>
            </div>
<!-- /.form-group -->  
                
<div class="form-actions  ">
<input type="hidden" name="idx_rutas" id="idx_rutas"  value="' .  $tbl_rutas['idx_rutas'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}
//tbl_rutas <option value="0">Dueño de la  mascota</option>



function elimina_tbl_rutas($id)
{
    $cn = conectar();
    $sql = "call p_e_rutas(" . $id . ");";
    $sqlval = "SELECT * from tbl_clientes tbl_p,tbl_rutas tbl_o  where tbl_p.idx_rutas=tbl_o.idx_rutas 
    and tbl_o.idx_rutas=" . $id . "";
    if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
        echo mensaje('1');

        echo '<script>window.location="index.php";</script>';
    } else {

        if (mysqli_query($cn, $sql)) {
            echo mensaje('2');
            echo '<script>window.location="index.php";</script>';
        } else {
            echo mensaje('3');
            echo '<script>window.location="index.php";</script>';
        }
    }
    //
}
//tbl_rutas
function registro($tbl_rutas)
{
    $nom_rutas =  strtoupper(limpiar_cadena_sin_espacio($tbl_rutas['nom_rutas']));
    $idx_ciudades = (limpiar_cadena($tbl_rutas['idx_ciudades']));
   $idx_operador= $_SESSION['idx_operador'];
    

    $cn = conectar();
    //codigo de actualización 

    if ($tbl_rutas['idx_rutas']   != null) {

        $sql = "UPDATE tbl_rutas 
		SET 
        nom_rutas = '" . $nom_rutas . "',
        idx_ciudades =  " . $idx_ciudades . "  
        
		 WHERE idx_rutas = " . $tbl_rutas['idx_rutas']  . " ";


 
        if (mysqli_query($cn, $sql)) {
            echo mensaje('6');
        echo '<script>window.location="index.php";</script>';
        } else {

            echo mensaje('3');
        }
    } else {
        $sqlval = "select * from tbl_rutas where tbl_rutas.nom_rutas='".$nom_rutas."' and tbl_rutas.idx_ciudades=". $idx_ciudades.";";
        
        if (mysqli_num_rows(mysqli_query(conectar(), $sqlval)) > 0) {
            echo mensaje('4');
        } else {
        //inicio

        $sql1 = "call  p_i_ruta('" . $nom_rutas . "', " . $idx_ciudades . ",".$idx_operador.");";
        
        if (mysqli_query($cn, $sql1)) {
            echo mensaje('5');
           
        echo '<script>window.location="index.php";</script>';
        } else {
 
            echo mensaje('3');
        echo '<script>window.location="index.php";</script>';
        }
        //fin registro
    }
 
        
    }
}

function consulta($rol)
{
    $idx_operador= $_SESSION['idx_operador'];
    if($rol==1){
        $sql = "SELECT * FROM tbl_rutas,tbl_ciudades where tbl_ciudades.idx_ciudades=tbl_rutas.idx_ciudades 
    and idx_operador=$idx_operador
    ORDER BY `tbl_rutas`.`nom_rutas` ASC ;";
    $res = mysqli_query(conectar(), $sql);
    $tabla="view_rutas ";
    $arch="RUTA";
    $campo="idx_rutas";
    $arriba="menorth width='3%'>CIUDAD menor/th>
       menorth width='5%'>RUTA menor/th>
             
       ";
   $n=2;

    echo ' 
 
        
            <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Ruta</h5>
 
<div class="pull-right" style="margin:.2em">
<a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
<i class="fas fa-plus-circle"></i></button></a>  
<a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-print"></i></button></a>  
</div> 
</header>
<div id="collapse3" class="body">
 
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
    <thead>
    
    <tr>
        <th width=40% >Ciudad</th>
        <th width=40%>Ruta</th>
        <th width=40%>Actividades</th>
    </tr>
    </thead>
    <tbody class="mayuscula">';

    while ($operador = mysqli_fetch_array($res)) {

        echo '
<tr > 

<td  >' . $operador['nom_ciudades'] . '</td> 
<td  >' . $operador['nom_rutas'] . '</td> 
<td ><a href="index.php?id=' . $operador['idx_rutas'] . '&gettis=eliminar"> <button title="Eliminar" class=" btn btn-danger"><i class="fas fa-trash"></i></button></a>
 <a href="index.php?id=' . $operador['idx_rutas'] . '&gettis=editar"> <button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>
 <a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
&n='.$n.'&id='.$operador['idx_rutas'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
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
        $sql = "SELECT * FROM tbl_rutas,tbl_ciudades,tbl_operador where tbl_ciudades.idx_ciudades=tbl_rutas.idx_ciudades 
        and tbl_rutas.idx_operador=tbl_operador.idx_operador
        ORDER BY `tbl_rutas`.`nom_rutas` ASC ;";
        $res = mysqli_query(conectar(), $sql);
        $tabla="view_rutas ";
        $arch="RUTA";
        $campo="idx_rutas";
        $arriba="menorth width='3%'>CIUDAD menor/th>
           menorth width='5%'>RUTA menor/th>
                 
           ";
       $n=2;
    
        echo ' 
     
            
                <!--Begin Datatables-->
    <div class="row">
    <div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
    <div class="box">
    <header>
    <div class="icons"><i class="fa fa-table"></i></div>
    <h5>Ruta</h5>
     
    <div class="pull-right" style="margin:.2em">
    <a href="index.php?gettis=nuevo"><button title="Nuevo"  class=" btn btn-primary">
    <i class="fas fa-plus-circle"></i></button></a>  
    <a href="../imprimir/crearPdf.php?gettis=1&tabla='.$tabla.'&arriba='.$arriba.'&n='.$n.'&arch='.$arch.'"><button title="imprimir"  class=" btn btn-info">
    <i class="fas fa-print"></i></button></a>  
    </div> 
    </header>
    <div id="collapse3" class="body">
     
    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
        <thead>
        
        <tr>
            <th width=40% >Ciudad</th>
            <th width=40%>Ruta</th>
            <th width=40%>Operador</th>
            <th width=40%>Actividades</th>
        </tr>
        </thead>
        <tbody class="mayuscula">';
    
        while ($operador = mysqli_fetch_array($res)) {
    
            echo '
    <tr > 
    
    <td  >' . $operador['nom_ciudades'] . '</td> 
    <td  >' . $operador['nom_rutas'] . '</td> 
    <td  >' . $operador['nom_operador'] . ' ' . $operador['ape_operador'] . '</td> 
    <td ><a href="index.php?id=' . $operador['idx_rutas'] . '&gettis=eliminar"> <button title="Eliminar" class=" btn btn-danger"><i class="fas fa-trash"></i></button></a>
     <a href="index.php?id=' . $operador['idx_rutas'] . '&gettis=editar"> <button title="Editar" class="  btn btn-success"><i class="fas fa-edit"></i></button> </a>
     <a href="../imprimir/crearPdf.php?gettis=2&tabla='.$tabla.'&arriba='.$arriba.'&arch='.$arch.'
    &n='.$n.'&id='.$operador['idx_rutas'] .'&campo='.$campo.' "><button title="imprimir"  class=" btn btn-info">
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

?> 