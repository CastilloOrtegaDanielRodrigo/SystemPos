/*=============================================
EDITAR CLIENTES
=============================================*/

$(".btnEditarCliente").click(function(){
  
    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        
        $("#idCliente").val(respuesta["id"]);
        $("#editarCliente").val(respuesta["nombre"]);
        $("#editarTelefono").val(respuesta["telefono"]);
        $("#editarCalle").val(respuesta["calle_n"]);
        $("#editarColonia").val(respuesta["colonia"]);
        $("#editarfechaInstalacion").val(respuesta["fecha_instalacion"]);
        $("#editarNumero_SMA").val(respuesta["n_serie_mac_antena"]);
        $("#editarIp_Asignada_A").val(respuesta["ip_asignada_antena"]);
        $("#editarNumero_SMR").val(respuesta["n_serie_mac_router"]);
        $("#editarIp_Asignada_R").val(respuesta["ip_asignada_router"]);
    }

    })
  })
/*=============================================
ELIMINAR CLIENTES
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function(){

	var idCliente = $(this).attr("idCliente");
	
	swal({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }

  })

})

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoCliente").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarCliente", clientes);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoCliente").parent().after('<div class="alert alert-warning">Este cliente ya existe en la base de datos</div>');

	    		$("#nuevoCliente").val("");

	    	}

	    }

	})
})