<style>
    .texto {
        font-size: 12px;
    }
</style>

<?php

include("../include/conexion.php");


function plantilla($idx_perdido)
{
    include("../include/conexionPdo.php");

    $sql = $pdo->query("SELECT * from v_pedido where idx_perdido='$idx_perdido'");
    $sql2 = "SELECT * from tbl_clientes,tbl_operador,tbl_det_pedido,tbl_inventario,tbl_perdido where tbl_clientes.idx_clientes=tbl_perdido.idx_clientes 
    and tbl_operador.idx_operador=tbl_perdido.idx_operador and 
    tbl_det_pedido.idx_producto=tbl_inventario.idx_producto
    and
    tbl_det_pedido.idx_perdido=tbl_perdido.idx_perdido
    and tbl_perdido.idx_perdido='$idx_perdido'";
    $res = mysqli_query(conectar(), $sql2);
    while ($row = $sql->fetch()) {

        $Cliente =  $row['Cliente'];
        $dir_clientes =  $row['dir_clientes'];
        $Operador =  $row['Operador'];
        $telf_clientes =  $row['telf_clientes'];
        $email_clientes =  $row['email_clientes'];
        $fech_perdido =  $row['fech_perdido'];
        $totaliva_perdido =  $row['totaliva_perdido'];
        $totalbono =  $row['totalbono'];
        $total_perdido =  $row['total_perdido'];
    }

    $html = ' 
    <table class="texto" ><tr ><td ><div class="pull-left"><img src="../assets/img/ruta.png"></div></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center"><h4></h4></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center">Nº PEDIDO :&nbsp; ' . $idx_perdido . '</td>
    </tr></table>
    <hr>

     <table  stile="font-size:9px!important"  > 
     <tr>
     <TD CLASS="texto" >CLIENTE :</TD>
     <td class="texto">' . $Cliente . '</td>
     </tr>
     
     <TR CLASS=""><TD CLASS="">DIRECCION:</TD><TD CLASS="">' . $dir_clientes . '</td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
    <td CLASS="">&nbsp;</td> 
     
    <TD CLASS="">TELEFONO:</TD><TD CLASS="">' . $telf_clientes . '</td></tr>
     <TR CLASS=""><TD CLASS="">EMAIL</TD><TD CLASS="">' . $email_clientes . '</td></tr>
     <tr class=""> 
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
    
     <td style="font-size:12px!important;">Vendedor:' . $Operador . ' </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;       </td>
  
  <td style="font-size:12px!important;">Fecha :' . $fech_perdido . '</td>
  
  </tr>
     
     </table>
 <hr>
  
 
  <div class="cuerpo" >
    <table  class="texto" border="1" >
 
 
 <thead class="text-primary alert-warning ">
 <tr>
     <th width="350px">Descripcion del Producto</th>
     <th width="100px">Cant</th>
     <th width="100px">Valor</th>
     <th width="100px">Bono</th>
     
      
 </tr>
</thead>
 
     <tbody>';
    $suma = 0;
    while ($perdido = mysqli_fetch_array($res)) {

        $suma = $suma + (($perdido['cant_det_pedido'] + $perdido['promo_producto']) * $perdido['prec_producto']);
        $html .= '<tr  style="border:1px solid #000!important" > 
  
  <td align="left" width="140px" >' . ($perdido['nomp_producto']) . ' </td> 
  
  <td >' . $perdido['cant_det_pedido'] . ' </td> 
  <td >' . $perdido['prec_producto']  . ' </td> 
  <td  >' . ($perdido['promo_producto'])  . ' </td>  </tr>';
    }

    $html .= '</tbody> 
    
 
    <tfoot>

<tr>
     <th colspan="2"></th>
     <th>Suman</th>
     <th class="suman">$' . $suma . '</th>
</tr>

<tr>
<th colspan="2"></th>
     <th>Iva 12%</th>
      <th>$' . $totaliva_perdido . '</th>
</tr>
<tr>
<th colspan="2"></th>
     <th>Iva 0%</th>
      <th>$0.00</th>
</tr>
<tr>
<th colspan="2"></th>
     <th>Bonificacion</th>
      <th>$' . $totalbono . '</th>
</tr>
<tr>
<th colspan="2"></th>
     <th>Total</th>
      <th>$' . $total_perdido . '</th>
</tr>


  </tfoot>

    </table>
    </div>
 
    
    </div> </div> </div></div>';
    return $html;
}

