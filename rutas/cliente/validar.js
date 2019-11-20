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
            return true
        }
    }
    return false
}
/*login*/
function validacl(Form) {
    if (vacio(Form.cru_clientes.value) == false) {
     
         $('#cru_clientes').focus();
         alertify.set('notifier','position', 'top-right');
            alertify.error("Cedula");
   
        return false
    } if (vacio(Form.nom_clientes.value) == false) {
     
        $('#nom_clientes').focus();
        alertify.set('notifier','position', 'top-right');
            alertify.error("nombre");
       
        return false
    } if (vacio(Form.ape_clientes.value) == false) {      
        $('#ape_clientes').focus();
        alertify.set('notifier','position', 'top-right');
            alertify.error("apellido");
  
        return false
    } if (vacio(Form.dir_clientes.value) == false) {

        
        $('#dir_clientes').focus();
        alertify.set('notifier','position', 'top-right');
            alertify.error("direccion");
      
        return false
    } if (vacio(Form.email_clientes.value) == false) {
   
        $('#email_clientes').focus();
        alertify.set('notifier','position', 'top-right');
            alertify.error("EMAIL");
       
        return false
    }
    if (vacio(Form.emp_clientes.value) == false) {
   
        $('#emp_clientes').focus();
        alertify.set('notifier','position', 'top-right');
            alertify.error("empresa");
       
        return false
    }
    if ((Form.idx_ciudadesselect.value) == 0) {
 
        
        $('#idx_ciudadesselect').focus();
        alertify.set('notifier','position', 'top-right');
            alertify.error("Ciudad");
      
        return false
    }
    if ((Form.idx_ruta.value) == 0) {
    $('#idx_ruta').focus();
    alertify.set('notifier','position', 'top-right');
            alertify.error("Ruta");
       
        return false
    }

    else {
        var email = document.getElementById('email_clientes').value;
        var formato = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var v_email = formato.test(email);
        if ((v_email != true) || (email == "")) {
        
            $('#email_clientes').focus();alertify.set('notifier','position', 'top-right');
            alertify.error("Email");
            return false;
        }
     
       
        return true;
    }


}
function validarcedula() {
    var i;
    var cedula;
    var acumulado;
    cedula = document.tbl_clientes.cru_clientes.value;
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
        alertify.set('notifier','position', 'top-right');
        alertify.error("Cedula no valida!!");
     
        $('#cru_clientes').focus();
        $('#cru_clientes').val('');
        /* document.tbl_clientes.cru_clientes.setfocus(); */
     
      
    }
    
    /* document.tbl_clientes.cru_clientes.setfocus(); */
    $('#nom_clientes').focus();
}
function CargarProductos(val) {
    $('#respuesta').html("Por favor espera un momento");
    $.ajax({
        type: "POST",
        url: 'ruta.php',
        data: 'idx_ciudadesselect=' + val,
        success: function (resp) {
            $('#idx_ruta').html(resp);
            $('#respuesta').html("");
        }
    });
}



function correctamente() {
    alertify.set('notifier','position', 'top-right');
    alertify.success("SE REGISTRO CORRECTAMENTE");
  }
  function existencia(){
  $("#cru_clientes").focus();alertify.set('notifier','position', 'top-right');
  alertify.error("DATO EXISTENTE");   
  }
  function existencia2(){
    $("#email_clientes").focus();
    alertify.set('notifier','position', 'top-right');
    alertify.error("DATO EXISTENTE");   
    }
  function eliminar(){
    alertify.set('notifier','position', 'top-right');
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
  