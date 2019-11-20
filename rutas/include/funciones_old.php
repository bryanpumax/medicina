 
<?php

 
function get_form()
{

  $contenido = ' 
 
<body class="login">

      <div class="form-signin" style="margin-top:5em;">
    <div class="text-center">
        <img src="assets/img/ruta.png" alt="Logo" style="width:268px!important">
    </div>
    <hr>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="index.php"  method="post" onSubmit="return validalogin(this);">
                <p class="text-muted text-center">
                    Ingresar con usuario y contraseña
                </p>
                <input type="text" placeholder="Usuario" name="username" class="form-control top" style="MARGIN:.2em">
                <input type="password" placeholder="Contraseña" name="password" class="form-control bottom">
            
                <button class="btn btn-lg btn-primary btn-block" name="login1" type="submit">Entrar</button>
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <form action="index.php"  method="post"
                <p class="text-muted text-center">ingresa tu correo electronico</p>
                <input type="text" placeholder="mail@domain.es" class="form-control">
                <br>
                <button class="btn btn-lg btn-danger btn-block" name="forgot" type="submit">Recuperar contraseña</button>
            </form>
        </div>
        
    </div>
    <hr>
    <div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
          <!--  <li><a class="text-muted" href="#forgot" data-toggle="tab">Olvidades contraseña</a></li>-->
          
        </ul>
    </div>
  </div>
  ';
  return $contenido;
}

//verifica 
function valida_login($usuario, $contraseña)
{
/*   $user_agent1 = $_SERVER['HTTP_USER_AGENT'];
  $navegador = getBrowser($user_agent1);
  $so = getPlatform($user_agent1); */
  $pss =limpiar_cadena_sin_espacio($contraseña);
//$pss=$contraseña;

  $cn = conectar();
  $usuario2=limpiar_cadena_sin_espacio($usuario);
  $pss2=md5($pss);
    $sql = "SELECT * from tbl_operador where usu_operador='" . $usuario2 . "' and pass_operador='" . $pss2 . "';";
  $result = mysqli_query($cn, $sql);
  if ($user = mysqli_fetch_array($result)) {
 
 return $user;

  } else {
   
    return false;
  }

  myqli_close($cn);


}

