<?php

class ControladorTareas{

    public function index(){


        $tareas = ModeloTareas::index("cursos");


        $json = array(
            
            "status" => 200,
            "total registros" => count($tareas),
            "detalle" => $tareas
        );
        
        echo json_encode($json, true);

        return;
    }

    public function create(){

        $json = array(
            
            "detalle" => "Tareas creada exitosamente"
        );
        
        echo json_encode($json, true);

        return;
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