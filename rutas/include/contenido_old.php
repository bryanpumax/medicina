<script src="include/index.js"></script>
<?php
function display_menu($level)
{
$hoy  =   date("d-m-Y")  ;
    $conexion = conectar();

    $sql = "SELECT * from tbl_menu where rol_menu between 0 and " . $level . " order by orden_menu;";
    mysqli_query($conexion, 'SET NAMES utf8');
    $result = mysqli_query($conexion, $sql);
    $nombre= $_SESSION['nom_operador'];
    $rol=  $_SESSION['rol_operador'];
    $ced_operador=$_SESSION['ced_operador'];

 
    $sql2 = "SELECT * from tbl_operador where ced_operador= " . $ced_operador . "  ;";
    $result2 = mysqli_query($conexion, $sql2);
    $operador=mysqli_fetch_array($result2); 
    $img_operador=$operador['img_operador'];
   $rol_operador=$operador['nrol_operador'];
    $contenido = '
   
<div class=" " id="wrap">
<div id="top">
    <!-- .navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid  red">


            <!-- Brand and toggle get grouped for better mobile display -->
            <header class="navbar-header">
 
                <a href="index.php" class="navbar-brand"><img src="assets/img/ruta.png" alt="" style="width:262px;!important; border-radius:2em;"></a>

            </header>

            <div class="topnav">
                <div class="btn-group">
                    <a href="logout.php" data-toggle="tooltip" data-original-title="Desconectar" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Ver / Ocultar" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </a>

                </div>

            </div>


    </nav>
    <!-- /.navbar -->
    <header class="head" id="menu">
        <div class="search-bar">
        </div>
        <!-- /.search-bar -->
        <div class="main-bar">
            <h3><i class="fa fa-home"></i>&nbsp;Rutas</h3>
        </div>
        <!-- /.main-bar -->
    </header>
    <!-- /.head -->
</div>
<!-- /#top -->
<div id="left">
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/imagen/operador/'.$img_operador.'">
                <span class="label label-danger user-label">'.$rol.'</span>
            </a>

            <div class="media-body">
                <h5 class="media-heading mayuscula">'.$nombre.'</h5>
                <ul class="list-unstyled user-info">
                    <li class="mayuscula">'.$rol_operador.' </li>
                    <li>Fecha actual : <br>
                        <small><i class="fa fa-calendar"></i>&nbsp;'.$hoy.'</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #menu -->
    <ul id="menu" class="  ">
        <li class="nav-header">Menu</li>
        <li class="nav-divider"></li>';
        
    while ($item = mysqli_fetch_array($result)) {
        $titulo = $item['etiq_menu'];
        $ico = $item['icono_menu'];
        $ruta=$item['ruta_menu'];
        $contenido .= '
        <li class="mayuscula">

        <a onclick="scrollWin()" target="iframe" href="'.$ruta.'">
            <i class="'.$ico.'"></i>
            <span class="link-title">'.$titulo.'</span>
        </a>

    </li>';
    }
      $contenido.='  
     <li>
     <a data-placement="bottom" data-original-title="Ver / Ocultar" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
     <i class="fa fa-bars"></i> </a></li>
   
       
    </ul>
    <!-- /#menu -->
</div>
<!-- /#left -->
<div id="content">
    <div class="outer">
    <!-- <div class="inner bg-light lter">
            <div class="col-lg-12 contenido">
                
            </div>-->
            <iframe src="index2.php" name="iframe" frameborder="0" class="col-xs-12 col-md-12 col-sm-12  col-lg-6 iframe inner bg-light lter"></iframe>
            <!--  </div>
       /.inner -->
    </div>
    <!-- /.outer -->
</div>
<!-- /#content -->

<div id="right" class="onoffcanvas is-right is-fixed bg-light" aria-expanded=false>
    <a class="onoffcanvas-toggler" href="#right" data-toggle=onoffcanvas aria-expanded=false></a>
    <br><br>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> </strong> 
    </div>
    <!-- .well well-small -->
    <div class="well well-small dark">
        <ul class="list-unstyled">
            <li>  <span class="inlinesparkline pull-right"> </span></li>
            <li>  <span class="dynamicsparkline pull-right"> </span></li>
            <li>  <span class="dynamicbar pull-right"> </span></li>
            <li>  <span class="inlinebar pull-right"> </span></li>
        </ul>
    </div>

 
</div></div>'.
 
  footer('2019','SVM').'';
    return $contenido;
    mysqli_close($conexion);
}
 
function footer($año,$autor){
  echo '<footer class="Footer bg-dark dker">
    <p>'.$año.' &copy; '.$autor.'</p>
</footer>';
    
}
?>

 
