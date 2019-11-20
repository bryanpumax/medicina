function letranumero(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    patron =/[A-Za-z\d\s\ñ\Ñ]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
    }
function letra(e) {
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron =/[A-Za-z\s\ñ\Ñ]/;
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
function validalogin(Form) {
    if( vacio(Form.username.value) == false ) {  
   
         $('#username').focus();
       
              alertify.error("USUARIO");
       

        return false  
    }else if( vacio(Form.password.value) == false ) {  
      
         $('#password').focus();
        
        
              alertify.error("CONTRASEÑA");
       
        return false  
    }
    else {
      
    return true
    }
    }
  function mensaje(){
    alertify.alert('S.V.MEDICAL','USUARIO/CONTRASEÑA INCORRECTAS', function(){
      alertify.message('OK');
      location.href="index.php";
    });
  }
      
function correctamente() {
 
  alertify.success("SE REGISTRO CORRECTAMENTE");
}
function existencia(){
$("#ced_operador").focus();

alertify.error("DATO EXISTENTE");   
}
function existencia2(){
  $("#email_operador").focus();
  
  alertify.error("DATO EXISTENTE");   
  }
function eliminar(){
alertify.success("SE ELIMINO CORRECTAMENTE"); 
}
function prohibido(){
alertify.error("NO SE PUEDE ELIMINAR"); 
}
function actualizar()
{
alertify.success("SE ACTUALIZO CORRECTAMENTE");
}

function error()
{
alertify.error("SIN SERVICIO");
}