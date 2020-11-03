<?php

require_once 'conexion.php';

class ModeloUsuarios {

    /* static public function index($tabla){

        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_CLASS);
        $stmt -> close;
        $stmt = null;
        
    } */

    /* ------ ------ ------ ------ */
    /* GUARDAR REGISTRO USUSARIO EN BASE DE DATOS */
    /* ------ ------ ------ ------ */

    static public function create($tabla, $datos){

        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (id_rol, nombre, apellido, correo, password, token, created_at, updated_at) 
        VALUES (:id_rol, :nombre, :apellido, :correo, :password, :token, :created_at, :updated_at)");

        $stmt -> bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":token", $datos["token"], PDO::PARAM_STR);
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

    /* ------ ------ ------ ------ */
    /* CONSULTAR TODOS LOS USUARIOS A BASE DE DATOS */
    /* ------ ------ ------ ------ */
    static public function index($tabla, $tabla2){

        $stmt = Conexion::conectar() -> prepare("SELECT $tabla.id, $tabla.nombre, $tabla.apellido, $tabla.titulo_profesion, $tabla.correo, $tabla.token, $tabla.created_at as fecha_creación, $tabla2.rol 
        FROM $tabla INNER JOIN $tabla2 ON $tabla2.id = $tabla.id_rol");

        if ($stmt -> execute()) {

            return $stmt -> fetchAll(PDO::FETCH_CLASS);
            
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    /* ------ ------ ------ ------ */
    /* CONSULTAR USUARIO A BASE DE DATOS SEGUN ID */
    /* ------ ------ ------ ------ */
    static public function show($tabla, $tabla2, $id){
                
        $stmt = Conexion::conectar() -> prepare("SELECT $tabla.id, $tabla.nombre, $tabla.apellido, $tabla.titulo_profesion, $tabla.correo, $tabla.token, $tabla.created_at as fecha_creación, $tabla2.rol 
                                        FROM $tabla INNER JOIN $tabla2 ON $tabla2.id = $tabla.id_rol WHERE $tabla.id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($stmt -> execute()) {

            return $stmt -> fetch(PDO::FETCH_ASSOC);
            
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    /* ------ ------ ------ ------ */
    /* ACTUALIZAR USUARIO EN BASE DE DATOS SEGUN ID */
    /* ------ ------ ------ ------ */
    static public function update($tabla, $datos, $id){
        /* echo '<pre>'; print_r($id);echo '</pre>';
        return; */
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET id_rol=:id_rol, nombre=:nombre, apellido=:apellido, titulo_profesion=:titulo_profesion, correo=:correo, 
                                                password=:password, token=:token, updated_at=:updated_at WHERE id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_STR);
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt -> bindParam(":titulo_profesion", $datos["titulo_profesion"], PDO::PARAM_STR);
        $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":token", $datos["token"], PDO::PARAM_STR);
        $stmt -> bindParam(":updated_at", $datos["updated_at"], PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    /* ------ ------ ------ ------ */
    /* ELIMINAR UN REGISTRO EN BASE DE DATOS SEGUN ID */
    /* ------ ------ ------ ------ */
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

    /* ------ ------ ------ ------ */
    /* CONSULTAR REGISTRO USUARIO A BASE DE DATOS */
    /* ------ ------ ------ ------ */
    static public function login($tabla, $tabla2, $datos){
        
        $stmt = Conexion::conectar() -> prepare("SELECT $tabla.id, $tabla.nombre, $tabla.apellido, $tabla.titulo_profesion, $tabla.correo, $tabla.token, $tabla2.rol 
                                                FROM $tabla INNER JOIN $tabla2 ON $tabla2.id = $tabla.id_rol WHERE $tabla.correo = :correo");

        $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        if ($stmt -> execute()) {
            return $stmt -> fetch(PDO::FETCH_ASSOC);
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    /* ------ ------ ------ ------ */
    /* OBTENER CORREO PARA VERIFICAR EXISTENCIA */
    /* ------ ------ ------ ------ */
    static public function checkEmail($tabla){

        $stmt = Conexion::conectar() -> prepare("SELECT correo FROM $tabla");

        if ($stmt -> execute()) {

            return $stmt -> fetchAll();
            
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

}

