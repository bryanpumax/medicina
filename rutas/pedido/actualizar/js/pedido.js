(function() {
  var producto = new Array();

  $("#listar").on("click", function() {
    $(".ver_cliente").show();
    $(".ver_cliente").load("template/tabla_cliente.php");
  });

  $(".Pedido").on("click", function(e) {
    $(".milistaPedido").fadeOut();
    $(".pedidos").fadeIn();
    $(".bnuevo").fadeOut();

    
  });

  /* $(".cancelaPedido").on("click",function(e){
    var idxp = $("#nroCoti").val();
    $(".milistaPedido").fadeIn();
    $(".pedidos").fadeOut();
    var parametros = { idxp: idxp };
    $.ajax({ data: parametros, url: "php/eliminarpedido.php", type: "post" });
        
})
 */
  $(".cancelaPedido").on("click", function(e) {
  
 

    $.ajax({
      type: "post",url: "php/eliminarpedido.php" 
   
  
  }).done(function(data){
 
    window.location = "../index.php";
  
      
  })
   
  });

  $(".GuardaPedido").on("click", function() {
    var idx_perdido = $("#idx_perdido").val(); 
    
    var idxc = $("#idxc").val(); //input cliente
    var idxv = $("#nroCoti").val(); //input vendedor
    var suma = $(".suman").html(); //th suma
    var iva12 = $(".ivadoce").html(); //th iva
    var iva0 = $(".ivacero").html(); //th 0$
    var bono = $(".bono").html(); //th 0$
    var total = $(".total").html(); //th suma-bono

    $.ajax({
      type: "POST",
      url: "php/guardaPedido.php",
      data: {
        idx_perdido:idx_perdido,idxv: idxv,
        idxc: idxc,
        suma:suma,
        niva: iva0,
        iva: iva12,
        bono:bono,
        total: total}
       }) .done(function(data){

            if(data==1){
              alertify.error("no hay detalles de pedido...");
            }

            if(data==2){
              alertify.success("Pedido actualizo con exito...");
              window.location="../index.php";
            
  
            }

          })

  });

  $("#listaProducto").on("click", function(e) {
    var idxc = $("#idxc").val();
    var idxv = $("#idxv").val();
    if (idxc == "") {
      alertify.error("Seleccione cliente");
      $("#cedula").focus();
      return false;
    } else {
      $(".ver_Producto").fadeIn();

     
    }
  });
})();

//imprimir
function myFunction() {
  var codigo = $("#codigo").val();
  var idxc = $("#idxc").val(); //input cliente

  if (idxc==""){
    alert("SELECCIONE CLIENTE");
    $("#listar").focus();
    return false;
}
if (codigo==""){
  alert("SELECCIONE PRODUCTO");
  $("#listaProducto").focus();
  return false;
}else if(idxc!="" & codigo!="" ){
  location.href = "../imprimir/crearPdf.php?gettis=cotixar&cliente="+idxc+"&codigo="+codigo}
}
