<?php
session_start();

$id_operador= $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];

$usuario= $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];


/*if (isset($_SESSION['2243a353eed7cd8f693ea58f956a23bb'])){ 
$usuario= $_SESSION["2243a353eed7cd8f693ea58f956a23bb"];
	}
else
{
    header('location: index.php');
}*/
date_default_timezone_set('America/Guayaquil');
$fecha = date('Y-m-d');

?>


<?php

require('fpdf.php');
require "../../../conexion.php";

date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

//Cabecera de página

    function Header() {

         //Logo

         $this->Image('../../../assets/img/logodistrito.png', 15,5, 125, 22);
         
        $this->SetFont('Arial', 'B', 15);

        $this->SetTextColor(47, 47, 47);

        $this->Text(120, 34, 'REGISTRO DE INGRESO');

        $this->Ln(20);

        $this->Line(2, 28, 295, 28);

        $this->Ln(25);

    }

//Body

    function TablaColores($header) {

// Colores, ancho de línea y fuente en negrita

        $this->SetFillColor(192, 192, 192);

        $this->SetTextColor(255);

        $this->SetLineWidth(.3);

        $this->SetFont('Arial', 'B');

        // Cabecera

        $w = array(35, 155,20,  20,25);


        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);

        $this->Ln();



        $this->SetTextColor(0);

        $this->SetFont('Times');
    }

//
//Pie de página

    function Footer() {

        //Posición: a 1,5 cm del final

        $this->SetY(-15);

        //Arial italic 8

        $this->SetFont('Arial', 'I', 8);

        //Número de página

        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/ Msp', 0, 0, 'C');
    }

}

//Creación del objeto de la clase heredada

$pdf = new PDF('L');

$pdf->AddPage();

$pdf->SetFont('Times', '', 10);

$pdf -> SetFont('Arial', '', 22);  // set the font

$pdf -> SetY(14);    // set the cursor at Y position 5
$pdf -> SetX(40);    // set the cursor at Y position 5



$pdf -> SetFont('Arial', 'I', 12);  // set the font

$pdf -> SetX(70);    // set the cursor at Y position 5


$pdf -> SetX(230);    // set the cursor at Y position 5
$pdf->Cell(12, 1,'FECHA REPORTE : ' .$fecha);

$pdf->Ln(25);


$pdf->SetFont('Times', '', 10);

$pdf -> SetY(40);    // set the cursor at Y position 5

$pdf -> SetX(10);    // set the cursor at Y position 5

$Id = $_GET["id"];

$query =$pdo->query( "SELECT * FROM v_ingreso WHERE nro_entrada=".$Id);
$row = $query->fetch();
$estado=$row['est_entrada'];


$pdf->SetX(70);
$pdf->Cell(12,10 ,'Nro Comprobante:  '.$row["nro_entrada"]);


$pdf->SetX(160);
$pdf->Cell(12,10 ,'Factura N:  '.$row["nfactura"]);



$pdf->SetX(230);
$pdf->Cell(12,10 ,'Fecha de Ingreso :  '.$row["fec_entrada"]);

$pdf->SetY(45);
$pdf->SetX(70);
$pdf->Cell(12,10 ,'Ruc :  '.$row['cod_provee']);
$pdf->SetX(160);

$pdf->Cell(12,10 ,'Empresa Proveedora :  '.$row['nom_provee']);

$pdf->SetY(50);
$pdf->SetX(70);

$pdf->Cell(12,10 ,'Direccion :  '.$row['dir_provee']);

$pdf -> SetY(55);
$pdf -> SetX(70);
$pdf->Cell(12,10 ,'Contacto :  '.$row['con_provee']);
$pdf -> SetX(160);

$pdf->Cell(12,10 ,'Telefono :  '.$row['tel_cont']);

$pdf -> SetY(65);
$pdf->SetX(160);

$pdf->Cell(12,10 ,'Responsable :  '.$row['Operador']);


$pdf -> SetFont('Arial', '', 22);  // set the font

$pdf->SetTextColor(159, 213, 209);

$pdf->SetX(20);

if($estado =='Anulada'){
    $pdf -> SetFont('Arial', '', 62);  // set the font
        $pdf->Cell(50, 80,' DOCUMENTO ANULAD0  ');
  
}

$pdf->SetFont('Times', '', 10);
$pdf -> SetY(80);    // set the cursor at Y position 5
$pdf -> SetX(30);    // set the cursor at Y position 5

