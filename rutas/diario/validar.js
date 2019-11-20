
function letranumero(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 8) return true;
  patron = /[A-Za-z\d\s\ñ\Ñ\u00E0-\u00FC]/;
  te = String.fromCharCode(tecla);
  return patron.test(te);
}
function letra(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 8) return true;
  patron = /[A-Za-z\s\ñ\Ñ\u00E0-\u00FC]/;
  te = String.fromCharCode(tecla);
  return patron.test(te);
}
function numeros(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 8) return true;
  patron = /\d/;
  te = String.fromCharCode(tecla);
  return patron.test(te);
}

/* Vacios */

function vacio(q) {
  for (i = 0; i < q.length; i++) {
    if (q.charAt(i) != " ") {
      return true;
    }
  }
  return false;
}
/*login*/

/* function validarcedula(e) {
  var i;
  var cedula;
  var acumulado;
  cedula = e;
  var instancia;
  acumulado = 0;
  for (i = 1; i <= 9; i++) {
    if (i % 2 != 0) {
      instancia = cedula.substring(i - 1, i) * 2;
      if (instancia > 9) instancia -= 9;
    } else instancia = cedula.substring(i - 1, i);
    acumulado += parseInt(instancia);
  }
  while (acumulado > 0) acumulado -= 10;
  if (cedula.substring(9, 10) != acumulado * -1) {
    alertify.error("Cedula no valida!!");

    $("#cedu_visita").focus();
    $("#cedu_visita").val("");
    /* document.tbl_clientes.cedu_visita.setfocus(); 
  }
} */
function CargarProductos(val) {
  $("#respuesta").html("Por favor espera un momento");
  $.ajax({
    type: "POST",
    url: "ruta.php",
    data: "idx_ciudadesselect=" + val,
    success: function(resp) {
      $("#idx_ruta").html(resp);
      $("#respuesta").html("");
    }
  });
}

function correctamente() {
  alertify.success("SE REGISTRO CORRECTAMENTE");
}
function existencia() {
  $("#cedu_visita").focus();
  alertify.error("DATO EXISTENTE");
}
function existencia2() {
  $("#email_clientes").focus();

  alertify.error("DATO EXISTENTE");
}
function eliminar() {
  alertify.success("SE ELIMINO CORRECTAMENTE");
}
function prohibido() {
  alertify.error("NO SE PUEDE ELIMINAR");
}
function actualizar() {
  alertify.success("SE ACTUALIZO CORRECTAMENTE");
}

function error() {
  alertify.error("SIN SERVICIO");
}

(function() {
  $(".muestra").on("click", function() {
    $(".ver_muestra").show();
    $(".ver_muestra").load("template/tbl_muestra.php");
  });

  $(".cerrarc").on("click", function() {
    $(".tbl_producto").show();

    $(".ver_muestra").hide();
  });
  $(".cancelaPedido").on("click", function(e) {
    var idxp = $("#n_muestra2").val();
 
    var parametros = { idxp: idxp };
    $.ajax({ data: parametros, url: "php/eliminarmuestra.php", type: "post" });
    window.location = "index.php";
  });
  /*  */
  $("#nom_visita").on("input", function() {
    
    $("#cod_visita").val('')
    var nom_visita = $("#nom_visita").val();
  
    var idx_ciudadesselect = $("#idx_ciudadesselect").val(); //input cliente
    var idx_ruta = $("#idx_ruta").val(); //input cliente idxespecial
    var idx_especialidades = $("#idx_especialidades").val(); //input cliente
$.ajax({
  type: "POST",
  url: "relleno/dir.php",
  data: {nom_visita:nom_visita}})
  .done(function(data){
     $("#dir_visita").val(data.trim());
   });

   $.ajax({
    type: "POST",
    url: "relleno/codi.php",
    data: {nom_visita:nom_visita}})
    .done(function(dato){
      $("#cod_visita").val()
      $("#cod_visita").val(dato.trim());
     });
  
  $.ajax({
    type: "POST",
    url: "relleno/esp.php",
    data: {nom_visita:nom_visita}})
    .done(function(data){
      
       $("#idxespecial").text(data.trim());
    });
    $.ajax({
      type: "POST",
      url: "relleno/esp2.php",
      data: {nom_visita:nom_visita}})
      .done(function(data){
         $("#idxespecial").val(data.trim());
      });
      $.ajax({
        type: "POST",
        url: "relleno/ciu.php",
        data: {nom_visita:nom_visita}})
        .done(function(data){
           $("#ciu").text(data.trim());
        });
        $.ajax({
          type: "POST",
          url: "relleno/ciu2.php",
          data: {nom_visita:nom_visita}})
          .done(function(data){
             $("#ciu").val(data.trim());
          });
          $.ajax({
            type: "POST",
            url: "relleno/rut.php",
            data: {nom_visita:nom_visita}})
            .done(function(data){
               $("#rut").text(data.trim());
            });
            $.ajax({
              type: "POST",
              url: "relleno/rut2.php",
              data: {nom_visita:nom_visita}})
              .done(function(data){
                 $("#rut").val(data.trim());
              });
  });
  $(".GuardaPedido").on("click", function() {
    
    var cod_visita = $("#cod_visita").val(); //input cliente
    var nom_visita = $("#nom_visita").val(); //input cliente
    var dir_visita = $("#dir_visita").val(); //input cliente+

    var idx_ciudadesselect = $("#idx_ciudadesselect").val(); //input cliente
    var idx_ruta = $("#idx_ruta").val(); //input cliente
    var idx_especialidades = $("#idx_especialidades").val(); //input cliente
    var n_muestra = $("#n_muestra2").val();
    var total_cant = $(".suman").html(); 
    
 

    if (nom_visita == "") {
      $("#nom_visita").focus();

      alertify.error("NOMBRE APELLIDO");

      return false;
    } else {
      $("#dir_visita").focus();
    }

    if (dir_visita == "") {
      $("#dir_visita").focus();

      alertify.error("DIRECCION");

      return false;
    } else {
      $("#idx_ciudadesselect").focus();
    }
    if (idx_ciudadesselect == 0) {
      $("#idx_ciudadesselect").focus();

      alertify.error("Ciudad");

      return false;
    } else {
      $("#idx_ruta").focus();
    }

    if (idx_ruta == 0) {
      $("#idx_ruta").focus();

      alertify.error("Ruta");

      return false;
    } else {
      $("#idx_especialidades").focus();
    }
    if (idx_especialidades == 0) {
      $("#idx_especialidades").focus();

      alertify.error("Especialidad de doctor");

      return false;
    }else{
        $(".GuardaPedido").focus();
    }
   
     if (n_muestra  == "") {
 
      $(".muestra").focus();
  
        alertify.error("Seleccione una muestra");

        return false;
      } 
 
        $.ajax({
          type: "POST",
          url: "php/guardadetalle_muestra.php",
          data: {
         
            cod_visita:cod_visita,
             nom_visita:nom_visita,
            dir_visita: dir_visita,
            idx_ruta: idx_ruta,
            idx_especialidades:idx_especialidades,
            n_muestra: n_muestra,
            total_cant:total_cant
        }
           }) .done(function(data){
   
 
                if(data==1){
                  alertify.error("no hay detalles de pedido...");
                }
    
                if(data==2){
                  alertify.success("Pedido registrado con exito...");
                  window.location="index.php";
                  
                  $(".suman").html('$ 0.00'); //th suma
                   
         
                }
    

          
    
              })
     
  });
 
})();
