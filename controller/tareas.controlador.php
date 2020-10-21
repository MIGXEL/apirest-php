<?php

class ControladorTareas{
    
    /* ------ ------ ------ ------ */
    /* SOLICITAR AL MODELO MOSTRAR TODAS LAS TAREAS */
    /* ------ ------ ------ ------ */
    public function index(){
        
        $tabla = "tareas";

        $tareas = ModeloTareas::index($tabla);


        $json = array(
            
            "status" => 200,
            "total registros" => count($tareas),
            "detalle" => $tareas
        );
        
        echo json_encode($json, true);

        return;
    }

    public function create($datos){

        $tabla = "tareas";

        /* ------ ------ ------ ------ */
        /* LLEVAR DATOS AL MODELO */
        /* ------ ------ ------ ------ */

        $datos = array(

            "id_usuario"    => $_POST["id_usuario"],
            "titulo"        => $_POST["titulo"],
            "descripcion"   => $_POST["descripcion"],
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date('Y-m-d H:i:s')
        );

        $create = ModeloTareas::create($tabla, $datos);    
        
        /* ------ ------ ------ ------ */
        /* RECIBIR RESPUESTA DEL MODELO */
        /* ------ ------ ------ ------ */
        if ($create == "ok") {

            $json = array(
                
                "status"    => 200,
                "detalle"   => "Tarea creada exitosamente"
            );
            
            echo json_encode($json, true);
    
            return;
        }
    }

    public function show($id){

        $json = array(
            
            "detalle" => "Mostrar tarea con id: ".$id
        );
        
        echo json_encode($json, true);

        return;
    }

    public function update($id){

        $json = array(
            
            "detalle" => "Tarea editada con id: ".$id
        );
        
        echo json_encode($json, true);

        return;
    }

    public function delete($id){

        $json = array(
            
            "detalle" => "Se ha borrado la tarea con id: ".$id
        );
        
        echo json_encode($json, true);

        return;
    }
}