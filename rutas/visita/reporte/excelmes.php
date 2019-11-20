<?php
header("Content-Type: text/html;charset=utf-8");

session_start();
$id = $_SESSION['idx_operador'];
require "../../include/conexionPdo.php";

$query = $pdo->query("SELECT * FROM view_operador WHERE idx_operador=$id");
$row = $query->fetch();


date_default_timezone_set('America/Guayaquil');

$hora = date('H:i');
$fecha = date("Y-m-d");
$inicio = date("Y-m-") . "01";
$fin = date("Y-m-") . "31";

/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
echo date('H:i:s'), " Create new PHPExcel object", EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
echo date('H:i:s'), " Set document properties", EOL;
$objPHPExcel->getProperties()->setCreator("Victor Cardenas")
    ->setLastModifiedBy("Victor Cardenas")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Reporte Diario");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:H1');

// Create a first sheet, representing sales data
echo date('H:i:s'), " Add some data", EOL;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Informe mensual');

$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Vistador Medico:');
$objPHPExcel->getActiveSheet()->setCellValue('D3', $row['operador']);

$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Fecha solicitada:');
$objPHPExcel->getActiveSheet()->setCellValue('H3', $fecha);


$objPHPExcel->getActiveSheet()->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel(gmmktime(0, 0, 0, date('m'), date('d'), date('Y'))));
$objPHPExcel->getActiveSheet()->getStyle('D1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);
$objPHPExcel->getActiveSheet()->setCellValue('E1', '#12566');

$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Nro');
$objPHPExcel->getActiveSheet()->setCellValue('B5', 'Cliente');
$objPHPExcel->getActiveSheet()->setCellValue('C5', 'Direccion');
$objPHPExcel->getActiveSheet()->setCellValue('D5', 'Ciudad / Parroquia');
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Especialidad');
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'Fecha');
//pinto las muestras//

$objPHPExcel->setActiveSheetIndex(0)

    ->getStyle('g5:z5')->getAlignment()->setTextRotation(90);

$contarFila = 7;

$queryD = $pdo->query("SELECT * FROM view_muestra   WHERE  fecha_muestra>='" . $inicio . "' and fecha_muestra<='" . $fin . "'  ORDER BY `nomp_producto` ASC");

$contartotal_muestra = 0;
while ($rowm = $queryD->fetch()) {
    $contartotal_muestra++;
    $col = letra($contarFila); //dependiendo 
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue($col, $rowm["nomp_producto"]);
    $contarFila++;
}
$Letrafinal = $contarFila;
//fin muetras

$contarFila = 6;
$queryVisita = $pdo->query("SELECT * FROM view_visitas where idx_operador=$id and fech_visita>='$inicio' and   fech_visita<='$fin' ORDER BY fech_visita ASC "); //contenido

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$mifila = 6;

$index = 0;
while ($row_visita = $queryVisita->fetch()) {

    $index++;

    $letra = "A" . $contarFila;
    $letraB = "B" . $contarFila;
    $letraC = "C" . $contarFila;
    $letraD = "D" . $contarFila;
    $letraE = "E" . $contarFila;
    $letraf = "F" . $contarFila;
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue($letra, $index)
        ->setCellValue($letraB, $row_visita["nom_visita"])
        ->setCellValue($letraC, $row_visita["dir_visita"])
        ->setCellValue($letraD, ($row_visita["localizacion"]))
        ->setCellValue($letraE, $row_visita["esp_especialidades"])
        ->setCellValue($letraf, $row_visita["fech_visita"])
        ;






    $idx_visitas = $row_visita["idx_visita"];
    $contarFila++;
    $ii = 7;
    $queryD = $pdo->query("SELECT * FROM view_muestra   WHERE  idx_operador=$id  and fecha_muestra>='" . $inicio . "' and fecha_muestra<='" . $fin . "'  ORDER BY `nomp_producto` ASC");

    while ($rowmuestra = $queryD->fetch()) {
        $cod_muestra = $rowmuestra['idx_muestra'];
        $col = letra2($ii); //dependiendo 

        $queryD2 = $pdo->query("SELECT * FROM excel WHERE idx_visita='$idx_visitas' and idx_muestra='$cod_muestra'");
        $querymuestra = $queryD2->fetch();

        if ($valor = $queryD2->rowCount() > 0) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $mifila, $querymuestra['cant_det_muestra']);
        } else {
            $valor = 0;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $mifila, $valor);
        }
        $ii++;
    }
    $mifila++;
}
$mifila--;

$letrainicial = 7;
$colinicial = 4;
while ($letrainicial < $Letrafinal) {

    $col = letra2($letrainicial); //dependiendo 
    $rango = $col . $colinicial . ':' . $col . $mifila;

    $miletra = letra2($letrainicial);
    $destino = $miletra . ($mifila + 1);

    $objPHPExcel->getActiveSheet()->setCellValue($destino, '=SUM(' . $rango . ')');
    $letrainicial++;
}







// Set cell number formats
echo date('H:i:s'), " Set cell number formats", EOL;
$objPHPExcel->getActiveSheet()->getStyle('f4:Z13')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);


// Set column widths
echo date('H:i:s'), " Set column widths", EOL;
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);

// Set fonts
echo date('H:i:s'), " Set fonts", EOL;
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(30);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setSize(30);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


