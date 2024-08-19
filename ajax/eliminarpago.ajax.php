<?php

require_once "../controladores/historial.controlador.php";
require_once "../modelos/historial.modelo.php";

class AjaxEliminarPago
{
    public $idPago;

    public function ajaxEliminarPago()
    {
        // Asegúrate de que la respuesta devuelta sea un valor JSON
        $respuesta = ControladorHistorial::ctrEliminarPago($this->idPago);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["idPago"])) {
    $eliminarPago = new AjaxEliminarPago();
    $eliminarPago->idPago = $_POST["idPago"];
    $eliminarPago->ajaxEliminarPago();
}
