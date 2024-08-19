<?php

require_once "conexion.php";

class ModeloClientes{

    /*=====================================
    CREAR CLIENTES
    ======================================*/

    static public function mdlIngresarCliente($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, telefono, calle_n, colonia, fecha_instalacion, n_serie_mac_antena, ip_asignada_antena, n_serie_mac_router, ip_asignada_router, cantidad) VALUES (:nombre, :telefono, :calle_n, :colonia, :fecha_instalacion, :n_serie_mac_antena, :ip_asignada_antena, :n_serie_mac_router, :ip_asignada_router, :cantidad)");
    
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":calle_n", $datos["calle_n"], PDO::PARAM_STR);
        $stmt->bindParam(":colonia", $datos["colonia"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_instalacion", $datos["fecha_instalacion"], PDO::PARAM_STR);
        $stmt->bindParam(":n_serie_mac_antena", $datos["n_serie_mac_antena"], PDO::PARAM_STR);
        $stmt->bindParam(":ip_asignada_antena", $datos["ip_asignada_antena"], PDO::PARAM_STR);
        $stmt->bindParam(":n_serie_mac_router", $datos["n_serie_mac_router"], PDO::PARAM_STR);
        $stmt->bindParam(":ip_asignada_router", $datos["ip_asignada_router"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
    
        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }
    
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR CLIENTES
    ==============================================*/

    static public function mdlMostrarClientes($tabla, $item, $valor){

        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }

    /*=====================================
    EDITAR CLIENTES
    ======================================*/

    static public function mdlEditarCliente($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, telefono = :telefono, calle_n = :calle_n, colonia = :colonia, fecha_instalacion = :fecha_instalacion, n_serie_mac_antena = :n_serie_mac_antena, ip_asignada_antena = :ip_asignada_antena, n_serie_mac_router = :n_serie_mac_router, ip_asignada_router = :ip_asignada_router, cantidad = :cantidad WHERE id = :id");
    
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":calle_n", $datos["calle_n"], PDO::PARAM_STR);
        $stmt->bindParam(":colonia", $datos["colonia"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_instalacion", $datos["fecha_instalacion"], PDO::PARAM_STR);
        $stmt->bindParam(":n_serie_mac_antena", $datos["n_serie_mac_antena"], PDO::PARAM_STR);
        $stmt->bindParam(":ip_asignada_antena", $datos["ip_asignada_antena"], PDO::PARAM_STR);
        $stmt->bindParam(":n_serie_mac_router", $datos["n_serie_mac_router"], PDO::PARAM_STR);
        $stmt->bindParam(":ip_asignada_router", $datos["ip_asignada_router"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
    
        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }
    
        $stmt->close();
        $stmt = null;
    }
    
    /*=============================================
    ELIMINAR CLIENTE
    =============================================*/

    static public function mdlEliminarCliente($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

}
