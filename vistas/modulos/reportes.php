<?php
// Verificar si se ha enviado un mes específico desde el formulario
$mesSeleccionado = (isset($_POST['mesSeleccionado'])) ? $_POST['mesSeleccionado'] : date('Y-m');

// Consulta SQL para obtener los clientes que no han pagado el mes seleccionado
$sql = "SELECT c.nombre AS nombre_cliente, c.ip_asignada_router
        FROM clientes AS c
        LEFT JOIN pagos AS p ON c.id = p.id_cliente AND p.mes = :mesSeleccionado
        WHERE p.id IS NULL";

$stmt = Conexion::conectar()->prepare($sql);
$stmt->bindParam(':mesSeleccionado', $mesSeleccionado, PDO::PARAM_STR);
$stmt->execute();

$clientesNoPagados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcular la cantidad total acumulada pendiente
$totalPendiente = count($clientesNoPagados) * 250.00;
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Agrega aquí tus enlaces a las hojas de estilo y scripts necesarios -->
</head>
<body>
    <div class="content-wrapper">
        <section class="content">
        <h1>Reporte de Pagos</h1>
            <!-- Formulario para seleccionar el mes -->
            <form method="post">
                <div class="form-group">
                    <label for="mesSeleccionado">Seleccionar Mes:</label>
                    <input type="month" id="mesSeleccionado" name="mesSeleccionado" value="<?php echo $mesSeleccionado; ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
                            <?php if (count($clientesNoPagados) > 0): ?>
                                <table class="table table-bordered table-striped dt-responsive tablas">
                                    <thead>
                                        <tr>
                                            <th>#</th> <!-- Número de cliente -->
                                            <th>Nombre del Cliente</th>
                                            <th>Ip Asignada Router</th>
                                            <th>Cuanto Debe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientesNoPagados as $key => $cliente): ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo htmlspecialchars($cliente['nombre_cliente']); ?></td>
                                                <td><?php echo htmlspecialchars($cliente['ip_asignada_router']); ?></td>
                                                <td>$<?php echo number_format(250, 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>No hay clientes que no hayan pagado <?php echo date('F', strtotime($mesSeleccionado)); ?>.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cantidad total acumulada -->
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
                            <h3>Cantidad Total Acumulada Pendiente</h3>
                            <h4>$<?php echo number_format($totalPendiente, 2); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Agrega aquí tus enlaces a scripts adicionales si es necesario -->
</body>
</html>
