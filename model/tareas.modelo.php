<?php

require_once 'conexion.php';

class ModeloTareas {

    /* ------ ------ MOSTRAR TODOS LAS TAREAS ------ ------ */

    static public function index($tabla){

        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_CLASS);
        $stmt = null;
        
    }

    /* ------ ------ CREAR TAREAS ------ ------ */

    static public function create($tabla, $datos){

        

        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (id_usuario, titulo, descripcion, created_at, updated_at) 
        VALUES (:id_usuario, :titulo, :descripcion, :created_at, :updated_at)");

        $stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":created_at", $datos["created_at"], PDO::PARAM_STR);
        $stmt -> bindParam(":updated_at", $datos["updated_at"], PDO::PARAM_STR);
        
        if ($stmt -> execute()) {
            return "ok";
        }else{
            
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt -> close();
        $stmt = null;
        
    }


}