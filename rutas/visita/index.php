<style>
.detalle_Producto  {
 position:absolute!important;
top:.2em;
left:20%;
background:#fff;
border:1px solid #000;
padding:.6em;
z-index:9999;
display:none;
background:#faebcc;

}
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('glow.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
display:none;
}

</style>


<?php include("../include/head1.php");?>

<link rel="stylesheet" href="diseño.css">
<?php

session_start();
 include("../include/script1.php");


include("funciones.php");
echo'<div class="loader"></div>´';

if($_SESSION['rol_operador']>=1){
if(isset($_POST['registrar'])){
  
    registro($_POST);
    }

 
if(isset($_GET['gettis'])){
  
    if($_GET['gettis']=='nuevo'){
        echo formulario(null);        
    }
    if($_GET['gettis']=='eliminar'){
        $id=$_GET['n_muestra'];
        echo elimina_tbl_visitas($id);   
     
    }
    if($_GET['gettis']=='editar'){
        $id=$_GET['idx_visita'];
        echo formulario2($id);        
    }
    if($_GET['gettis']=='consulta'){
       echo "llego";
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

 