function plantilla2($codigo,$idx_cliente,$idx_operador)
{
    $sql = "SELECT * FROM v_detalle where v_detalle.idcoti=$codigo";
 
    $res = mysqli_query(conectar(), $sql);
    $sql2 ="SELECT * from tbl_clientes     where tbl_clientes.idx_clientes=".$idx_cliente ;
        $res2 = mysqli_query(conectar(), $sql2);
        $tbl_cliente = mysqli_fetch_array($res2);
        $sql3 = "SELECT * FROM  tbl_operador where tbl_operador.idx_operador=$idx_operador";
        $res3 = mysqli_query(conectar(), $sql3);
        $tbl_operador = mysqli_fetch_array($res3); 

    $html = ' 
    <table class="texto" ><tr ><td ><div class="pull-left"><img src="../assets/img/ruta.png"></div></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center"><h4></h4></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center">Nº PEDIDO :&nbsp;###</td>
    </tr></table>
    <hr>

     <table  stile="font-size:9px!important"  > 
     <tr>
     <TD CLASS="texto" >CLIENTE :</TD>
     <td class="texto">'.$tbl_cliente['nom_clientes'].' '.$tbl_cliente['ape_clientes'].'</td>
     </tr>
     
     <TR CLASS=""><TD CLASS="">DIRECCION</TD><TD CLASS="">'.$tbl_cliente['dir_clientes'].'</td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
    <td CLASS="">&nbsp;</td> 
     
    <TD CLASS="">TELEFONO</TD><TD CLASS="">'.$tbl_cliente['telf_clientes'].'</td></tr>
     <TR CLASS=""><TD CLASS="">EMAIL</TD><TD CLASS="">'.$tbl_cliente['email_clientes'].'</td></tr>
     <tr class=""> 
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
    
     <td style="font-size:12px!important;">Vendedor:'.$tbl_operador['nom_operador'].' '.$tbl_operador['ape_operador'].' </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
  
  <td style="font-size:12px!important;">Fecha Emision:'.date("d-m-y").'</td>
  
  </tr>
     
     </table>
 <hr>
  
 
  <div class="cuerpo" >
    <table  class="texto" border="1" >
 
 
 <thead class="text-primary alert-warning ">
 <tr>
     <th width="350px">Descripcion del Producto</th>
     <th width="100px">Cant</th>
     <th width="100px">Valor</th>
     <th width="100px">Promo</th>
     
      
 </tr>
</thead>
 
     <tbody>';
    $suma=0;
    $totalIva=0;
    $bono=0;
    while ($perdido = mysqli_fetch_array($res)) {

  
        $suma=$suma + (($perdido['cantidad'] + $perdido['promocion']) * $perdido['precio']);
       $totalIva=$totalIva+$perdido['iva'];
        $html .= '<tr  style="border:1px solid #000!important" > 
 
        <td align="left" width="140px" >' . ($perdido['nomp_producto']) . ' </td> 
        
        <td >' . $perdido['cantidad'] . ' </td> 
        <td >' . $perdido['precio']  . ' </td> 
        
        
        <td  >' . $perdido['promocion']  . ' </td>  </tr>';
        $bono=$bono +($perdido['promocion']*$perdido['precio']);
    }
    
    $totalPedido= ($suma + $totalIva)-$bono;
    

    $html .= '</tbody> 
    
 
    <tfoot>

<tr>
     <th colspan="2"></th>
     <th>Suman</th>
     <th class="suman">$' .$suma.'</th>
</tr>

<tr>
<th colspan="2"></th>
     <th>Iva 12%</th>
      <th>$'.$totalIva.'</th>
</tr>
<tr>
<th colspan="2"></th>
     <th>Iva 0%</th>
      <th>$0.00</th>
</tr>
<tr>
<th colspan="2"></th>
     <th>Bonificacion</th>
      <th>$'.$bono.'</th>
</tr>
<tr>
<th colspan="2"></th>
     <th>Total</th>
      <th>$' . $totalPedido . '</th>
</tr>


  </tfoot>

    </table>
    </div>
    <p class="text-center">
      El presente documento tiene una validez de 15 dias a partir de su fecha de emision
        </p>
    
    </div> </div> </div></div>';
    return $html;
}


function plantilla3($tabla,$arriba,$i,$n)
{
    $sql = "SELECT * FROM $tabla";
 
    $res = mysqli_query(conectar(), $sql);
    

    $html = ' 
    <table class="texto" ><tr ><td ><div class="pull-left"><img src="../assets/img/ruta.png"></div></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center"><h4></h4></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    
    </tr>
    <tr class=""><td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="">REPORTE GENERAL '.$n.'</td></tr>
    </table>
  
 <hr>
  
 
  <div class="cuerpo" >
    <table  class="texto" border="1" >
 
 
 <thead class="text-primary alert-warning ">
 <tr>'.$arriba.'</tr>
</thead>
 
     <tbody>';
 

    while ($perdido = mysqli_fetch_array($res)) {

  
        $html .= '<tr  style="border:1px solid #000!important" >'; 
        for($ii=1;$ii<=$i;$ii++){
            $html.= '<td  >'.$perdido[$ii].'  </td>';
        }
  
      $html.='</tr>';
      
       
        
  

    }
 

    $html .= '</tbody> 
    
 
    </table>
    </div>
 
    
    </div> </div> </div></div>';
    return $html;
}


