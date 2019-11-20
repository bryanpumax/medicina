<?php
include("../../include/conexion.php");
session_start();
function pedidos($idx_clientes, $idx_operador)
{
    $sql = "INSERT into tbl_perdido values(null,curdate(),DATE_FORMAT(now(), '%H:%i'),$idx_clientes,$idx_operador,0,0,0);";

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
$idx_cliente=$_POST['idxc'];
$idx_operador=$_POST['idxv'];
$idx_perdido=  pedidos($idx_cliente,$idx_operador);
$_SESSION['idx_perdido']=$idx_perdido;
echo  $_SESSION['idx_perdido'];
?>