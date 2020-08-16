<?php

class ControladorUsuarios{

    public function create($datos){
        
        $tabla = 'usuarios';
        /* ------ ------ ------ ------ */
        /* VALIDAR DATOS RECIBIDOS */
        /* ------ ------ ------ ------ */

        if (isset($datos["nombre"]) && !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $datos["nombre"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo nombre, ingrese un valor valido: ejemplo Juan"
            );
            
            echo json_encode($json, true);
    
            return;
        }

        if (isset($datos["apellido"]) && !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $datos["apellido"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo apellido, ingrese un valor valido: ejemplo Gonzalez"
            );
            
            echo json_encode($json, true);
    
            return;
        }

        if (isset($datos["correo"]) && !preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/", $datos["correo"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo email, ingrese un valor valido: ejemplo juan@juan.cl"
            );
            
            echo json_encode($json, true);
    
            return;
        }

        if (isset($datos["password"]) && !preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/",$datos["password"])) {

            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo password",
                "contener"  =>array(
                    "a.-" => "8 caracteres",
                    "b.-" => "al menos 1 letra mayuscula",
                    "c.-" => "al menos 1 signo especial $%&#"
                )
            );
            
            echo json_encode($json, true);
    
            return;
        }

        /* ------ ------ ------ ------ */
        /* HASHEAR PASSWORD Y CREAR TOKEN */
        /* ------ ------ ------ ------ */

        $password   = password_hash($datos["password"], PASSWORD_DEFAULT);
        $token      = password_hash($datos["password"].$datos["correo"], PASSWORD_DEFAULT);

        /* ------ ------ ------ ------ */
        /* LLEVAR DATOS AL MODELO */
        /* ------ ------ ------ ------ */

        $datos = array(
            "nombre"        => $datos["nombre"],
            "apellido"      => $datos["apellido"],
            "correo"        => $datos["correo"],
            "password"      => $password,
            "token"         => $token,
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date('Y-m-d H:i:s')
        );

        $create = ModeloUsuarios::create($tabla, $datos);    
        
        /* ------ ------ ------ ------ */
        /* RECIBIR RESPUESTA DEL MODELO */
        /* ------ ------ ------ ------ */
        if ($create == "ok") {

            $json = array(
                
                "status"    => 200,
                "detalle"   => "registro creado exitosamente"
            );
            
            echo json_encode($json, true);
    
            return;
        }
   

    }

    public function show(){

        $tabla = 'usuarios';

        $index = ModeloUsuarios::index($tabla);

        $json = array(
            
            "status" => 200,
            "total registros" => count($index),
            "detalle" => $index
        );

        echo json_encode($json, true);

        return;
    }

    public function login($datos){

        

        $tabla = 'usuarios';

        /* ------ ------ ------ ------ */
        /* HASHEAR PASSWORD Y CREAR TOKEN */
        /* ------ ------ ------ ------ */

        /* $password   = password_hash($datos["password"], PASSWORD_DEFAULT); */
        $verificar = $datos["password"].$datos["correo"];

        /* ------ ------ ------ ------ */
        /* LLEVAR DATOS AL MODELO */
        /* ------ ------ ------ ------ */

        $login = ModeloUsuarios::login($tabla, $datos);    
        
        /* ------ ------ ------ ------ */
        /* RECIBIR RESPUESTA DEL MODELO */
        /* ------ ------ ------ ------ */
        
        if(password_verify($verificar, $login["token"])){

            $usuario = array(
                "nombre"        => $login["nombre"],
                "apellido"      => $login["apellido"],
                "correo"        => $login["correo"]
            );

            $json = array(
            
                "status"    => 200,
                "login"     => true,
                "detalle"   => $usuario
            );

        }else{

            $json = array(

                "status"    => 404,
                "login"     => false,
                "detalle" => "Usuario o contraseña no coinciden"
            );
        }
        
         echo json_encode($json, true);

        
        
    }
}