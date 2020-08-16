<?php

class Conexion{

    static public function conectar(){

        $conn = new PDO("mysql:host = localhost;dbname=db_tareas","root","");
        $conn -> exec("set names utf8");

        return $conn;
    }
}