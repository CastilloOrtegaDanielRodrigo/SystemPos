<?php

require_once "../controladores/historial.controlador.php";
require_once "../modelos/historial.modelo.php";

class AjaxHistorial
{
    /*=====================================
    OBTENER HISTORIAL DE PAGOS
    ======================================*/
    public $idPago;

    public function ajaxObtenerHistorialPagos()
    {
        if ($this->idPago != "") {
            $respuesta = ControladorHistorial::ctrObtenerHistorialPagos($this->idPago);
            echo json_encode($respuesta);
        }
    }
}

/*=====================================
OBTENER HISTORIAL DE PAGOS
=====================================*/
if (isset($_POST["idPago"])) {
    $historial = new AjaxHistorial();
    $historial->idPago = $_POST["idPago"];
    $historial->ajaxObtenerHistorialPagos();
}




