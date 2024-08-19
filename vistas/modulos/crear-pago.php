<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Agrega aquí tus enlaces a las hojas de estilo y scripts necesarios, como Bootstrap y jQuery -->
    <link rel="stylesheet" href="ruta/a/tu/hoja-de-estilo.css">
    <script src="ruta/a/jquery.js"></script>
    <script src="ruta/a/bootstrap.js"></script>
    <style>
        /* CSS para centrar el formulario y ajustar el tamaño */
        .center-content {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alinea el formulario más arriba */
            min-height: 100vh;
            padding-top: 20px; /* Espacio en la parte superior */
        }

        .form-box {
            width: 50%; /* Ajusta el ancho de la caja del formulario */
        }
    </style>
</head>
<body>
    <div class="content-wrapper" style="background-color: #f2f2f2;">
        <section class="content-header">
            <h1>Generar Pagos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Pagos</a></li>
                <li class="active">Generar Pagos</li>
            </ol>
        </section>
        <section class="content">
            <div class="center-content"> <!-- Clase agregada para centrar el contenido -->
                <div class="col-lg-5 col-xs-12 form-box"> <!-- Clase para ajustar el tamaño de la caja del formulario -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <form role="form" method="post">
                                <div class="box-body">
                                    <!-- Contenido del formulario -->
                                    <div class="form-group">
                                        <label for="nuevoVendedor">Vendedor:</label>
                                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo htmlspecialchars($_SESSION["nombre"]); ?>" readonly>
                                        <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="seleccionarCliente">Cliente:</label>
                                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                                            <option value="">Seleccionar Cliente</option>
                                            <?php
                                            $item = null;
                                            $valor = null;
                                            $categoria = ControladorClientes::ctrMostrarClientes($item, $valor);
                                            foreach ($categoria as $key => $value) {
                                                echo '<option value="' . $value["id"] . '" data-precio="' . $value["cantidad"] . '">' . htmlspecialchars($value["nombre"]) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="nombreCliente" value="">
                                    <script>
                                        $("#seleccionarCliente").select2();
                                    </script>
                                    <script>
                                        $("#seleccionarCliente").change(function() {
                                            var precioServicio = $(this).find(":selected").data("precio");
                                            $("#nuevoValorEfectivo").val(precioServicio);
                                            var nombreCliente = $("#seleccionarCliente option:selected").text();
                                            $("input[name='nombreCliente']").val(nombreCliente);
                                        });
                                    </script>
                                    <div class="form-group">
                                        <label for="nuevoMesPago">Mes de Pago:</label>
                                        <input type="month" id="nuevoMesPago" name="nuevoMesPago" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-6">
                                            <label for="nuevoMetodoPago">Método de Pago:</label>
                                            <input type="text" class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" value="Efectivo" readonly>
                                        </div>
                                        <div class="col-xs-6">
                                            <label for="nuevoValorEfectivo">Valor en Efectivo:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nuevoValorEfectivo" name="nuevoValorEfectivo" readonly>
                                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">Pagar Mensualidad</button>
                                </div>
                            </form>
                            <?php
                            $guardarPago = new ControladorPago();
                            $guardarPago->ctrCrearPago();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
