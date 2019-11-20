
<?php
include("../include/conexion.php");

function fech($f){
    $idx_operador= $_SESSION['idx_operador'];
    $rol=$_SESSION['rol_operador'];
   $variable1= $f['fecha1'];
   $variable2= $f['fecha2'];
   if($rol==1){
    $sql = "SELECT * FROM tbl_diario where idx_operador=$idx_operador and 
    DATE(fec_informe) BETWEEN '$variable1' AND '$variable2'";
 
    $res = mysqli_query(conectar(), $sql);
    $fecha=date("Y-m-d");
 
    echo ' 
 
            <!--Begin Datatables-->
 <div class="row">
 <div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
 <div class="box">
 <header>
 <div class="icons"><i class="fa fa-table"></i></div>
 <h5>Bandeja de Reportes Generados</h5>
 </header>
 <br>
 <div id="collapse6" class="body ">
 
 <form action="" method="post">
 
 Fecha desde: <input type="date" name="fecha1" id="fecha1" class="bootstrap-datetimepicker-widget" value="'.$fecha.'">  &nbsp;&nbsp;
 Fecha hasta: <input type="date" name="fecha2" id="fecha2" value="'.$fecha.'" class="bootstrap-datetimepicker-widget">
 <button id="bsc" name="bsc" class="btn btn-info" type="submit">Buscar<i class="fas fa-search"></i></button>
 
 </form>
 
 <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
 
 
    <thead>
    
    <tr>
    <th class="hidden-xs" width="13%">Nro</th>
 
        <th width="15%">Fecha</th>
        <th width="50%">Archivo</th>
        <th width="25%">Estado</th>
        
        <th width="10%">Ver</th>
    </tr>
    </thead>
    <tbody>';
 
    while ($operador = mysqli_fetch_array($res)) {
 
        echo '
 <tr > 
 <td  class="hidden-xs">' . $operador['Nro_informe'] . '</td> 
 
 <td  >' .strtoupper( $operador['fec_informe']) . '</td> 
 
 <td  >' . $operador['rut_informe'] . '</td>'; 
 
 
 if($operador['est_informe']=="Generado" || $operador['est_informe']=="Generado Mensua"){;
 
    echo '<td class="bg-blue" >' . $operador['est_informe'] . '</td>'; 
    
    } else {
    
        echo '<td class="bg-yellow" >' . $operador['est_informe'] . '</td>'; 
    
    }
 
 echo '<td >
 
 
 <a href="../visita/reporte/'.$operador['rut_informe'].' "><button title="imprimir"  class=" btn btn-info">
 <i class="fas fa-eye"></i></button></a> 
 
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
    $sql = "SELECT * FROM tbl_diario where  
    DATE(fec_informe) BETWEEN '$variable1' AND '$variable2'";
 
    $res = mysqli_query(conectar(), $sql);
    $fecha=date("Y-m-d");
 
    echo ' 
 
            <!--Begin Datatables-->
 <div class="row">
 <div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
 <div class="box">
 <header>
 <div class="icons"><i class="fa fa-table"></i></div>
 <h5>Bandeja de Reportes Generados</h5>
 </header>
 <br>
 <div id="collapse6" class="body ">
 
 <form action="" method="post">
 
 Fecha desde: <input type="date" name="fecha1" id="fecha1" class="bootstrap-datetimepicker-widget" value="'.$fecha.'">  &nbsp;&nbsp;
 Fecha hasta: <input type="date" name="fecha2" id="fecha2" value="'.$fecha.'" class="bootstrap-datetimepicker-widget">
 <button id="bsc" name="bsc" class="btn btn-info" type="submit">Buscar<i class="fas fa-search"></i></button>
 
 </form>
 
 <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
 
 
    <thead>
    
    <tr>
    <th class="hidden-xs" width="13%">Nro</th>
 
        <th width="15%">Fecha</th>
        <th width="50%">Archivo</th>
        <th width="25%">Estado</th>
        
        <th width="10%">Ver</th>
    </tr>
    </thead>
    <tbody>';
 
    while ($operador = mysqli_fetch_array($res)) {
 
        echo '
 <tr > 
 <td  class="hidden-xs">' . $operador['Nro_informe'] . '</td> 
 
 <td  >' .strtoupper( $operador['fec_informe']) . '</td> 
 
 <td  >' . $operador['rut_informe'] . '</td>'; 
 
 
 if($operador['est_informe']=="Generado" || $operador['est_informe']=="Generado Mensua"){;
 
    echo '<td class="bg-blue" >' . $operador['est_informe'] . '</td>'; 
    
    } else {
    
        echo '<td class="bg-yellow" >' . $operador['est_informe'] . '</td>'; 
    
    }
 
 echo '<td >
 
 
 <a href="../visita/reporte/'.$operador['rut_informe'].' "><button title="imprimir"  class=" btn btn-info">
 <i class="fas fa-eye"></i></button></a> 
 
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
function consulta($rol)
{
 
$idx_operador= $_SESSION['idx_operador'];
if($rol==1){
 
    $sql = "SELECT * FROM tbl_diario where idx_operador=$idx_operador ";
    $res = mysqli_query(conectar(), $sql);
    $fecha=date("Y-m-d");

    echo ' 
 
            <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Bandeja de Reportes Generados</h5>
</header>
<br>
<div id="collapse6" class="body ">

<form action="" method="post">

Fecha desde: <input type="date" name="fecha1" id="fecha1" class="bootstrap-datetimepicker-widget" value="'.$fecha.'">  &nbsp;&nbsp;
Fecha hasta: <input type="date" name="fecha2" id="fecha2" value="'.$fecha.'" class="bootstrap-datetimepicker-widget">
<button id="bsc" name="bsc" class="btn btn-info" type="submit">Buscar<i class="fas fa-search"></i></button>

</form>

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">


    <thead>
    
    <tr>
    <th class="hidden-xs" width="13%">Nro</th>
 
        <th width="15%">Fecha</th>
        <th width="50%">Archivo</th>
        <th width="25%">Estado</th>
        
        <th width="10%">Ver</th>
    </tr>
    </thead>
    <tbody>';

    while ($operador = mysqli_fetch_array($res)) {

        echo '
<tr > 
<td  class="hidden-xs">' . $operador['Nro_informe'] . '</td> 
 
<td  >' .strtoupper( $operador['fec_informe']) . '</td> 

<td  >' . $operador['rut_informe'] . '</td>'; 


if($operador['est_informe']=="Generado" || $operador['est_informe']=="Generado Mensua"){;

    echo '<td class="bg-blue" >' . $operador['est_informe'] . '</td>'; 
    
    } else {
    
        echo '<td class="bg-yellow" >' . $operador['est_informe'] . '</td>'; 
    
    }

echo '<td >
 

<a href="../visita/reporte/'.$operador['rut_informe'].' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-eye"></i></button></a> 

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
    $tabla="view_visitas_detalle";
    $arch="VISITAS";
    $campo="n_muestra";
    $arriba="menorth width='1%'>Fecha menor/th>
       menorth width='2%'>Cedula menor/th>
       menorth width='2%'>Nombre Apellido menor/th>
       menorth width='2%'>Direccion menor/th>
       menorth width='2%'>Especialidad menor/th>
       menorth width='2%'>RUTA menor/th>
     
       ";
   $n=6;
    $sql = "SELECT * FROM tbl_diario  ";
    $res = mysqli_query(conectar(), $sql);
 $fecha=date("Y-m-d");

    echo ' 
 
            <!--Begin Datatables-->
<div class="row">
<div class="col-xs-12 col-md-12  col-sm-12   col-lg-12">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Bandeja de Reportes Generados</h5>
</header>
<br>
<div id="collapse6" class="body ">
<form action="" method="post">

Fecha desde: <input type="date" name="fecha1" id="fecha1" class="bootstrap-datetimepicker-widget" value="'.$fecha.'">  &nbsp;&nbsp;
Fecha hasta: <input type="date" name="fecha2" id="fecha2" class="bootstrap-datetimepicker-widget">
<button id="bsc" name="bsc" class="btn btn-info" type="submit">Buscar<i class="fas fa-search"></i></button>

</form>
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>
    
    <tr>
    <th class="hidden-xs" width="13%">Nro</th>
 
        <th width="15%">Fecha</th>
        <th width="50%">Archivo</th>
        <th width="25%">Estado</th>
        
        <th width="10%">Ver</th>
    </tr>
    </thead>
    <tbody>';

    while ($operador = mysqli_fetch_array($res)) {

        echo '
<tr > 
<td  class="hidden-xs">' . $operador['Nro_informe'] . '</td> 
 
<td  >' .strtoupper( $operador['fec_informe']) . '</td> 

<td  >' . $operador['rut_informe'] . '</td>'; 


if($operador['est_informe']=="Generado" || $operador['est_informe']=="Generado Mensua"){;

    echo '<td class="bg-blue" >' . $operador['est_informe'] . '</td>'; 
    
    } else {
    
        echo '<td class="bg-yellow" >' . $operador['est_informe'] . '</td>'; 
    
    }

echo '<td >
 

<a href="../visita/reporte/'.$operador['rut_informe'].' "><button title="imprimir"  class=" btn btn-info">
<i class="fas fa-eye"></i></button></a> 

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
