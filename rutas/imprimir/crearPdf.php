<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once 'dompdf/autoload.inc.php';
require_once "misDatosPdf.php";
session_start();
use Dompdf\Dompdf;

// Introducimos HTML de prueba


if(isset($_GET['gettis'])){
	if($_GET['gettis']=="imprimir"){
 $html= plantilla($_GET['idx_perdido']);
 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");
//$pdf->set_paper(array(0,0,104,250));
 
// Cargamos el contenido HTML.
$pdf->load_html($html);
 
// Renderizamos el documento PDF.
$pdf->render();
$canvas = $pdf->get_canvas();
ob_end_clean();
// Enviamos el fichero PDF al navegador.
$pdf->stream('reportePdf.pdf');
}
if ($_GET['gettis'] == "cotixar") {
	echo "<script>alert(".$_GET['codigo'],$_GET['cliente'],$_GET['operador'].")</script>";
	$html = plantilla2($_GET['codigo'],$_GET['cliente'], $_SESSION['idx_operador']);

	// Instanciamos un objeto de la clase DOMPDF.
	$pdf = new DOMPDF();

	// Definimos el tamaño y orientación del papel que queremos.
	$pdf->set_paper("A4", "portrait");
	//$pdf->set_paper(array(0,0,104,250));

	// Cargamos el contenido HTML.
	$pdf->load_html($html);

	// Renderizamos el documento PDF.
	$pdf->render();
	$canvas = $pdf->get_canvas();
	ob_end_clean();
	// Enviamos el fichero PDF al navegador.
	$pdf->stream('reportePdf.pdf');
} 


if ($_GET['gettis'] == "1") {
	$tabla=$_GET['tabla'];
	$arriba=$_GET['arriba'];
	$n=$_GET['n'];
	$arch=$_GET['arch'];
	$cadena=str_ireplace("menor","<",$arriba);

	  $html = plantilla3($tabla,$cadena,$n,$arch); 
 
	// Instanciamos un objeto de la clase DOMPDF.
 	$pdf = new DOMPDF(); 

	// Definimos el tamaño y orientación del papel que queremos.
	$pdf->set_paper("A4", "portrait"); 
/* 	$pdf->set_paper(array(0,0,104,250)); */

	// Cargamos el contenido HTML.
	$pdf->load_html($html); 

	// Renderizamos el documento PDF.
	 $pdf->render();
	$canvas = $pdf->get_canvas();
	ob_end_clean(); 
	// Enviamos el fichero PDF al navegador.
	 $pdf->stream('reporte_general'.$arch.'.pdf'); 
} 

//individual
if ($_GET['gettis'] == "2") {
	$tabla=$_GET['tabla'];
	$arriba=$_GET['arriba'];
	$n=$_GET['n'];
	$id=$_GET['id'];
	$campo=$_GET['campo'];
	$arch=$_GET['arch'];
	$cadena=str_ireplace("menor","<",$arriba);
$condicion=$campo."=".$id;
	  $html = plantilla4($tabla,$cadena,$n,$arch,$condicion); 
	  // Instanciamos un objeto de la clase DOMPDF.
 	$pdf = new DOMPDF(); 

	// Definimos el tamaño y orientación del papel que queremos.
	$pdf->set_paper("A4", "portrait"); 
/* 	$pdf->set_paper(array(0,0,104,250)); */

	// Cargamos el contenido HTML.
	$pdf->load_html($html); 

	// Renderizamos el documento PDF.
	 $pdf->render();
	$canvas = $pdf->get_canvas();
	ob_end_clean(); 
	// Enviamos el fichero PDF al navegador.
	 $pdf->stream('reporte_individual_'.$arch.'.pdf'); 
} 
//muestra
if ($_GET['gettis'] == "3") {
	$id=$_GET['idx'];

	
	$html= plantilla_muestra_op($id);
 
	// Instanciamos un objeto de la clase DOMPDF.
	$pdf = new DOMPDF();
	 
	// Definimos el tamaño y orientación del papel que queremos.
	$pdf->set_paper("A4", "portrait");
	//$pdf->set_paper(array(0,0,104,250));
	 
	// Cargamos el contenido HTML.
	$pdf->load_html($html);
	 
	// Renderizamos el documento PDF.
	$pdf->render();
	$canvas = $pdf->get_canvas();
	ob_end_clean();
	// Enviamos el fichero PDF al navegador.
	$pdf->stream('reportePdf.pdf');
} 

else {
	header("../pedido/index.php");
}
}


