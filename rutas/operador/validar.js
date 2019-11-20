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
/*login*/
function validaop(Form) {
    var mensaje ='Cedula no valida';
    if (vacio(Form.ced_operador.value) == false) {
     
        $('#ced_operador').focus();
   
            alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("Cedula vacia");
       
        return false
    } if (vacio(Form.nom_operador.value) == false) {
        
       
        $('#nom_operador').focus();
        
       
              alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("Nombre");
           
        return false
    } if (vacio(Form.ape_operador.value) == false) {
    
        $('#ape_operador').focus();
        
   
              alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("Apellido");
        
        return false
    } if (vacio(Form.dir_operador.value) == false) {
  
        $('#dir_operador').focus();
        
  
              alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("Direccion");
      
        return false
    } 

    else {
        var email = document.getElementById('email_operador').value;
        var formato = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var v_email = formato.test(email);
        if ((v_email != true) || (email == "")) {
       
            $('#email_operador').focus();
      
              alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("Email");
         
            return false;
        }
      
        return true;
    }


}
function validarcedula() {
    var i;
    var cedula;
    var acumulado;
    cedula = document.tbl_operador.ced_operador.value;
    var instancia;
    acumulado = 0;
    for (i = 1; i <= 9; i++) {
        if (i % 2 != 0) {
            instancia = cedula.substring(i - 1, i) * 2;
            if (instancia > 9) instancia -= 9;
        }
        else instancia = cedula.substring(i - 1, i);
        acumulado += parseInt(instancia);
    }
    while (acumulado > 0)
        acumulado -= 10;
    if (cedula.substring(9, 10) != (acumulado * -1)) {
        
        
        
 
              
                alertify.error("Cedula");
             
              $('#ced_operador').val('');
              $('#ced_operador').focus();
        /* document.tbl_clientes.ced_operador.setfocus(); */
     
      
    }
    else{$('#nom_operador').focus();}
    /* document.tbl_clientes.ced_operador.setfocus(); */
    
}
    
function correctamente() {
 
    alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.success("SE REGISTRO CORRECTAMENTE");
  }
  function existencia(){
  $("#ced_operador").focus();
  
  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("DATO EXISTENTE");   
  }
  function existencia2(){
    $("#email_operador").focus();
    
    alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("DATO EXISTENTE");   
    }
  function eliminar(){
  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.success("SE ELIMINO CORRECTAMENTE"); 
  }
  function prohibido(){
  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("NO SE PUEDE ELIMINAR"); 
  }
  function actualizar()
  {
  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.success("SE ACTUALIZO CORRECTAMENTE");
  }
  
  function error()
  {
  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.set('notifier','position', 'top-right');  alertify.error("SIN SERVICIO");
  }