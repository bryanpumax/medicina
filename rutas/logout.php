<?php


session_start();
//$p=$parametros;

if( $_SESSION['rol_operador']==='7'){
    include("respaldo.php");
     }

$p=session_get_cookie_params();
setcookie(session_name(),'',
time()-100,
$p['path'],$p['domain'],$p['secure'],$p['httponly']);
session_unset();
session_destroy();
header('location: index.php');

?>