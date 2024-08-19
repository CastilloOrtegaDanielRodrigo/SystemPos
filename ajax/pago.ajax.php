<?php

require_once "../modelos/pagos.modelo.php";

if (isset($_POST["idCliente"])) {
    $idCliente = $_POST["idCliente"];
    $respuesta = ModeloPago::mdlObtenerCantidadCliente($idCliente);
    echo $respuesta["cantidad"];
}

?>
