<?php

require_once 'conexion.php';

class ModeloTareas {

    
    /* ------ ------ CREAR TAREAS ------ ------ */
    
    static public function create($tabla, $datos){        
        
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (id_usuario, titulo, descripcion, fecha_inicio, fecha_termino, created_at, updated_at) 
        VALUES (:id_usuario, :titulo, :descripcion, :fecha_inicio, :fecha_termino, :created_at, :updated_at)");

        $stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_incio", $datos["fecha_incio"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_STR);
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

    /* ------ ------ MOSTRAR TODOS LAS TAREAS ------ ------ */

    static public function index($tabla, $tabla2, $tabla3){

        $stmt = Conexion::conectar() -> prepare("SELECT $tabla.id, $tabla.id_usuario, $tabla.titulo, $tabla.descripcion, $tabla.observacion, $tabla.id_empresa, $tabla.estado, $tabla.fecha_inicio, $tabla.fecha_termino,
                                                    $tabla2.nombre, $tabla2.apellido, $tabla2.correo, $tabla3.nombre as nombre_empresa 
                                                    FROM $tabla INNER JOIN $tabla2 ON $tabla2.id = $tabla.id_usuario 
                                                    INNER JOIN $tabla3 ON $tabla3.id = $tabla.id_empresa");

        if ($stmt -> execute()) {

            return $stmt -> fetchAll(PDO::FETCH_CLASS);
            
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

}