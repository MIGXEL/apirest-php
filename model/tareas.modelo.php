<?php

require_once 'conexion.php';

class ModeloTareas {

    /* ------ ------ MOSTRAR TODOS LAS TAREAS ------ ------ */

    static public function index($tabla){

        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_CLASS);
        $stmt -> close;
        $stmt = null;
        
    }


}