function consultaoperador($idx_operador)
{
  date_default_timezone_set('America/Guayaquil');
    /* $sql = "SELECT * FROM tbl_inventario,`tbl_citas` ORDER BY `tbl_citas`.`hora_citas` ASC ;"; */
    $sql = "SELECT  *     from ( view_tbl_citas) where idx_operador=$idx_operador and fecha_citas=DATE_FORMAT(curdate(), '%d-%m-%Y')  order by  hora_citas desc ;";
    $res = mysqli_query(conectar(), $sql);
  
   $fecha= date("Y-m-d", time());
   $hora=date("H:i:00",time()); 
    echo ' 
 

<div class="">
<div class="col-xs-12 col-md-6  col-sm-6   col-lg-6 pull-left ">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Citas</h5>
 <h5 >'.$fecha.'</h5>
 
</header>


<div id="collapse3" class="body ">

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>

    <tr>
          <th>Hora</th>
        <th>Cliente</th>
        <th>Comportamiento</th>
    </tr>
    </thead>
    <tbody>';

    while ($tipo = mysqli_fetch_array($res)) {

      

 if($tipo['hora_citas']==$hora){
    echo '<tr >';
  echo '<td  ><div style="color:#ee465a;">' . ($tipo['hora_citas']) . '</div></td> ';
 }else if($tipo['hora_citas']>=$hora){
    echo '<tr >';
echo '<td  ><div style="color: blue;">' . ($tipo['hora_citas']) . '</div></td> ';}
else{
      echo '<tr >';
  echo '<td style="color: yellow;" >' . ($tipo['hora_citas']) . '</td> ';}
  if($tipo['estado_citas']=="cumplida"){
    echo '<td  style="color: green;" class="mayuscula">' . ($tipo['cliente']) . '</td>'; 
  }else if($tipo['estado_citas']=="cancelar"){
    echo '<td style="color: red;" class="mayuscula">' . ($tipo['cliente']) . '</td>'; 
  }else if($tipo['estado_citas']=="activo"){
    echo '<td style="color:black;" class="mayuscula">' . ($tipo['cliente']) . '</td>'; 
  }
 

echo '<td ><a href="index2.php?gettis=cumplida&id_citas='.$tipo['id_citas'].'" class=""><button title="Cumplida" class="btn btn-success">
<i class="fa-2x fas fa-check-square"></i></button></a>
<a href="index2.php?gettis=cancelar&id_citas='.$tipo['id_citas'].'" class=""><button class="btn btn-danger" title="Cancelar">
<i class="fa-2x fas fa-window-close"></i></button></a><br>
<a href="index2.php?gettis=regendar&id_citas='.$tipo['id_citas'].'" class=""><button class="btn btn-info" title="Regendar">
<i class="fa-2x fas fa-calendar-alt"></i>
 </button></a>
 <a href="index2.php?gettis=opinion&id_citas='.$tipo['id_citas'].'" class=""><button class="btn btn-warning" title="opinion">
 <i class="fa-2x fas fa-comment-dots"></i>
 </button></a>
</td>
 </tr>';
    }


    echo ' 
    </tbody></table>

</div></div></div></div>
<!-- /.row -->
<!--End Datatables-->';


 echo '</div>';
 echo rakimproducto();
 
}
function rakimproducto()
{

    /* $sql = "SELECT * FROM tbl_inventario,`tbl_citas` ORDER BY `tbl_citas`.`hora_citas` ASC ;"; */
    $sql = "SELECT  *     from tbl_inventario  where contar_inventario>=1 order by contar_inventario Desc  limit 5;";
    $res = mysqli_query(conectar(), $sql);
  

    echo ' 
 
  <!--Begin Datatables-->
<div class="col-xs-12 col-md-6   col-sm-6   col-lg-6    pull-right">
<div class="">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Rakim de productos</h5>
</header>


<div id="collapse4" class="body ">

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>

    <tr>
          <th>Producto</th>
        <th  width="20%">Cantidad</th>
   
    </tr>
    </thead>
    <tbody>';

    while ($tipo = mysqli_fetch_array($res)) {

        echo '<tr >';


  echo '<td   >' . ($tipo['nomp_producto']) . '</td> ';

    echo '<td  class="mayuscula">' . ($tipo['contar_inventario']) . '</td>
 </tr>';
    }


    echo ' 
    </tbody></table>

</div></div></div></div>';echo rakimempresa();

 echo '</div>';
}
function rakimempresa()
{

    /* $sql = "SELECT * FROM tbl_inventario,`tbl_citas` ORDER BY `tbl_citas`.`hora_citas` ASC ;"; */
    $sql = "SELECT *,count(*) as contar FROM `v_pedido` GROUP BY cru_clientes asc limit 5;";
    $res = mysqli_query(conectar(), $sql);
  

    echo ' 
 
  <!--Begin Datatables-->
<div class="">
<div class="col-xs-12 col-md-6  col-sm-6   col-lg-6    ">
<div class="box">
<header>
<div class="icons"><i class="fa fa-table"></i></div>
<h5>Rakim de empresas</h5>
</header>


<div id="collapse4" class="body ">

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped   ">
    <thead>

    <tr>
          <th>Empresas</th>
        <th  width="20%">Pedidos</th>
   
    </tr>
    </thead>
    <tbody>';

    while ($tipo = mysqli_fetch_array($res)) {

        echo '<tr >';


  echo '<td   >' . ($tipo['emp_clientes']) . '</td> ';

    echo '<td  class="mayuscula">' . ($tipo['contar']) . '</td>
 </tr>';
    }


    echo ' 
    </tbody></table>

</div></div></div></div>
<!-- /.row -->
<!--End Datatables-->


 </div>';
}
function estado($id,$estado){
  if($estado=="cumplida"){

    $sql="UPDATE tbl_citas set estado_citas='$estado' where id_citas=$id";
    if (mysqli_query(conectar(), $sql)) {
   
      echo consultaoperador($_SESSION['idx_operador']);
  }

  }
  if($estado=="cancelar"){

    $sql="UPDATE tbl_citas set estado_citas='$estado' where id_citas=$id";
    if (mysqli_query(conectar(), $sql)) {
   
      echo consultaoperador($_SESSION['idx_operador']);
  }

  }
  if($estado=="regendar"){

  echo formulario($id);
  }
  if($estado=="opinion"){

    echo formulario2($id);
    }
}

