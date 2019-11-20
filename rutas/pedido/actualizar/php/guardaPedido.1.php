<?php
include("../../include/conexion.php");

$idx_clientes = $_POST['idxc'];
$idx_operador = $_POST['idxv'];
$iva12 = limpiar_cadena_coma_punto($_POST['iva']);
$iva0 = limpiar_cadena_coma_punto($_POST['niva']);
$total = limpiar_cadena_coma_punto($_POST['total']);
$codigo = $_POST['codigo'];
$contadordeproductos= $_POST['contadordeproductos'];

/* $sql = "INSERT into tbl_perdido values(null,curdate(),DATE_FORMAT(now(), '%H:%i'),$idx_clientes,$idx_operador,$iva12,$iva0,$total);";
     */
$idx_perdido =  pedidos($idx_clientes, $idx_operador, $iva12, $iva0, $total);
$mensaje=tmp($codigo,$idx_perdido,$contadordeproductos);
echo $mensaje;
function pedidos($idx_clientes, $idx_operador, $iva12, $iva0, $total)
{
    $sql = "INSERT into tbl_perdido values(null,curdate(),DATE_FORMAT(now(), '%H:%i'),$idx_clientes,$idx_operador,$iva12,$iva0,$total);";

    if (mysqli_query(conectar(), $sql)) {
        /*   $_GET['gettis'] = null; */
        //se  ejecuto en la  tabla perdido
        $sqldet = "SELECT * from tbl_perdido where fech_perdido=curdate() and hora_perdido=DATE_FORMAT(now(), '%H:%i')       and idx_clientes=$idx_clientes and idx_operador=$idx_operador; ";

        $resdet = mysqli_query(conectar(), $sqldet);
        $tbl_perdido = mysqli_fetch_array($resdet);
        $idx_perdido = $tbl_perdido['idx_perdido'];

        return  $idx_perdido;
    }
    //insert into tbl_perdido values(null,curdate(),hour(now()),2,26,17.92,0,17.92);
}

function tmp($codigo,$idx_perdido,$contadordeproductos)
{
    $sql = "DELETE FROM v_detalle where idcoti=$codigo;"; 
     $res = mysqli_query(conectar(), $sql);  

    $sql2=substr(str_ireplace("(null,p",'(null,'.$idx_perdido,$contadordeproductos),0,-1);
    if (mysqli_query(conectar(), $sql2)) {
        return '<script>alert("se guardo correctamente")</script>';    
    }
    
    
  
    
    /*   */

 
}

