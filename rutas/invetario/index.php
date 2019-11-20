 
<?php include("../include/head1.php");?>

<link rel="stylesheet" href="diseño.css">
<?php

session_start();



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
        echo elimina_tbl_inventario($id);   
    }
    if($_GET['gettis']=='editar'){
        $id=$_GET['id'];
        echo formulario($id);        
    }
    if($_GET['gettis']=='parrilla'){
        $id=$_GET['id'];
        $nm=$_GET['cont_muestra'];
   
        echo parrilla($id,$nm );        
    }
    if($_GET['gettis']=='parrilla_0'){
        $id=$_GET['id'];
        echo parrilla_0($id);        
    }
    if($_GET['gettis']=='parrillaall'){
       
        echo parrilla_all();        
    }
    
}
else{
    



    echo consulta($_SESSION['rol_operador']);
}
} 

else{
    echo "Usted no tiene permisos para acceder a este sitio";    header("location:../index.php");
}

?>

<?php include("../include/script1.php");?>
 <script>
 (function() {
 
 $("#muestra").on("click", function() {
   $(".ver_muestra").show();
   $(".ver_muestra").load("template/tbl_muestra.php");
   $(".tbl_producto").hide()
 });
 
 
})();
 </script>