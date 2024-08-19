<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Agrega estos enlaces en tu encabezado -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<body>
    

<div class="content-wrapper">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
                    Agregar Cliente
                </button>
            </div>

                <table class="table table-bordered table-striped dt-responsive tablas dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Cantidad a Pagar</th>
                            <th>Calle y Numero</th>
                            <th>Colonia</th>
                            <th>Fecha de Instalacion</th>
                            <th>N. Serie o Mac de Antena</th>
                            <th>IP Asignada Antena</th>
                            <th>N. Serie o Mac de Router</th>
                            <th>IP Asignada Router</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                        foreach ($clientes as $key => $value) {
                            echo '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.$value["nombre"].'</td>
                            <td>'.$value["telefono"].'</td>
                            <td>$'.$value["cantidad"].'.00</td>
                            <td>'.$value["calle_n"].'</td>
                            <td>'.$value["colonia"].'</td>
                            <td>'.$value["fecha_instalacion"].'</td>
                            <td>'.$value["n_serie_mac_antena"].'</td>
                            <td>'.$value["ip_asignada_antena"].'</td>
                            <td>'.$value["n_serie_mac_router"].'</td>
                            <td>'.$value["ip_asignada_router"].'</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditarCliente" 
                                        idCliente="'.$value["id"] .'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btnEliminarCliente" 
                                        idCliente="' . $value["id"] . '">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        var table = $('.dataTable').DataTable();

        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>

</body>
</html>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Formulario para agregar cliente -->
            <form role="form" method="post">

                <!-- Cabecera del modal -->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Cliente</h4>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- Entradas para información del cliente -->
                        <!-- Nombre -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar el Nombre" required>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar el Teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                            </div>
                        </div>

                        <!-- Cantidad a Pagar -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="number" step="0.01" class="form-control input-lg" name="nuevaCantidad" placeholder="Ingresar Cantidad a Pagar" required>
                            </div>
                        </div>



                        <!-- Calle -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoCalle" placeholder="Ingresar la Calle" required>
                            </div>
                        </div>

                        <!-- Colonia -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoColonia" placeholder="Ingresar la Colonia" required>
                            </div>
                        </div>

                        <!-- Fecha de Instalación -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                <input type="date" id="nuevofechaInstalacion" value="2023-07-22" name="nuevofechaInstalacion" placeholder="Ingresar la fecha de instalación" required>
                            </div>
                        </div>

                        <!-- N. Serie o Mac de Antena -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-podcast"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoNumero_SMA" placeholder="Ingresar N. Serie o Mac de Antena" required>
                            </div>
                        </div>

                        <!-- IP Asignada Antena -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-rss"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoIp_Asignada_A" placeholder="Ingresar IP Asignada Antena" required>
                            </div>
                        </div>

                        <!-- N. Serie o Mac de Router -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-podcast"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoNumero_SMR" placeholder="Ingresar N. Serie o Mac de Router" required>
                            </div>
                        </div>

                        <!-- IP Asignada Router -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-rss"></i></span> 
                                <input type="text" class="form-control input-lg" name="nuevoIp_Asignada_R" placeholder="Ingresar IP Asignada Router" required>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Pie del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                </div>

            </form>

            <?php
            // Lógica para crear un nuevo cliente
            $crearCliente = new ControladorClientes();
            $crearCliente->ctrCrearCliente();
            ?>

        </div>
    </div>
</div>

<!--=====================================
MODAL Editar Cliente
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Formulario para editar cliente -->
            <form role="form" method="post" enctype="multipart/form-data">

                <!-- Cabecera del modal -->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- Entradas para editar la información del cliente -->
                        <!-- Nombre -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" value="" required>
                                <input type="hidden" id="idCliente" name="idCliente">
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono" value="" required>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="editarCalle" id="editarCalle" required>
                            </div>
                        </div>

                        <!-- Colonia -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="editarColonia" id="editarColonia" required>
                            </div>
                        </div>

                        <!-- Fecha de Instalación -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-lg" name="editarfechaInstalacion" id="editarfechaInstalacion" required>
                            </div>
                        </div>

                        <!-- N. Serie o Mac de Antena -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-podcast"></i></span>
                                <input type="text" class="form-control input-lg" name="editarNumero_SMA" id="editarNumero_SMA" required>
                            </div>
                        </div>

                        <!-- IP Asignada Antena -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-rss"></i></span>
                                <input type="text" class="form-control input-lg" name="editarIp_Asignada_A" id="editarIp_Asignada_A" required>
                            </div>
                        </div>

                        <!-- N. Serie o Mac de Router -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-podcast"></i></span>
                                <input type="text" class="form-control input-lg" name="editarNumero_SMR" id="editarNumero_SMR" required>
                            </div>
                        </div>

                        <!-- IP Asignada Router -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-rss"></i></span>
                                <input type="text" class="form-control input-lg" name="editarIp_Asignada_R" id="editarIp_Asignada_R" required>
                            </div>
                        </div>

                        <!-- Cantidad a Pagar -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="number" class="form-control input-lg" name="editarCantidad" id="editarCantidad" required>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Pie del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>

            </form>

            <?php
            // Lógica para editar un cliente
            $editarCliente = new ControladorClientes();
            $editarCliente->ctrEditarCliente();
            ?>

        </div>
    </div>
</div>


                <!-- Pie del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>

            </form>

            <?php
            // Lógica para editar un cliente
            $editarCliente = new ControladorClientes();
            $editarCliente->ctrEditarCliente();
            ?>

        </div>
    </div>
</div>

<?php
// Lógica para eliminar un cliente
$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();
?>



