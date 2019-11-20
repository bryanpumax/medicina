<?php
session_start();

include("../../../include/conexion.php");
include("../../../include/conexionPdo.php");

date_default_timezone_set('America/Guayaquil');

$idxOperador = $_SESSION['idx_operador'];


$fecha_r = date("Y/m/d");

$fecha = new DateTime($fecha_r);
$linea['fecha'] = $fecha->format("Y-m-d");
$mifecha = $linea['fecha'];
$hora = date('H:i');

$idx_perdido = $_POST['idx_perdido'];
$idx_clientes = $_POST['idxc'];

$suma_cotizacion = limpiar_cadena_coma_punto($_POST['suma']);
$iva12 = limpiar_cadena_coma_punto($_POST['iva']);
$iva0 = limpiar_cadena_coma_punto($_POST['niva']);
$bono =   limpiar_cadena_coma_punto($_POST['bono']);
$total = limpiar_cadena_coma_punto($_POST['total']);


$consulta = $pdo->query("SELECT * FROM  tbl_det_pedido where idx_perdido='$idx_perdido'");

$cuenta = $consulta->rowCount();

if ($cuenta == 0) {
  echo 1;
  return;
}

actualizar($mifecha,$hora,$idx_clientes,$idxOperador,$iva12,$iva0,$bono,$total,$idx_perdido);


function actualizar($mifecha,$hora,$idx_clientes,$idxOperador,$iva12,$iva0,$bono,$total,$idx_perdido){
  include("../../../include/conexionPdo.php");
  $guardaPedido = $pdo->query("UPDATE tbl_perdido SET fech_perdido='".$mifecha."',hora_perdido='$hora',idx_clientes=$idx_clientes,idx_operador=$idxOperador,totaliva_perdido=$iva12,totalsiniva_perdido=$iva0,totalbono=$bono,total_perdido=$total where idx_perdido= '$idx_perdido'");

  echo 2;
  return;

}
 