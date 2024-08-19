<?php
class ControladorClientes{

    /*=====================================
    AGREGAR CLIENTES
    ======================================*/
    static public function ctrCrearCliente(){

        if(isset($_POST["nuevoCliente"])){
    
            if(
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
                preg_match('/^[#\,\-a-zA-Z0-9 ]+$/', $_POST["nuevoCalle"]) &&
                preg_match('/^[#\,\-a-zA-Z0-9 ]+$/', $_POST["nuevoColonia"])
            ){
            
                $tabla = "clientes";
    
                $datos = array(
                    "nombre" => $_POST["nuevoCliente"],
                    "telefono" => $_POST["nuevoTelefono"],
                    "calle_n" => $_POST["nuevoCalle"],
                    "colonia" => $_POST["nuevoColonia"],
                    "fecha_instalacion" => $_POST["nuevofechaInstalacion"],
                    "n_serie_mac_antena" => $_POST["nuevoNumero_SMA"],
                    "ip_asignada_antena" => $_POST["nuevoIp_Asignada_A"],
                    "n_serie_mac_router" => $_POST["nuevoNumero_SMR"],
                    "ip_asignada_router" => $_POST["nuevoIp_Asignada_R"],
                    "cantidad" => $_POST["nuevaCantidad"]
                );
    
                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
            
                if($respuesta == "ok"){
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El cliente ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "clientes";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "clientes";
                        }
                    });
                </script>';
            }
        }
    }

    /*=====================================
    MOSTRAR CLIENTES
    ======================================*/

    static public function ctrMostrarClientes($item, $valor){
        $tabla = "clientes";
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }

    /*=====================================
    EDITAR CLIENTES
    ======================================*/

    static public function ctrEditarCliente(){

        if(isset($_POST["editarCliente"])){
    
            if(
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
                preg_match('/^[#\,\-a-zA-Z0-9 ]+$/', $_POST["editarCalle"]) &&
                preg_match('/^[#\,\-a-zA-Z0-9 ]+$/', $_POST["editarColonia"])
            ){
            
                $tabla = "clientes";
    
                $datos = array(
                    "id" => $_POST["idCliente"],
                    "nombre" => $_POST["editarCliente"],
                    "telefono" => $_POST["editarTelefono"],
                    "calle_n" => $_POST["editarCalle"],
                    "colonia" => $_POST["editarColonia"],
                    "fecha_instalacion" => $_POST["editarfechaInstalacion"],
                    "n_serie_mac_antena" => $_POST["editarNumero_SMA"],
                    "ip_asignada_antena" => $_POST["editarIp_Asignada_A"],
                    "n_serie_mac_router" => $_POST["editarNumero_SMR"],
                    "ip_asignada_router" => $_POST["editarIp_Asignada_R"],
                    "cantidad" => $_POST["editarCantidad"],
                );
    
                $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
            
                if($respuesta == "ok"){
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El cliente ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "clientes";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "clientes";
                        }
                    });
                </script>';
            }
        }
    }

    /*=============================================
    ELIMINAR CLIENTE
    =============================================*/

    static public function ctrEliminarCliente() {
        if (isset($_GET["idCliente"])) {
            $tabla = "clientes";
            $datos = $_GET["idCliente"];

            // Eliminar los pagos del cliente
            ModeloPago::mdlEliminarPagoCliente($datos);

            // Eliminar el cliente
            $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

            if ($respuesta == "ok") {
                // ...
                echo '<script>
                    swal({
                        type: "success",
                        title: "El cliente ha sido borrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "clientes";
                        }
                    });
                </script>';
            }        
        }
    }
}
