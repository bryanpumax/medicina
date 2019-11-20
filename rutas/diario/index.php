<style>
 

</style>


<?php include("../include/head1.php");?>

<link rel="stylesheet" href="diseño.css">
<?php

session_start();
 include("../include/scriptdiario.php");


include("funciones.php");
echo'<div class="loader"></div>´';

if($_SESSION['rol_operador']>=1){
if(isset($_POST['bsc'])){
  
    echo fech($_POST);
    }else{
    



    echo consulta($_SESSION['rol_operador']);
}
}else{
    echo "Usted no tiene permisos para acceder a este sitio";    header("location:../index.php");
}

?>


 