// Set alignments
echo date('H:i:s'), " Set alignments", EOL;
$objPHPExcel->getActiveSheet()->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('D12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('D13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('B5')->getAlignment()->setShrinkToFit(true);

// Set thin black border outline around column
echo date('H:i:s'), " Set thin black border outline around column", EOL;
$styleThinBlackBorderOutline = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('argb' => 'FF000000'),
        ),
    ),
);


// Set thick brown border outline around "Total"
echo date('H:i:s'), " Set thick brown border outline around Total", EOL;
$styleThickBrownBorderOutline = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('argb' => 'FF000000'),
        ),
    ),
);
$fin = $col . $mifila;
$t2 = 'A5:' . $fin;
$x = 4;
while ($x < $mifila + 2) {
    $fin = $col . $x;
    $t2 = 'A5:' . $fin;
    $objPHPExcel->getActiveSheet()->getStyle($t2)->applyFromArray($styleThickBrownBorderOutline);
    $x++;
}
// Set fills
echo date('H:i:s'), " Set fills", EOL;
//$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->getStartColor()->setARGB('FF808080');





// Unprotect a cell
echo date('H:i:s'), " Unprotect a cell", EOL;
//$objPHPExcel->getActiveSheet()->getStyle('B1')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);


// Add a drawing to the worksheet
echo date('H:i:s'), " Add a drawing to the worksheet", EOL;
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('./images/ruta.png');
$objDrawing->setCoordinates('B1');
$objDrawing->setOffsetY(10);

$objDrawing->setHeight(46);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Play around with inserting and removing rows and columns
echo date('H:i:s'), " Play around with inserting and removing rows and columns", EOL;
$objPHPExcel->getActiveSheet()->insertNewRowBefore(6, 10);
$objPHPExcel->getActiveSheet()->removeRow(6, 10);
$objPHPExcel->getActiveSheet()->insertNewColumnBefore('E', 5);
$objPHPExcel->getActiveSheet()->removeColumn('E', 5);

// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
echo date('H:i:s'), " Set header/footer", EOL;
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BInvoice&RPrinted on &D');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

// Set page orientation and size
echo date('H:i:s'), " Set page orientation and size", EOL;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

// Rename first worksheet
echo date('H:i:s'), " Rename first worksheet", EOL;
$objPHPExcel->getActiveSheet()->setTitle('Reporte mensual_' . $fecha);


// Set the worksheet tab color
echo date('H:i:s'), " Set the worksheet tab color", EOL;
$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');;

// Set alignments
echo date('H:i:s'), " Set alignments", EOL;
$objPHPExcel->getActiveSheet()->getStyle('A6:Z130')->getAlignment()->setWrapText(true);

// Set column widths
echo date('H:i:s'), " Set column widths", EOL;
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(80);

// Set fonts
echo date('H:i:s'), " Set fonts", EOL;
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);

$objPHPExcel->getActiveSheet()->getStyle('A6:Z140')->getFont()->setSize(8);


// Set page orientation and size
echo date('H:i:s'), " Set page orientation and size", EOL;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

function letra($n)
{
    $letras = '';
    switch ($n) {
        case 2:
            $letras = 'B5';
            break;
        case 3:
            $letras = 'C5';
            break;
        case 4:
            $letras = 'D5';
            break;
        case 5:
            $letras = 'E5';
            break;

        case 6:
            $letras = 'F5';
            break;
        case 7:
            $letras = 'G5';
            break;
        case 8:
            $letras = 'H5';
            break;
        case 9:
            $letras = 'I5';
            break;
        case 10:
            $letras = 'J5';
            break;
        case 11:
            $letras = 'K5';
            break;
        case 12:
            $letras = 'L5';
            break;
        case 13:
            $letras = 'M5';
            break;
        case 14:
            $letras = 'N5';
            break;

        case 15:
            $letras = 'O5';
            break;
        case 16:
            $letras = 'P5';
            break;
        case 17:
            $letras = 'Q5';
            break;
        case 18:
            $letras = 'R5';
            break;
        case 19:
            $letras = 'S5';
            break;
        case 20:
            $letras = 'T5';
            break;
        case 21:
            $letras = 'V5';
            break;
        case 22:
            $letras = 'W5';
            break;
        case 23:
            $letras = 'X5';
            break;
        case 24:
            $letras = 'Y5';
            break;
        case 25:
            $letras = 'Z5';
            break;
    }
    return $letras;
}



function letra2($n)
{

    switch ($n) {
        case 6:
            $letras = 'F';
            break;
        case 7:
            $letras = 'G';
            break;
        case 8:
            $letras = 'H';
            break;
        case 9:
            $letras = 'I';
            break;
        case 10:
            $letras = 'J';
            break;
        case 11:
            $letras = 'K';
            break;
        case 12:
            $letras = 'L';
            break;
        case 13:
            $letras = 'M';
            break;
        case 14:
            $letras = 'N';
            break;

        case 15:
            $letras = 'O';
            break;
        case 16:
            $letras = 'P';
            break;
        case 17:
            $letras = 'Q';
            break;
        case 18:
            $letras = 'R';
            break;
        case 19:
            $letras = 'S';
            break;
        case 20:
            $letras = 'T';
            break;
        case 21:
            $letras = 'V';
            break;
        case 22:
            $letras = 'W';
            break;
        case 23:
            $letras = 'X';
            break;
        case 24:
            $letras = 'Y';
            break;
        case 25:
            $letras = 'Z';
            break;
        default:
            $letras = null;
            break;
    }
    return $letras;
}


function TildesHtml($cadena)
{
    return str_replace(
        array("á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ"),
        array(
            "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;",
            "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;"
        ),
        $cadena
    );
}
