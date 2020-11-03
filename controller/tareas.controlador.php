<?php

class ControladorTareas{
    
    /* ------ ------ ------ ------ */
    /* SOLICITAR AL MODELO MOSTRAR TODAS LAS TAREAS */
    /* ------ ------ ------ ------ */
    public function index(){
        
        $tabla = "tareas";
        $tabla2 = "usuarios";
        $tabla3 = "empresas";

        $tareas = ModeloTareas::index($tabla, $tabla2, $tabla3);


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

            "id_usuario"        => $_POST["id_usuario"],
            "titulo"            => $_POST["titulo"],
            "descripcion"       => $_POST["descripcion"],
            "fecha_inicio"      => 3131313131321,
            "fecha_termino"     => 1321321321321,
            "created_at"        => date("Y-m-d H:i:s"),
            "updated_at"        => date('Y-m-d H:i:s')
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