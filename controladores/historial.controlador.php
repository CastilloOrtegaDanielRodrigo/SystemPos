<?php
class ControladorHistorial
{
    /*=====================================
    OBTENER HISTORIAL DE PAGOS
    ======================================*/

    static public function ctrObtenerHistorialPagos($idCliente)
    {
        try {
            $respuesta = ModeloHistorial::mdlObtenerHistorialPagos($idCliente);
            return $respuesta;
        } catch (PDOException $e) {
            return [];
        }
    }
}