function formulario($id)
{
    date_default_timezone_set('America/Guayaquil');
    if (isset($id)) {
        $cn = conectar();
        $sql = "SELECT * FROM tbl_citas WHERE id_citas =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
     
        $tbl_citas = mysqli_fetch_array($res);
        $sql1 = "SELECT * FROM  tbl_clientes where idx_clientes=".$tbl_citas['idx_clientes']." ";
        $res1 = mysqli_query(conectar(), $sql1);
        $clientes = mysqli_fetch_array($res1);
        $nombre= ($clientes['nom_clientes']) . ' ' . ($clientes['ape_clientes']) ;
    } else {
        $tbl_citas['id_citas'] = null;
        $tbl_citas['fecha_citas'] = date("Y-m-d");
        $tbl_citas['hora_citas'] = date("H:i", time());
        $sql = "SELECT * FROM  tbl_clientes ;";
        $res1 = mysqli_query(conectar(), $sql);
    }
    $cont = ' 
    <div class="row">
<div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario de  citas</h5>
      
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal"   name="tbl_citas" action="" method="POST"  > 
            <div class="form-group">
            <label class="control-label col-lg-4 col-md-4 col-sm-4" for="dp1">Tiempo de la cita</label>

            <div class="col-lg-5 col-md-5 col-sm-5">
                <input type="date" name="fecha_citas" class="form-control" min="'.date("Y-m-d", time()) .'" max="' . date('Y-m-d', strtotime(date("Y-m-d", time()) . "+5 years")) . '" value="' . $tbl_citas['fecha_citas'] . '" id="fecha_citas">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
 
            <input type="time" id="hora_citas"
             name="hora_citas" placeholder="Hora" value="' .  $tbl_citas['hora_citas'] . '"
              class="form-control"
            onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);" >
        </div>
        </div>
        <!-- /.form-group -->
            
                <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">CLIENTE</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8">
                <input type="Text" class="form-control" disabled value="' .$nombre. '">
                    
                </div>
            </div>
            <!-- /.form-group -->  
        
<div class="form-actions  ">

<input type="hidden" name="id_citas" id="id_citas"  value="' .  $tbl_citas['id_citas'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}

