;(function (){

        
     $("._cliente").on("click",function(e){
        $("#cedula").val(e.currentTarget.dataset.id)
        $("#resultado").html(e.currentTarget.dataset.nombre)
        $("#direccion").val(e.currentTarget.dataset.dir)
        $("#telef").val(e.currentTarget.dataset.telf)
        $("#cel").val(e.currentTarget.dataset.cel)
        $("#mail").val(e.currentTarget.dataset.correo)
        $("#idxc").val(e.currentTarget.dataset.idx)
        $(".ver_cliente").fadeOut()
    })
    
    $(".cerrarc").on("click",function(e){
     
        $(".ver_cliente").fadeOut()
    })
    

    
    $("._producto").on("click",function(e){
      
      var $id=e.currentTarget.dataset.id
      var promo = e.currentTarget.dataset.promo
      var producto=e.currentTarget.dataset.nombre
      var precio = e.currentTarget.dataset.precio
      var iva = e.currentTarget.dataset.iva
           
        $("#idproducto").val($id)
        $("#producto").val(producto)
        $("#precio").val(precio)

        $("#iva").val(iva)

        $("#promo").val(promo)
        $("#canti").val('0')
        $("#canti").focus()
        $(".detalle_Producto").fadeIn()
   })
    

    
    

    $("#productoGuarda").on("click",function(){
        
        var nroCoti=$("#idx_perdido").val()
        var id=$("#idproducto").val()
        var producto = $("#producto").val()
        var precio = $("#precio").val()
        var cant = $("#canti").val()
        var promo = $("#promo").val()
        var iva = $("#iva").val()
   
        $.ajax({
            type:"POST",
            dataType:"JSON",
            url:"php/guarda_pedido.php",
            data: {id:id, nroCoti:nroCoti, producto:producto, precio:precio, promo:promo, cant:cant ,iva:iva },
        })
        .done(function (data){
        alert(data)
           $("#nroCoti").val(data)
           $("#idproducto").val('')
           $("#producto").val('')
           $("#precio").val('')
           $("#canti").val('')
           $("#promo").val('')
           $("#iva").val('')
  
        }) 
        $(".productos").load('detalles_pedido.php?id='+nroCoti)
        $(".ver_Producto").fadeOut()
        $(".detalle_Producto").fadeOut()
  
    })
    
    $(".cerrarp1").on("click",function(){
        $(".ver_Producto").fadeOut()
    })
    $(".cerrarp2").on("click",function(){
        $(".detalle_Producto").fadeOut()
    })

$(".e_producto").on("click",function(e){
var idx_perdido= e.currentTarget.dataset.idx_perdido
var codProducto = e.currentTarget.dataset.idproducto

$.ajax({
    type:"POST",
    url:"php/eliminaItem.php",
    data:{idx_perdido:idx_perdido, codproducto:codProducto}

}).done(function(data){
 
    $(".productos").load('detalles_pedido.php?id='+idx_perdido)

    
})



})

 
    })()
    


    
    
