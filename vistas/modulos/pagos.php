<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Pagos</title>

    <!-- Enlaces a los estilos y scripts externos -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<body>

<!-- Contenido principal -->
<div class="content-wrapper">
    <!-- Encabezado de la sección -->
    <section class="content-header">
        <h1>Administrar Pagos</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Vista</a></li>
            <li class="active">Administrar Pagos</li>
        </ol>
    </section>

    <!-- Contenido de la sección -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <!-- Botón para agregar un pago -->
                <a href="crear-pago">
                    <button class="btn btn-primary">Agregar Pago</button>
                </a>
            </div>

            <div class="box-body">
                <!-- Tabla para mostrar los clientes y acciones -->
                <table class="table table-bordered table-striped tablas dataTable">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Cliente</th>
                            <th>Colonia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Iteración para mostrar los clientes
                        $item = null;
                        $valor = null;
                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                        foreach ($clientes as $key => $value) {
                            echo '
                                <tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $value["nombre"] . '</td>
                                    <td>' . $value["colonia"] . '</td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Botón para mostrar historial de pagos -->
                                            <button class="btn btn-info btnMostrarHistorial" data-toggle="modal" data-target="#modalHistorialPagos" idPago="' . $value['id'] . '"><i class=" fa fa-info"></i></button>
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

<!-- Modal para mostrar el historial de pagos -->
<div class="modal fade" id="modalHistorialPagos" tabindex="-1" role="dialog" aria-labelledby="modalHistorialPagosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="modalHistorialPagosLabel">Historial de Pagos</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tabla para mostrar el historial de pagos -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>ID </th>
                                <th>Nombre</th>
                                <th>Año y Mes</th>
                                <th>Fecha del Sistema</th>
                                <th>Total</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoHistorialPagos">
                            <!-- Los datos del historial se cargarán a través de AJAX aquí -->
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total acumulado:</strong></td>
                                <td id="totalAcumulado">$ <span id="totalValor"></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para inicializar el DataTable -->
<script>
    $(document).ready(function() {
        var table = $('.dataTable').DataTable();

        // Función para filtrar la tabla al escribir en el input de búsqueda
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>

</body>
</html>
