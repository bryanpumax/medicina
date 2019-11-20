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
function valida_cliente(Form) {
    if( vacio(Form.idxcliente.value) == false ) {  
        alertify.error("Ingrese un cliente");
        return false  
    } 

    else {
      
    return true
    }
    }


    function validarcedula() {
        var i;
        var cedula;
        var acumulado;
       cedula = $("#cedula").val();
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
            
            $('#cedula').focus();
            
     
                  alertify.error("Cedula no valida");
                  
    
            /* document.tbl_clientes.ced_operador.setfocus(); */
         
          
        }
        alertify.success("Cedula   valida");
    }
    