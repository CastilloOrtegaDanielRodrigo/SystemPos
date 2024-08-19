<?php
require_once "conexion.php";

class ModeloHistorial
{
    /*=====================================
    OBTENER HISTORIAL DE PAGOS
    ======================================*/
    static public function mdlObtenerHistorialPagos($idCliente)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT mes, fecha, total, id_cliente, nom_cliente FROM pagos WHERE id_cliente = :idCliente ORDER BY mes ASC");
            $stmt->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /*=====================================
    ELIMINAR PAGO
    ======================================*/
    static public function mdlEliminarPago($idPago)
    {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM pagos WHERE id_pago = :idPago");
            $stmt->bindParam(":idPago", $idPago, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
