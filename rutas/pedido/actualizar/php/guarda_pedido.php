<?php
session_start();
include("../../../include/conexionPdo.php");




$nroCoti=$_POST['nroCoti'];
$codProdcuto=$_POST['id'];
$producto=$_POST['producto'];
$precio=$_POST['precio'];
$cantidad=$_POST['cant'];
$promo=$_POST['promo'];
$iva=$_POST['iva'];

$consulta_parametro=$pdo->query("SELECT * from tbl_parametros");
$row= $consulta_parametro->fetch();
$valorIva=$row['iva_parametros'];
    
if($iva==1){
    $ivaPagado=($precio*($cantidad+$promo)*$valorIva);
} else {
    $ivaPagado=0;
}


$consulta_Detalle=$pdo->query("SELECT * from tbl_det_pedido WHERE idx_producto=$codProdcuto and idx_perdido='$nroCoti'");
$contar = $consulta_Detalle->rowCount();

 
if($contar === 0){
  
$subt_det_pedido=($promo+$cantidad)*$precio;

  $agrega_Detalle=$pdo->query("INSERT INTO tbl_det_pedido ( idx_perdido, idx_producto, cant_det_pedido, pre_det_pedido, pro_det_pedido, iva_det_pedido, subt_det_pedido)  VALUES('$nroCoti',$codProdcuto,$cantidad, $precio, $promo,$ivaPagado,$subt_det_pedido)"); 
 
}else{
   
$subt_det_pedido=($promo+$cantidad)*$precio;

$agrega_Detalle=$pdo->query("UPDATE  tbl_det_pedido SET    cant_det_pedido=$cantidad, pre_det_pedido=$precio,  pro_det_pedido=$promo, iva_det_pedido=$ivaPagado, subt_det_pedido=$subt_det_pedido WHERE idx_producto=$codProdcuto and idx_perdido='$nroCoti'");    
}

echo $_POST['nroCoti'];


?>


 
 


