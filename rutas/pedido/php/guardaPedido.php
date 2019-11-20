<?php
session_start();

include("../../include/conexion.php");
include("../../include/conexionPdo.php");

date_default_timezone_set('America/Guayaquil');

$idxOperador=$_SESSION['idx_operador'];


$fecha_r = date("Y/m/d");

$fecha = new DateTime( $fecha_r);
$linea['fecha'] = $fecha->format("Y-m-d");  
$mifecha=$linea['fecha'] ;
$hora = date('H:i') ;


$idx_clientes = $_POST['idxc'];
$idx_cotizacion = $_POST['idxv'];
$suma_cotizacion = limpiar_cadena_coma_punto($_POST['suma']);
$iva12 = limpiar_cadena_coma_punto($_POST['iva']);
$iva0 = limpiar_cadena_coma_punto($_POST['niva']);
$bono=   limpiar_cadena_coma_punto($_POST['bono']);
$total = limpiar_cadena_coma_punto($_POST['total']);


$consulta=$pdo->query("SELECT * FROM tmp_coti_detalle WHERE idcoti='$idx_cotizacion'");
$cuenta=$consulta->rowCount();

if($cuenta==0){
    echo 1;
    return;
}


$idPedido=GeneraCodigoPedido('COT','tbl_parametros','cont_f_cotiza');



$guardaPedido=$pdo->query("INSERT INTO tbl_perdido (idx_perdido,fech_perdido,hora_perdido,idx_clientes,idx_operador,totaliva_perdido,totalsiniva_perdido,totalbono,total_perdido) VALUES('$idPedido','$mifecha', '$hora','$idx_clientes', '$idxOperador', '$iva12', '$iva0', '$bono', '$total' )");


$consulta_detalle=$pdo->query("SELECT * FROM tmp_coti_detalle WHERE idcoti='$idx_cotizacion'");

while($row=$consulta_detalle->fetch()){
$idProducto=$row['idproducto'];
$cantidad=$row['cantidad'];
$promocion=$row['promocion'];
$precio=$row['precio'];
$iva=$row['iva'];
$subtotal=(($cantidad + $promocion) * $precio);
    $guardadetallePedido=$pdo->query("INSERT INTO tbl_det_pedido (idx_perdido,idx_producto, cant_det_pedido,pre_det_pedido, pro_det_pedido,iva_det_pedido,subt_det_pedido)  VALUES('$idPedido','$idProducto','$cantidad','$precio','$promocion','$iva','$subtotal' )");

}


if($guardadetallePedido){
    $consulta=$pdo->query("DELETE FROM tmp_coti_detalle WHERE idcoti='$idx_cotizacion'");
    $update_parametro=ActualizaCodigoPedido('tbl_parametros', 'cont_f_cotiza');

    echo 2;
return;    
}
    





    function GeneraCodigoPedido($identificador=NULL, $tabla=NULL, $campo){
        global $pdo;
        $digitos=8;
  
        $sql_buscar = $pdo->query("SELECT * FROM $tabla");
        $row = $sql_buscar->fetch();
  
  
        $cant = $row[$campo];
        $str_ceros = "";
      
        $nletra = strlen($identificador);
        $ncant = strlen($cant);
      
        $ceros = $digitos - ($nletra + $ncant);
        $i = 1;
      
        while($i <= $ceros){
          $str_ceros .= "0";
          $i += 1;
        }
      
        $cant++;
        $codigo = $identificador.$str_ceros.$cant;
        return $codigo;
      }


  
    function ActualizaCodigoPedido($tabla,$campo){
      global $pdo;

      $sql_buscar = $pdo->query("SELECT * FROM $tabla");
      $row = $sql_buscar->fetch();
      $cant = $row[$campo]+1;


      $sql_buscar = $pdo->query("UPDATE tbl_parametros set $campo='$cant'");
           
      return $sql_buscar;
    }
    