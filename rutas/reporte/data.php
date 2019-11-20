<?php
// Start mysqli Connection

 
/*   
$count=mysqli_num_rows(mysqli_query(conectar(),"SELECT * FROM tbl_citas")); //added
 
$result = mysqli_query(conectar(),"SELECT * FROM tbl_citas LIMIT ". ($count-1).", 1");
print_r(mysqli_fetch_array(mysqli_query(conectar(),$query)));

while($row = mysqli_fetch_array($result)) {
  echo $row['idx_citas'] ;
}
  */
  session_start();
  function respuesta(){
    $año =date("Y");$mes=date("n");
    $sql='SELECT count(*) as contar from tbl_citas where estado_citas="cumplida"  
    and fecha_citas>="'.$año.'-'.$mes.'-01" and fecha_citas<="'.$año.'-'.$mes.'-31" and  idx_operador='.$_SESSION['idx_operador']. ';';
    $res = mysqli_query(conectar(), $sql);
    
    while ($tipo = mysqli_fetch_array($res)) {
      $cont=$tipo['contar'];
    }
return $cont;
  }
  function mes($mes){
    
switch ($mes) 
{ 
case "1": 
ECHO "ENERO"; 
break; 

case "2": 
ECHO "FEBRERO"; 
break; 
case "3": 
ECHO "MARZO"; 
break; 
case "4": 
ECHO "ABRIL"; 
break; 
case "5": 
ECHO "MAYO"; 
break; 

case "6": 
ECHO "JUNIO"; 
break; 

case "7": 
ECHO "JULIO"; 
break; 
case "8": 
ECHO "AGOSTO"; 
break; 
case "9": 
ECHO "SEPTIEMBRE"; 
break; 
case "10": 
ECHO "OCTUBRE"; 
break; 
case "11": 
ECHO "NOVIEMBRE"; 
break; 
case "12": 
ECHO "DICIEMBRE"; 
break; 
} 
 
  }
  
?>