 
<?php include("../include/head1.php");?>

<link rel="stylesheet" href="diseño.css">
<?php

session_start();
 include("../include/script1.php");


include("funciones.php");

if($_SESSION['rol_operador']>=1){
if(isset($_POST['registrar'])){
  
    registro($_POST);
    }

 
if(isset($_GET['gettis'])){
  
    if($_GET['gettis']=='nuevo'){
        echo formulario(null);        
    }
    if($_GET['gettis']=='eliminar'){
        $id=$_GET['id'];
        echo elimina_tbl_clientes($id);   
     
    }
    if($_GET['gettis']=='editar'){
        $id=$_GET['id'];
        echo formulario($id);        
    }
    if($_GET['gettis']=='contraseña'){
        $id=$_GET['id'];
        echo formulario2($id);        
    }

}
else{
    



    echo consulta($_SESSION['rol_operador']);
}
}else{
    echo "Usted no tiene permisos para acceder a este sitio";    header("location:../index.php");
}

?>


<script src="validar.js"></script>