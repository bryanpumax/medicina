<link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="include/iframe.css">

<?php
session_start();
include("include/conexion.php");
include("include/funciones.php");
include("include/indexhead.php");

if (isset($_POST['login1'])) {

  $username = ($_POST['username']);
  $password = ($_POST['password']);
  include("include/contenido.php");
  $user = valida_login(utf8_encode($username), utf8_encode($password));
  if ($user != false) {

    $_SESSION['rol_operador'] = $user['rol_operador'];
    $_SESSION['nom_operador'] = $user['nom_operador'] . ' ' . $user['ape_operador'];
    $_SESSION['nrol_operador'] = $user['nrol_operador'];
    $_SESSION['ced_operador'] = $user['ced_operador'];
    $_SESSION['idx_operador'] = $user['idx_operador'];
    echo display_menu($_SESSION['rol_operador']);
  
  } else {
    
   ?><script> alert("S.V.MEDICAL USUARIO/CONTRASEÑA INCORRECTAS");
    location.href="index.php";
   </script> <?php   
 
}
} elseif (isset($_SESSION['rol_operador']) != 0) {
    include("include/contenido.php");


    /* echo display_menu($_SESSION['rol_operador'],$_SESSION['nom_operador'], $_SESSION['nrol_operador'],  $_SESSION['ced_operador']); */
    
    echo display_menu($_SESSION['rol_operador']);
    
  } else {

  echo get_form();
}

include("include/script.php");
?> 