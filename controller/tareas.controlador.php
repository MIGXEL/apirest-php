<?php

class ControladorTareas{
    
    /* ------ ------ ------ ------ */
    /* SOLICITAR AL MODELO MOSTRAR TODAS LAS TAREAS */
    /* ------ ------ ------ ------ */
    public function index(){
        
        $tabla = "tareas";
        $tabla2 = "usuarios";
        $tabla3 = "empresas";
        $tabla4 = "estados";

        $tareas = ModeloTareas::index($tabla, $tabla2, $tabla3, $tabla4);


        $json = array(
            
            "status" => 200,
            "total registros" => count($tareas),
            "detalle" => $tareas
        );
        
        echo json_encode($json, true);

        return;
    }

    /* ------ ------ ------ ------ */
    /* SOLICITAR AL MODELO CREAR UNA NUEVA TAREA EN DB */
    /* ------ ------ ------ ------ */
    public function create($datos){

        $tabla = "tareas";

        /* CREACION DE ARRAY DATOS DE TAREA PARA ENVIAR AL MODELO */
        $datos = array(

            "id_usuario"    => $_POST["id_usuario"],
            "titulo"        => $_POST["titulo"],
            "id_empresa"    => $_POST["id_empresa"],
            "descripcion"   => $_POST["descripcion"],
            "fecha_inicio"  => $_POST["fecha_inicio"],
            "fecha_termino" => $_POST["fecha_termino"],
            "id_estado"     => 1,
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date('Y-m-d H:i:s')
        );
        
        /* LLEVAR ARRAY DE DATOS AL MODELO */
        $create = ModeloTareas::create($tabla, $datos);    
       
        /* RECIBIR RESPUESTA DEL MODELO */
        if ($create == "ok") {

            $json = array(
                
                "status"    => 200,
                "detalle"   => "Tarea creada exitosamente"
            );
            
            echo json_encode($json, true);
    
            return;
        }
    }

    /* ------ ------ ------ ------ */
    /* SOLICITAR AL MODELO MOSTRAR TAREA SEGUN ID */
    /* ------ ------ ------ ------ */
    public function show($id){

        $tabla = "tareas";
        $tabla2 = "usuarios";
        $tabla3 = "empresas";
        $tabla4 = "estados";

        $tarea = ModeloTareas::show($tabla, $tabla2, $tabla3, $tabla4, $id);


        $json = array(
            
            "status" => 200,
            "detalle" => $tarea
        );
        
        echo json_encode($json, true);

        return;
    }

    /* ------ ------ ------ ------ */
    /* SOLICITAR AL MODELO ACTUALIZAR TAREA SEGUN ID EN DB */
    /* ------ ------ ------ ------ */
    public function update($id, $datos){
        
        $tabla = 'tareas';
        
        /* ------ ------ ------ ------ */
        /* LLEVAR DATOS AL MODELO */
        /* ------ ------ ------ ------ */

        $datos = array(

            "titulo"        => $datos["titulo"],
            "descripcion"   => $datos["descripcion"],
            "observacion"   => $datos["observacion"],
            "id_empresa"    => $datos["id_empresa"],
            "id_estado"     => $datos["id_estado"],
            "fecha_inicio"  => $datos["fecha_inicio"],
            "fecha_termino" => $datos["fecha_termino"],
            "updated_at"    => date('Y-m-d H:i:s')
        );

        $update = ModeloTareas::update($tabla, $datos, $id);    
        
        /* ------ ------ ------ ------ */
        /* RECIBIR RESPUESTA DEL MODELO */
        /* ------ ------ ------ ------ */
        if ($update == "ok") {

            $json = array(
                
                "status"    => 200,
                "detalle"   => "Tarea actualizada exitosamente"
            );
            
            echo json_encode($json, true);
    
            return;
        }
    }

    /* ------ ------ ------ ------ */
    /* SOLICITAR AL MODELO ELIMINAR TAREA SEGUN ID EN DB */
    /* ------ ------ ------ ------ */
    /* ------ ------ ------ ------ */
    /* FUNCION DELETE CONTROLADOR ENVIA DATOS AL MODELO PARA ELIMINAR USUARIO */
    /* ------ ------ ------ ------ */
    public function delete($id){

        $tabla = 'tareas';

        $tarea = ModeloTareas::delete($tabla, $id);
        
        $json = array(
            
            "status" => 200,
            "detalle" => 'Tarea eliminado exitosamente'
        );
        echo json_encode($json, true);

        return;

        
    }
}