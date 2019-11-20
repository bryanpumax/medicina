<?php
session_start();
include("../../include/conexionPdo.php");




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

if($nroCoti == 0){
    $contador=$row['nro_cotizacion']+1;
    $consulta_parametros=$pdo->query("UPDATE tbl_parametros SET nro_cotizacion='$contador'");
} else {
    $contador = $nroCoti;
}


$consulta_Detalle=$pdo->query("SELECT * from tmp_coti_detalle WHERE idproducto='$codProdcuto' and idcoti='$contador'");
$contar = $consulta_Detalle->rowCount();

 
if($contar === 0){
  


  $agrega_Detalle=$pdo->query("INSERT INTO tmp_coti_detalle (idcoti,idproducto,cantidad,precio,promocion,iva) VALUES('$contador','$codProdcuto','$cantidad', '$precio', '$promo','$ivaPagado')"); 
   //$agrega_Detalle=$pdo->query("CALL p_itmp($contador,$codProdcuto,$cantidad,$precio,$promo)");
    // $agrega_Detalle2=$pdo->query("call p_i_det_pedido($idx_perdido,$codProdcuto,$cantidad);"); */
}

echo $contador ;


?>


 
 


