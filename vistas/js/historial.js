// Cuando se hace clic en un elemento con la clase "btnMostrarHistorial"
$(".btnMostrarHistorial").click(function () {
    var idPago = $(this).attr("idPago");

    var datos = new FormData();
    datos.append("idPago", idPago);

    $.ajax({
        url: "ajax/historial.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            respuesta.sort(function (a, b) {
                return a.mes.localeCompare(b.mes);
            });

            var htmlHistorial = '';
            var totalAcumulado = 0;

            $.each(respuesta, function (index, pago) {
                var fila = '<tr>';
                fila += '<td>' + (index + 1) + '</td>'; // Número de fila
                fila += '<td>' + pago.id_cliente + '</td>'; // ID del cliente
                fila += '<td>' + pago.nom_cliente + '</td>'; // Nombre del cliente
                fila += '<td>' + pago.mes + '</td>'; // Mes del pago
                fila += '<td>' + pago.fecha + '</td>'; // Fecha del sistema
                fila += '<td>$' + pago.total + '</td>'; // Total del pago
                fila += '<td><button class="btnImprimirFactura" idPago="' + pago.id_cliente + '" nom="'+ pago.nom_cliente + '" mes="' + pago.mes + '" fecha="' + pago.fecha + '" total="' + pago.total + '">Imprimir</button>';
                fila += '<button class="btnEliminarPago" idPago="' + pago.id_cliente + '">Eliminar</button></td>'; // Botón para eliminar
                fila += '</tr>';
            
                console.log(fila); // Verifica la estructura HTML de la fila
            
                htmlHistorial += fila;
                totalAcumulado += parseFloat(pago.total); // Acumular el total de pagos
            });
            
            $("#cuerpoHistorialPagos").html(htmlHistorial);
            $("#totalValor").text(totalAcumulado.toFixed(2)); // Mostrar el total con 2 decimales
            
        }
        
    });
});

// Función para manejar el clic en el botón de imprimir factura
$(document).on("click", ".btnImprimirFactura", function() {
    var idPago = $(this).attr("idPago");
    var nomCliente = $(this).attr("nom");
    var mes = $(this).attr("mes");
    var fecha = $(this).attr("fecha");
    var total = $(this).attr("total");
    console.log("Nombre del cliente: " + nomCliente);
    window.open("fpdf/tutorial/tuto1.php?id=" + idPago + "&nom=" + nomCliente + "&mes=" + mes + "&fecha=" + fecha + "&total=" + total, "_blank");
});

$(document).on("click", ".btnEliminarPago", function() {
    var idPago = $(this).attr("idPago");

    Swal.fire({
        title: '¿Estás seguro de eliminar el pago?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, eliminar pago!',
        customClass: {
            icon: 'custom-icon',  // Aplica una clase personalizada al ícono
            container: 'custom-container'  // Aplica una clase personalizada al contenedor
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var datos = new FormData();
            datos.append("idPago", idPago);

            $.ajax({
                url: "ajax/eliminarpago.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    if (respuesta === "ok") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: 'El pago ha sido eliminado correctamente.',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Cerrar',
                            customClass: {
                                icon: 'custom-icon',
                                container: 'custom-container'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(".btnMostrarHistorial").click(); // Recargar el historial
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo eliminar el pago.',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Cerrar',
                            customClass: {
                                icon: 'custom-icon',
                                container: 'custom-container'
                            }
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema con la solicitud.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Cerrar',
                        customClass: {
                            icon: 'custom-icon',
                            container: 'custom-container'
                        }
                    });
                }
            });
        }
    });
});
