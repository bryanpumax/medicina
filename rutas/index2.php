 
<?php include("include/index2head2.php");?>
<?php include("include/conexion.php");?>

<?php

session_start();



include("include/funciones.php");

if($_SESSION['rol_operador']>=1){
if(isset($_POST['registrar'])){
  
    registro($_POST);
    }

    if(isset($_POST['registrar2'])){
  
        registro2($_POST);
        }
if(isset($_GET['gettis'])){
  
    if($_GET['gettis']=='cumplida'){
    $id=$_GET['id_citas'];
    echo estado($id,'cumplida');

    }
    if($_GET['gettis']=='cancelar'){
        $id=$_GET['id_citas'];
    echo estado($id,'cancelar');
     
    }
    if($_GET['gettis']=='regendar'){
        
        $id=$_GET['id_citas'];
        echo estado($id,'regendar');     
    }
    if($_GET['gettis']=='opinion'){
        
        $id=$_GET['id_citas'];
        echo estado($id,'opinion');     
    }

}
else{
    



    echo consultaoperador($_SESSION['idx_operador']);
}
}else{
    header("Location:index.php");
    
}
include("include/index2script2.php");
?>