$headerDetalle = array('CANT', 'DETALLE','LOTE','VALOR', 'TOTAL');
$pdf->TablaColores($headerDetalle);
$queryD =$pdo->query("SELECT * FROM v_deta_entrada WHERE pedido=".$Id);

$mifila=87;

while ($row1 = $queryD->fetch()) {
    $pdf->SetFont('Times', '', 8);
      
 $cant=strlen($row1['Pro_descri']);

                    if($cant<=120){
                    $pdf -> SetY($mifila);    // set the cursor at Y position 5
                    $pdf -> SetX(30);    // set the cursor at Y position 5
                    $pdf->MultiCell(35, 4, $row1['can'], 1, 'C');
                    $pdf -> SetY($mifila);    // set the cursor at Y position 5

                    $pdf -> SetX(65);    // set the cursor at Y position 5
                    $pdf->MultiCell(155, 4, utf8_decode($row1["Pro_descri"]), 1, 'J');


                    $pdf -> SetY($mifila);    // set the cursor at Y position 5
                    $pdf -> SetX(220);    // set the cursor at Y position 5
                    $pdf->MultiCell(20  , 4, $row1['lot_producto'],  1, 'L');



                    $pdf -> SetY($mifila);    // set the cursor at Y position 5
                    $pdf -> SetX(240);    // set the cursor at Y position 5
                    $pdf->MultiCell(20, 4, $row1['val_producto'],  1, 'L');


                    $pdf -> SetY($mifila);    // set the cursor at Y position 5
                    $pdf -> SetX(260);    // set the cursor at Y position 5
                    $pdf->MultiCell(25, 4, $row1['sub_producto'],  1, 'L');



                    $pdf->Ln();
                    $mifila=$mifila+4;
                    }
                if($cant>120){
                $pdf -> SetY($mifila);    // set the cursor at Y position 5
                $pdf -> SetX(30);    // set the cursor at Y position 5
                $pdf->MultiCell(35, 20, $row1['can'], 1, 'C');
                $pdf -> SetY($mifila);    // set the cursor at Y position 5

                $pdf -> SetX(65);    // set the cursor at Y position 5
                $pdf->MultiCell(155, 10, utf8_decode($row1["Pro_descri"]), 1, 'J');

                $pdf -> SetY($mifila);    // set the cursor at Y position 5

                $pdf -> SetX(235);    // set the cursor at Y position 5
                $pdf->MultiCell(30, 20, $row1['val_producto'],  1, 'L');



                $pdf -> SetY($mifila);    // set the cursor at Y position 5
                $pdf -> SetX(265);    // set the cursor at Y position 5
                $pdf->MultiCell(30, 20, $row1['sub_producto'],  1, 'L');
                $pdf->Ln();
                $mifila=$mifila+20;

                }


}




$pdf -> SetY($mifila);    // set the cursor at Y position 5
$pdf -> SetX(236);    // set the cursor at Y position 5
$pdf->Cell(12,10 ,'SUBTOTAL : ');



$pdf -> SetX(260);    // set the cursor at Y position 5
$pdf->Cell(12,10 , $row["sub_entrada"]);


$pdf->Ln(5);


$pdf -> SetX(236);    // set the cursor at Y position 5
$pdf->Cell(12,10 ,'IVA: 0%     : ');

$pdf -> SetX(260);    // set the cursor at Y position 5
$pdf->Cell(12,10 , '0');



$pdf->Ln(5);

$pdf -> SetX(236);    // set the cursor at Y position 5
$pdf->Cell(12,10 ,'IVA: 12%     : ');

$pdf -> SetX(260);    // set the cursor at Y position 5
$pdf->Cell(12,10 , $row["iva_entrada"]);


$pdf->Ln(5);



$pdf -> SetX(236);
$pdf->Cell(12,10 ,'TOTAL        : ');


$pdf -> SetX(260 );
$pdf->Cell(12,10 , $row["tot_entrada"]);


$pdf->Ln(5);

$pdf -> SetX(136);
$pdf->Cell(12,10 ,'FIRMA RESPONSABLE DE BODEGA');




$pdf->Ln(5);
$pdf -> SetX(144 );
$pdf->Cell(12,10 , $row["Operador"]);




//mysql_close();

$pdf->Output();
?>