function formulario2($id)
{
    date_default_timezone_set('America/Guayaquil');
    if (isset($id)) {
        $cn = conectar();
        $sql = "SELECT * FROM tbl_citas WHERE id_citas =  " . $id . " ;";
        $res = mysqli_query($cn, $sql);
     
        $tbl_citas = mysqli_fetch_array($res);
        $sql1 = "SELECT * FROM  tbl_clientes where idx_clientes=".$tbl_citas['idx_clientes']." ";
        $res1 = mysqli_query(conectar(), $sql1);
        $clientes = mysqli_fetch_array($res1);
        $nombre= ($clientes['nom_clientes']) . ' ' . ($clientes['ape_clientes']) ;
    } else {
        $tbl_citas['id_citas'] = null;
        $tbl_citas['obseravacion_citas'] = "No hay reclamo";
        $tbl_citas['fecha_citas'] = date("Y-m-d");
        $tbl_citas['hora_citas'] = date("H:i", time());
        $sql = "SELECT * FROM  tbl_clientes ;";
        $res1 = mysqli_query(conectar(), $sql);
    }
    $cont = ' 
    <div class="row">
<div class="col-xs-12 col-md-6 Col-md-offset-3 col-sm-6 Col-sm-offset-3   col-lg-6  Col-lg-offset-3">
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Formulario de  citas</h5>
      
        </header>
        <div id="div-1" class="body">
            <form class="form-horizontal"   name="tbl_citas" action="" method="POST"  > 
            <div class="form-group">
            <label class="control-label col-lg-4 col-md-4 col-sm-4" for="dp1">Tiempo de la cita</label>

            <div class="col-lg-5 col-md-5 col-sm-5">
                <input type="date" disabled name="fecha_citas" class="form-control" min="'.date("Y-m-d", time()) .'" max="' . date('Y-m-d', strtotime(date("Y-m-d", time()) . "+5 years")) . '" value="' . $tbl_citas['fecha_citas'] . '" id="fecha_citas">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
 
            <input type="time" id="hora_citas"  disabled
             name="hora_citas" placeholder="Hora" value="' .  $tbl_citas['hora_citas'] . '"
              class="form-control"
            onkeypress="return letranumero(event);" onkeyup="return limitar(event,this.value,45);" onkeydown="return limitar(event,this.value,45);" >
        </div>
        </div>
        <!-- /.form-group -->
            
                <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-4">CLIENTE</label>
            
                <div class="col-lg-8 col-md-8 col-sm-8">
                <input type="Text" class="form-control" disabled value="' .$nombre. '">
                    
                </div>
            </div>
            <!-- /.form-group -->  
            <div class="form-group">
            <label class="control-label col-lg-4 col-md-4 col-sm-4">OPINION</label>
        
            <div class="col-lg-8 col-md-8 col-sm-8">
            
            <textarea id="obseravacion_citas" name="obseravacion_citas" class="form-control">'.$tbl_citas['obseravacion_citas'].'</textarea>  
            </div>
        </div>
        <!-- /.form-group -->  
<div class="form-actions  ">

<input type="hidden" name="id_citas" id="id_citas"  value="' .  $tbl_citas['id_citas'] . '"  >
<button type="submit"  onClick="window.scroll(0,0)"  class="btn btn-primary pull-right" name="registrar2" id="registrar">
 Guardar</button>
</div>

             
            </form>
        </div>
    </div>
</div>';
    return $cont;
}
function registro($tbl_citas)
{

    $hora_citas = ((limpiar_cadena($tbl_citas['hora_citas'])));
    $fecha_citas = ((limpiar_cadena($tbl_citas['fecha_citas'])));
   
 
    $cn = conectar();
    //codigo de actualización 

    if ($tbl_citas['id_citas']   != null) {

        $sql1 = "UPDATE tbl_citas 
		SET fecha_citas= '" . $fecha_citas . "',hora_citas = '" . $hora_citas . "',estado_citas='activo' 
       WHERE id_citas = " . $tbl_citas['id_citas']  . " ";
        if (mysqli_query($cn, $sql1)) {
            echo mensaje('6', '');
            echo consultaoperador($_SESSION['idx_operador']);
        } else {

            echo mensaje('3', $sql1);
            echo consultaoperador($_SESSION['idx_operador']);
        }
    }
}
function registro2($tbl_citas)
{

    
    $obseravacion_citas=$tbl_citas['obseravacion_citas'];
 
    $cn = conectar();
    //codigo de actualización 

    if ($tbl_citas['id_citas']   != null) {

        $sql1 = "UPDATE tbl_citas 
		SET obseravacion_citas='".$obseravacion_citas."'
       WHERE id_citas = " . $tbl_citas['id_citas']  . " ";
        if (mysqli_query($cn, $sql1)) {
            echo mensaje('6', '');
            echo consultaoperador($_SESSION['idx_operador']);
        } else {

            echo mensaje('3', $sql1);
            echo consultaoperador($_SESSION['idx_operador']);
        }
    }
}
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
?>
 <script src="validarlogin.js"></script>
