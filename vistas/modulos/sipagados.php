<?php
require_once "conexion.php";

class ModeloPagoss {
    /* OBTENER CLIENTES QUE HAN PAGADO */
    static public function mdlObtenerClientesPagados($fechaSeleccionada) {
        $stmt = Conexion::conectar()->prepare("SELECT c.nombre AS nombre_cliente, c.ip_asignada_router, p.monto
            FROM clientes AS c
            INNER JOIN pagos AS p ON c.id = p.id_cliente 
            WHERE DATE_FORMAT(p.fecha_pago, '%Y-%m-%d') = :fechaSeleccionada");

        $stmt->bindParam(":fechaSeleccionada", $fechaSeleccionada, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cierra la conexión PDO después de usarla
        $stmt = null;
    }
}

// Verificar si se ha enviado un mes y día específico desde el formulario
$fechaSeleccionada = (isset($_POST['fechaSeleccionada'])) ? $_POST['fechaSeleccionada'] : date('Y-m-d');

$clientesPagados = ModeloPagoss::mdlObtenerClientesPagados($fechaSeleccionada);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Agrega aquí tus enlaces a las hojas de estilo y scripts necesarios -->
</head>
<body>
    <div class="content-wrapper">
        <section class="content">
        <h1>Reporte de Pagos Pagados</h1>
            <!-- Formulario para seleccionar la fecha -->
            <form method="post">
                <div class="form-group">
                    <label for="fechaSeleccionada">Seleccionar Fecha:</label>
                    <input type="date" id="fechaSeleccionada" name="fechaSeleccionada" value="<?php echo $fechaSeleccionada; ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
                            <?php if (count($clientesPagados) > 0): ?>
                                <table class="table table-bordered table-striped dt-responsive tablas">
                                    <thead>
                                        <tr>
                                            <th>#</th> <!-- Número de cliente -->
                                            <th>Nombre del Cliente</th>
                                            <th>Ip Asignada Router</th>
                                            <th>Monto Pagado</th> <!-- Nueva columna para el monto pagado -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientesPagados as $key => $cliente): ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo htmlspecialchars($cliente['nombre_cliente']); ?></td>
                                                <td><?php echo htmlspecialchars($cliente['ip_asignada_router']); ?></td>
                                                <td><?php echo htmlspecialchars($cliente['monto']); ?></td> <!-- Mostrar el monto pagado -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>No hay clientes que hayan pagado en la fecha seleccionada.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Agrega aquí tus enlaces a scripts adicionales si es necesario -->
</body>
</html>
