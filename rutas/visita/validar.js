
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
  $(".cancelaPedido2").on("click", function(e) {
    var idxp = $("#idx_visita").val();
 
    var parametros = { idxp: idxp };
    $.ajax({ data: parametros, url: "php/cancelarpedido2.php", type: "post" }) .done(function(data){
      
    if(data==0){alertify.error("Agregar muestra");
  $(".muestra2").focus();
  }else{window.location = "index.php";}
      
        });
    
  });
  /*  */
  
  $("#nom_visita").on("input", function() {
    
    var nom_visita = $("#nom_visita").val();
  
   var idx_ciudadesselect = $("#idx_ciudadesselect").val(); //input cliente
   var idx_ruta = $("#idx_ruta").val(); //input cliente idxespecial
   var idx_especialidades = $("#idx_especialidades").val(); //input cliente
$.ajax({
  type: "POST",
  url: "relleno/codi.php",
  data: {nom_visita:nom_visita}})
  .done(function(data){
    var dato = JSON.parse(data);
  
      });
           
  });

$(".listaMedico").click(function(e){
  var espe=e.currentTarget.dataset.especialidad
  $(".milista").show();
  $(".milista").load("template/tbl_medico.php");
})


  $(".GuardaPedido").on("click", function() {
    
    var cod_visita = $("#cod_visita").val(); //input cliente
    var nom_visita = $("#nom_visita").val(); //input cliente
    var dir_visita = $("#dir_visita").val(); //input cliente+

    var idx_ciudadesselect = $("#idx_ciudadesselect").val(); //input cliente
    var idx_ruta = $("#idx_ruta").val(); //input cliente
    var idx_especialidades = $("#idx_especialidades").val(); //input cliente
    var n_muestra = $("#n_muestra").val();
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
                  alertify.error("no hay detalles de muestra...");
                }
    
                if(data==2){
                  alertify.success("Pedido registrado con exito...");
             
                  window.location="index.php";
                  
                  $(".suman").html('$ 0.00'); //th suma
                   
         
                }
    

                if(data==3){

                  alertify.warning("Ya se a registrado la vista de este Mes al Medico...!");
                }
          
    
              })
     
  });
 
})();
(function() {
  $(".e_producto2").on("click",function(e){
    var id= e.currentTarget.dataset.id
    var nmuestra= e.currentTarget.dataset.nmuestra
    var codigo= e.currentTarget.dataset.codigo
    
    
     $.ajax({
        type:"POST",
        url:"php/eliminaritem_detalle_muestra.php",
        data:{id:id,nmuestra:nmuestra}
    
    }).done(function(data){
    
      $(".productos").load('tbl_det_muestra.php?id='+codigo)
  
    
        
    })  
    
    
    
    }); 
    $(".muestra2").on("click", function() {
  
       $(".ver_muestra").show();
      
      $(".ver_muestra").load("template/tbl_muestra2.php"); 
    });

    $(".GuardaPedido2").on("click", function() {
    
      var cod_visita = $("#cod_visita").val(); //input cliente
      var nom_visita = $("#nom_visita").val(); //input cliente
      var dir_visita = $("#dir_visita").val(); //input cliente+
      var idx_visita = $("#idx_visita").val(); //input cliente+
  
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
          $(".GuardaPedido2").focus();
      }
      if (total_cant == "0") {
        $(".muesta2").focus();
  
        alertify.error("Agregar producto");
  
        return false;
      }
      
   
          $.ajax({
            type: "POST",
            url: "php/actualizar.php",
            data: {
           
              cod_visita:cod_visita,
               nom_visita:nom_visita,
              dir_visita: dir_visita,
              idx_ruta: idx_ruta,
              idx_especialidades:idx_especialidades,
              n_muestra: n_muestra,
              total_cant:total_cant,idx_visita:idx_visita
          }
             }) .done(function(data){
 
      
                  if(data==8){
                    alertify.success("Visita actualizada");
                    window.location="index.php";          
                  }
                  if(data==0){

                    alertify.warning("Agregar muestra ");$(".muestra2").focus();
                  }
            
  
            
      
                })
       
    });

  })();