<?php
 $sql2 = "SELECT * from tbl_parametros  ;";
 $result2 = mysqli_query(conectar(), $sql2);
 $operador=mysqli_fetch_array($result2); 
 $titulo=$operador['tittle_parametros'];
 
?>
<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <title>Rutas</title> -->
    <title><?php echo $titulo;?></title>

    <meta name="msapplication-TileColor" content="#5bc0de" />

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap -->

    <link rel="stylesheet" type="text/css" href="assets/lib/bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link href="assets/fontawesome/css/all.css" rel="stylesheet" />

   <link type="text/css" href="assets/images/icons/css/font-awesome.css" rel="stylesheet">


    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" type="text/css" href="assets/lib/metismenu/metisMenu.css">

    <!-- onoffcanvas stylesheet -->

    <link rel="stylesheet" type="text/css" href="assets/lib/onoffcanvas/onoffcanvas.css">
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" type="text/css" href="assets/lib/animate.css/animate.css">
  

     <link rel="stylesheet" type="text/css" href="assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>
    <link rel="stylesheet" type="text/css"  href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.theme.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/lib/alertify/css/alertify.css">

</head> 