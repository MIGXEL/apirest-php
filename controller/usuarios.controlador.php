<?php

class ControladorUsuarios{

    /* ------ ------ ------ ------ */
    /* FUNCION CREATE CONTROLADOR ENVIA DATOS AL MODELO PARA CREAR REGISTRO */
    /* ------ ------ ------ ------ */
    public function create($datos){
        
        $tabla = 'usuarios';
        
        /* ------ ------ ------ ------ */
        /* VALIDAR DATOS RECIBIDOS */
        /* ------ ------ ------ ------ */

        
        /* VALIDANDO DATO NOMBRE */
        if (isset($datos["nombre"]) && !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $datos["nombre"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo nombre, ingrese un valor valido: ejemplo Juan"
            );
            
            echo json_encode($json, true);
    
            return;
        }
        /* VALIDANDO DATO APELLIDO */
        if (isset($datos["apellido"]) && !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $datos["apellido"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo apellido, ingrese un valor valido: ejemplo Gonzalez"
            );
            
            echo json_encode($json, true);
    
            return;
        }
        /* VALIDANDO DATO CORREO */
        if (isset($datos["correo"]) && !preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/", $datos["correo"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo email, ingrese un valor valido: ejemplo juan@juan.cl"
            );
            
            echo json_encode($json, true);
    
            return;
        }

        /* ------ ------ ------ ------ */
        /* VALIDAR SU CORREO INGRESA EXISTE EN BASE DE DATOS */
        /* ------ ------ ------ ------ */

        $correos = ModeloUsuarios::checkEmail($tabla);
        foreach ($correos as $key => $value) {
            if ($value["correo"] == $datos["correo"]) {
                $json = array(
                
                    "status"    => 404,
                    "detalle"   => "Correo existe en sistema"
                );
                
                echo json_encode($json, true);
        
                return;
            }
        }


        /* VALIDANDO DATO PASSWORD */
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
            "id_rol"        => empty($_POST['id_rol']) ? 2 : $_POST['id_rol'],
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

    /* ------ ------ ------ ------ */
    /* FUNCION INDEX CONTROLADOR SOLICITA TODOS LOS USUARIOS AL MODELO */
    /* ------ ------ ------ ------ */
    public function index(){

        $tabla = 'usuarios';
        $tabla2 = 'roles';
        
        $usuarios   = ModeloUsuarios::index($tabla, $tabla2);
        $json = array(
            
            "status" => 200,
            "total registros" => count($usuarios),
            "detalle" => $usuarios
        );
        echo json_encode($json, true);

        return;

        
    }

    /* ------ ------ ------ ------ */
    /* FUNCION SHOW CONTROLADOR SOLICITA UN RESGISTRO AL MODELO */
    /* ------ ------ ------ ------ */
    public function show($id){

        $tabla  = 'usuarios';
        $tabla2 = 'roles';        

        $usuario = ModeloUsuarios::show($tabla, $tabla2, $id);
        $json = array(
            
            "status" => 200,
            "detalle" => $usuario
        );

        echo json_encode($json, true);

        return;
    }

    /* ------ ------ ------ ------ */
    /* FUNCION UPDATE CONTROLADOR ENVIA DATOS AL MODELO PARA ACTUALIZAR REGISTRO */
    /* ------ ------ ------ ------ */
    public function update($id, $datos){
        $tabla = 'usuarios';
        /* ------ ------ ------ ------ */
        /* VALIDAR DATOS RECIBIDOS */
        /* ------ ------ ------ ------ */

        /* VALIDANDO DATO NOMBRE */
        if (isset($datos["nombre"]) && !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $datos["nombre"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo nombre, ingrese un valor valido: ejemplo Juan"
            );
            
            echo json_encode($json, true);
    
            return;
        }
        /* VALIDANDO DATO APELLIDO */
        if (isset($datos["apellido"]) && !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $datos["apellido"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo apellido, ingrese un valor valido: ejemplo Gonzalez"
            );
            
            echo json_encode($json, true);
    
            return;
        }
        /* VALIDANDO DATO CORREO */
        if (isset($datos["correo"]) && !preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/", $datos["correo"])) {
            
            $json = array(
                
                "status"    => 404,
                "detalle"   => "Error en el campo email, ingrese un valor valido: ejemplo juan@juan.cl"
            );
            
            echo json_encode($json, true);
    
            return;
        }

        /* VALIDANDO DATO PASSWORD */
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
            "id_rol"                => $datos["id_rol"],
            "nombre"                => $datos["nombre"],
            "apellido"              => $datos["apellido"],
            "titulo_profesion"      => $datos["titulo_profesion"],
            "correo"                => $datos["correo"],
            "password"              => $password,
            "token"                 => $token,
            "updated_at"            => date('Y-m-d H:i:s')
        );

        $update = ModeloUsuarios::update($tabla, $datos, $id);    
        
        /* ------ ------ ------ ------ */
        /* RECIBIR RESPUESTA DEL MODELO */
        /* ------ ------ ------ ------ */
        if ($update == "ok") {

            $json = array(
                
                "status"    => 200,
                "detalle"   => "registro actualizado exitosamente"
            );
            
            echo json_encode($json, true);
    
            return;
        }
    }

    /* ------ ------ ------ ------ */
    /* FUNCION DELETE CONTROLADOR ENVIA DATOS AL MODELO PARA ELIMINAR USUARIO */
    /* ------ ------ ------ ------ */
    public function delete($id){

        $tabla = 'usuarios';

        $usuario = ModeloUsuarios::delete($tabla, $id);
        
        $json = array(
            
            "status" => 200,
            "detalle" => 'registro eliminado exitosamente'
        );
        echo json_encode($json, true);

        return;

        
    }

    /* ------ ------ ------ ------ */
    /* FUNCION LOGIN CONTROLADOR */
    /* ------ ------ ------ ------ */
    public function login($datos){
        $tabla  = 'usuarios';
        $tabla2 = 'roles';

        /* ------ ------ ------ ------ */
        /* LLEVAR DATOS AL MODELO Y OBTENER INFORMACION DEL CLIENTE */
        /* ------ ------ ------ ------ */
        $usuario = ModeloUsuarios::login($tabla, $tabla2, $datos);

        /* ------ ------ ------ ------ */
        /* CONCATENAR PASSWORD Y CORREO DEL CLIENTE */
        /* ------ ------ ------ ------ */
        $verificar = $datos["password"].$datos["correo"];

        /* ------ ------ ------ ------ */
        /* VERIFICAR USUARIO POR TOKEN */
        /* ------ ------ ------ ------ */        
        if(password_verify($verificar, $usuario["token"])){

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