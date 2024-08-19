<?php

class ControladorPago {
    static public function ctrCrearPago() {
        if (isset($_POST["nuevoMesPago"]) && isset($_POST["seleccionarCliente"])) {
            $tabla = "pagos";
            $id_cliente = $_POST["seleccionarCliente"];
            $mes = $_POST["nuevoMesPago"];
            
            // Verificar si ya existe un pago para el mismo cliente y mes
            $existePago = ModeloPago::mdlVerificarPagoDuplicado($tabla, $id_cliente, $mes);

            if ($existePago["count"] > 0) {
                echo '<script>
                    swal({
                        type: "error",
                        title: "El pago ya existe para el mes seleccionado",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "pagos";
                        }
                    })
                </script>';
                return;
            }

            $precioServicio = ModeloPago::mdlObtenerCantidadCliente($id_cliente);

            $datos = array(
                "id_cliente" => $id_cliente,
                "nombre_cliente" => $_POST["nombreCliente"],
                "id_vendedor" => $_POST["idVendedor"],
                "mes" => $mes,
                "total" => $precioServicio["cantidad"],
                "metodo_pago" => "Efectivo",
                "fecha" => date("Y-m-d")
            );

            $respuesta = ModeloPago::mdlIngresarPago($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "El pago ha sido guardado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "pagos";
                       
                        }
                    })
                    </script>';
                }
            }
        }
    }
    ?>
    
    