function plantilla4($tabla,$arriba,$i,$n,$id)
{
    $sql = "SELECT * FROM $tabla where $id";
 
    $res = mysqli_query(conectar(), $sql);
    

    $html = ' 
    <table class="texto" ><tr ><td ><div class="pull-left"><img src="../assets/img/ruta.png"></div></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center"><h4></h4></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    
    </tr>
    <tr class=""><td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="">REPORTE INDIVIDUAL '.$n.'</td></tr>
    </table>
  
 <hr>
  
 
  <div class="cuerpo" >
  
    <table  class="texto" border="1" >
 
 
 <thead class="text-primary alert-warning ">
 <tr>'.$arriba.'</tr>
</thead>
 
     <tbody>';
 

    while ($perdido = mysqli_fetch_array($res)) {

  
        $html .= '<tr  style="border:1px solid #000!important" >'; 
        for($ii=1;$ii<=$i;$ii++){
            $html.= '<td  >'.$perdido[$ii].'  </td>';
        }
  
      $html.='</tr>';
      
       
        
  

    }
 

    $html .= '</tbody> 
    
 
    </table>
    </div>
 
    
    </div> </div> </div></div>';
    return $html;
}
//parrilla  individual 


function plantilla_muestra_op($id)
{
    include("../include/conexionPdo.php");

    $sql = $pdo->query("SELECT * from view_visitas_detalle where idx_vista=$id");

    
   $sql2 = "SELECT * from excel where  idx_visita='$id'"; 
    $res = mysqli_query(conectar(), $sql2);
    while ($row = $sql->fetch()) {

        $Cliente =  $row['nom_visita'];
        $dir_clientes =  $row['dir_visita'];
        $Operador =  $row['operador'];
        $telf_clientes =  $row['ruta'];
        $email_clientes =  $row['localizacion'];
        $fech_perdido =  $row['fech_visita'];
 
        $total_perdido =  $row['total_cant'];
    }

    $html = ' 
    <table class="texto" ><tr ><td ><div class="pull-left"><img src="../assets/img/ruta.png"></div></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center"><h4></h4></td>
    <td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td algin="center">Registro de Visita N: &nbsp; ' . $id . '</td>
    </tr></table>
    <hr>

     <table  stile="font-size:9px!important"  > 
     <tr>
     <TD CLASS="texto" >CLIENTE :</TD>
     <td class="texto">' . $Cliente . '</td>
     </tr>
     
     <TR CLASS=""><TD CLASS="">DIRECCION:</TD><TD CLASS="">' . $dir_clientes . '</td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
    <td CLASS="">&nbsp;</td> 
     
     <TR CLASS=""><TD CLASS="">Ciudad / Parroquia</TD><TD CLASS="">' . $email_clientes . '</td></tr>
     <tr class=""> 
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;             </td>
    
     <td style="font-size:12px!important;">Vendedor:' . $Operador . ' </td>
     <td CLASS="">  &nbsp;&nbsp;&nbsp;       </td>
  
  <td style="font-size:12px!important;">Fecha :' . $fech_perdido . '</td>
  
  </tr>
     
     </table>
 <hr>
  
 
  <div class="cuerpo" >
    <table  class="texto" border="1" >
 
 
 <thead class="text-primary alert-warning ">
 <tr>
     <th width="350px">Descripcion del Producto</th>
     <th width="100px">Cant</th>
 
      
 </tr>
</thead>
 
     <tbody>';
    
    while ($perdido = mysqli_fetch_array($res)) {

       
        $html .= '<tr  style="border:1px solid #000!important" > 
  
  <td align="left" width="140px" >' . ($perdido['nomp_producto']) . ' </td> 
  
  <td >' . $perdido['cant_det_muestra'] . ' </td> 
  </tr>';
    }
 
    $html .= '</tbody> 
    
 
    <tfoot>


<tr>
 
     <th>Total</th>
      <th>' . $total_perdido . '</th>
</tr>


  </tfoot>

    </table>
    </div>
 
    
    </div> </div> </div></div>';
    return $html;
}