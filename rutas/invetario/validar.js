
function letranumero(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==8) return true;
  patron = /[A-Za-z\d\s\ñ\Ñ\u00E0-\u00FC]/; 
  te = String.fromCharCode(tecla);
  return patron.test(te);
  }
function letra(e) {
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron = /[A-Za-z\s\ñ\Ñ\u00E0-\u00FC]/; 
te = String.fromCharCode(tecla);
return patron.test(te);
}
function numeros(e) {
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron = /\d/;
te = String.fromCharCode(tecla);
return patron.test(te);
}
function decimales(evt,input){
  // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
  var key = window.Event ? evt.which : evt.keyCode;    
  var chark = String.fromCharCode(key);
  var tempValue = input.value+chark;
  if(key >= 48 && key <= 57){
      if(filter(tempValue)=== false){
          return false;
      }else{       
          return true;
      }
  }else{
        if(key == 8 || key == 13 || key == 0) {     
            return true;              
        }else if(key == 46){
              if(filter(tempValue)=== false){
                  return false;
              }else{       
                  return true;
              }
        }else{
            return false;
        }
  }
}
function filter(__val__){
  var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
  if(preg.test(__val__) === true){
      return true;
  }else{
     return false;
  }
  
}

/* Vacios */

function vacio(q) { 
for ( i = 0; i < q.length; i++ ) {  
  if ( q.charAt(i) != " " ) {  
          return true  
  }  
}  
return false 
}
/*login*/
function valida(Form) {
  alertify.set('notifier','position', 'top-right');
  if( vacio(Form.nomp_producto.value) == false ) {  

      $("#nomp_producto").focus();
      alertify.error("CAJA DE TEXTO DEL PRODUCTO VACIA.")  ;
      return false  
  }else if( vacio(Form.prec_producto.value) == false ) {  
      $("#prec_producto").focus();
      alertify.error("CAJA DE TEXTO DEL PRECIO VACIA.")  ;
      return false  
  }else if(  (Form.idx_tipo.value) == 0 ) {  
      $("#idx_tipo").focus();
      alertify.error("SELECCIONE CATEGORIA.")  ;
      return false  
  }else if(  (Form.iva_producto.value) == 3 ) {  
      $("#iva_producto").focus();
      alertify.error("IVA")  ;
      return false  
  } 
  else if(vacio(Form.promo_producto.value) == false ) {  
      $("#promo_producto").focus();
      alertify.error("CAJA DE TEXTO DE PROMOCION VACIA")  ;
      return false  
  } 

  else if( vacio(Form.caract_inventario.value) == false ) {  
      $("#caract_inventario").focus();
      alertify.error("CAJA DE TEXTO DE LA CARACTERISTICAS VACIA")  ;
      return false  
  } 
  else {
    
  return true
  }
  }
  
  function CargarProductos(val)
{
  $('#respuesta').html("Por favor espera un momento");    
  $.ajax({
      type: "POST",
      url: 'ruta.php',
      data: 'idx_ciudadesselect='+val,
      success: function(resp){
          $('#idx_ruta').html(resp);
          $('#respuesta').html("");
      }
  });
}
function correctamente() {
  alertify.set('notifier','position', 'top-right');
  alertify.success("SE REGISTRO CORRECTAMENTE");
}
function existencia() {
  alertify.set('notifier','position', 'top-right');
  $("#nom_ciudades").focus();

  alertify.error("DATO EXISTENTE");
}

function eliminar() {
  alertify.set('notifier','position', 'top-right');
  alertify.success("SE ELIMINO CORRECTAMENTE");
}
function prohibido() {alertify.set('notifier','position', 'top-right');
  alertify.error("NO SE PUEDE ELIMINAR");
}
function actualizar() {alertify.set('notifier','position', 'top-right');
  alertify.success("SE ACTUALIZO CORRECTAMENTE");
}
function parrilla() {alertify.set('notifier','position', 'top-right');
  alertify.success("SE ENCUENTRA EN LISTADO DE MUESTRA DE ESTE MES ");
}
function parrilla_0() {alertify.set('notifier','position', 'top-right');
  alertify.success("SE ELIMINO DEL LISTADO DE MUESTRA DE ESTE MES ");
}
function error() {alertify.set('notifier','position', 'top-right');
  alertify.error("SIN SERVICIO");
}

