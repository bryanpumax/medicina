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
for ( i = 0; i < q.length; i++ ) {  
    if ( q.charAt(i) != " " ) {  
            return true  
    }  
}  
return false 
}
 
function valida(Form) {
    if(  (Form.idx_clientes.value) == 0 ) {  
      $("#idx_clientes").focus();alertify.set('notifier','position', 'top-right');
      alertify.error("SELECCIONE CLIENTE");
        return false  
    } 

    else {
      
    return true
    }
    }

      
function correctamente() {alertify.set('notifier','position', 'top-right');
 
    alertify.success("SE REGISTRO CORRECTAMENTE");
  }
  function existencia(){alertify.set('notifier','position', 'top-right');
  $("#nom_ciudades").focus();
  
  alertify.error("DATO EXISTENTE");   
  }
  
  function eliminar(){alertify.set('notifier','position', 'top-right');
  alertify.success("SE ELIMINO CORRECTAMENTE"); 
  }
  function prohibido(){alertify.set('notifier','position', 'top-right');
  alertify.error("NO SE PUEDE ELIMINAR"); 
  }
  function actualizar()
  {alertify.set('notifier','position', 'top-right');
  alertify.success("SE ACTUALIZO CORRECTAMENTE");
  }
  
  function error()
  {alertify.set('notifier','position', 'top-right');
  alertify.error("SIN SERVICIO");
  }