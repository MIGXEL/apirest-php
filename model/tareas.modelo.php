<?php

require_once 'conexion.php';

class ModeloTareas {

    
    /* ------ ------ CREAR TAREAS ------ ------ */
    
    static public function create($tabla, $datos){        
        echo '<pre>'; print_r($datos);echo '</pre>';
        
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (id_usuario, titulo, descripcion, id_empresa, id_estado, fecha_inicio, fecha_termino, created_at, updated_at) 
                                                VALUES (:id_usuario, :titulo, :descripcion, :id_empresa, :id_estado, :fecha_inicio, :fecha_termino, :created_at, :updated_at)");

        $stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
        $stmt -> bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_INT);
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

    static public function index($tabla, $tabla2, $tabla3, $tabla4){

        $stmt = Conexion::conectar() -> prepare("SELECT $tabla.id, $tabla.id_usuario, $tabla.titulo, $tabla.descripcion, $tabla.observacion, $tabla.id_empresa, $tabla.id_estado, $tabla.fecha_inicio, $tabla.fecha_termino,
                                                    $tabla2.nombre, $tabla2.apellido, $tabla2.correo, $tabla3.nombre as nombre_empresa, $tabla4.estado 
                                                    FROM $tabla INNER JOIN $tabla2 ON $tabla2.id = $tabla.id_usuario 
                                                    INNER JOIN $tabla3 ON $tabla3.id = $tabla.id_empresa
                                                    INNER JOIN $tabla4 ON $tabla4.id = $tabla.id_estado");

        if ($stmt -> execute()) {

            return $stmt -> fetchAll(PDO::FETCH_CLASS);
            
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    /* ------ ------ MOSTRAR TAREA SEGUN ID ------ ------ */

    static public function show($tabla, $tabla2, $tabla3, $tabla4, $id){

        $stmt = Conexion::conectar() -> prepare("SELECT $tabla.id, $tabla.id_usuario, $tabla.titulo, $tabla.descripcion, $tabla.observacion, $tabla.id_empresa, $tabla.id_estado, $tabla.fecha_inicio, $tabla.fecha_termino,
                                                    $tabla2.nombre, $tabla2.apellido, $tabla2.correo, $tabla3.nombre as nombre_empresa, $tabla4.estado 
                                                    FROM $tabla INNER JOIN $tabla2 ON $tabla2.id = $tabla.id_usuario 
                                                    INNER JOIN $tabla3 ON $tabla3.id = $tabla.id_empresa
                                                    INNER JOIN $tabla4 ON $tabla4.id = $tabla.id_estado
                                                    WHERE $tabla.id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($stmt -> execute()) {

            return $stmt -> fetch(PDO::FETCH_ASSOC);
            
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    /* ------ ------ ACTUALIZAR TAREA SEGUN ID ------ ------ */

    static public function update($tabla, $datos, $id){
        
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET titulo=:titulo, descripcion=:descripcion, observacion=:observacion, 
                                                id_empresa=:id_empresa, id_estado=:id_estado, fecha_inicio=:fecha_inicio, fecha_termino=:fecha_termino, 
                                                updated_at=:updated_at WHERE $tabla.id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
        $stmt -> bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_INT);
        $stmt -> bindParam(":updated_at", $datos["updated_at"], PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    /* ------ ------ ELIMINAR TAREA SEGUN ID ------ ------ */

    static public function delete($tabla, $id){
                
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($stmt -> execute()) {

            return $stmt -> fetch(PDO::FETCH_ASSOC);
            
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

}