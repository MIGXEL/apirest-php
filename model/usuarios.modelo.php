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

        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (nombre, apellido, correo, password, token, created_at, updated_at) 
        VALUES (:nombre, :apellido, :correo, :password, :token, :created_at, :updated_at)");

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

    static public function index($tabla){

        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");

        if ($stmt -> execute()) {
            return $stmt -> fetchAll();
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

    static public function login($tabla, $datos){

        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE correo = :correo");

        $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return $stmt -> fetch();
        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt -> close();
        $stmt = null;
    }

}

