<?php

require_once "conexion.php";

class ModeloPago {

    /* GENERAR PAGO */
    static public function mdlIngresarPago($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cliente, nom_cliente, id_vendedor, mes, total, metodo_pago)
        VALUES (:id_cliente, :nom_cliente, :id_vendedor, :mes, :total, :metodo_pago)");

        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":nom_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
        $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_INT);
        $stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ELIMINAR PAGO */
    static public function mdlEliminarPagoCliente($idCliente) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM pagos WHERE id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $idCliente, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* VERIFICAR PAGO DUPLICADO */
    static public function mdlVerificarPagoDuplicado($tabla, $id_cliente, $mes) {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as count FROM $tabla WHERE id_cliente = :id_cliente AND mes = :mes");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }
 /* VOBTENER LA CANTIDAD DEL CLIENTE */
    static public function mdlObtenerCantidadCliente($idCliente) {
        $stmt = Conexion::conectar()->prepare("SELECT cantidad FROM clientes WHERE id = :id_cliente");
        $stmt->bindParam(":id_cliente", $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>
