<?php
date_default_timezone_set('America/Guayaquil');
session_start();
 
$idx_operador= $_SESSION['idx_operador'];
$fechai = date("Y-m-d");
$n=$_SESSION['nom_operador'];
$nom= substr($n,0,3);
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
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
date_default_timezone_set('Europe/London');

include "excelmes.php";

/** Include PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';


// Save Excel 2007 file
$callStartTime = microtime(true);
$nombreFile=$nom.'Informe_mensual_'.$fechai.'.xlsx';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('mensual.php',$nombreFile , __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

$idx_diario='';
$consulta=$pdo->query("SELECT * FROM tbl_diario WHERE fec_informe='$fecha' and rut_informe='$nombreFile' and idx_operador=$idx_operador");
$row=$consulta->fetch();
$idx_diario=$row['Nro_informe'];
$estado='Actualizado Mensual';

if(is_null($idx_diario)){
  $estado='Generado Mensual';
  $idx_diario=GeneraCodigo($nom.'INFMEN','tbl_parametros','n_informe');
  $idactualziado=ActualizaCodigo('tbl_parametros','n_informe');
}
$borra=$pdo->query("DELETE FROM tbl_diario WHERE fec_informe='$fecha' and rut_informe='$nombreFile' and idx_operador=$idx_operador");
print_r($pdo->errorInfo());

$new=$pdo->query("INSERT INTO tbl_diario( Nro_informe, fec_informe, rut_informe, est_informe,idx_operador) VALUES ('$idx_diario', '$fecha' , '$nombreFile', '$estado','$idx_operador' )");
print_r($pdo->errorInfo());

//ob_end_clean();
exit;




function GeneraCodigo($identificador=NULL, $tabla=NULL, $campo){
    global $pdo;
    $digitos=8;

    $sql_buscar = $pdo->query("SELECT * FROM $tabla");
    $row = $sql_buscar->fetch();


    $cant = $row[$campo]+1;
    $str_ceros = "";
 
    $nletra = strlen($identificador);
    $ncant = strlen($cant);
  
    $ceros = $digitos - ($nletra + $ncant);
    $i = 1;
  
    while($i <= $ceros){
      $str_ceros .= "0";
      $i += 1;
    }
  
   
    $codigo = $identificador.$str_ceros.$cant;
    return $codigo;
  }



function ActualizaCodigo($tabla,$campo){
  global $pdo;

  $sql_buscar = $pdo->query("SELECT * FROM $tabla");
  $row = $sql_buscar->fetch();
  $cant = $row[$campo]+1;


  $sql_buscar = $pdo->query("UPDATE tbl_parametros set $campo='$cant'");
       
  return $sql_buscar;
} 
 