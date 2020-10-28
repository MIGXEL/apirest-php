<?php

$rutasArray = explode("/", $_SERVER['REQUEST_URI']);
/* echo '<pre>'; print_r(array_filter($rutasArray));echo '</pre>';
return; */




if (count(array_filter($rutasArray)) == 0) {

    $json = array(

        "detalle" => "No encontrado"
    );

    echo json_encode($json, true);
    return;
} else {

    /* ------ ------ ------ ------ */
    /* INSTANCIAS DE LAS CLASES */
    /* ------ ------ ------ ------ */

    $usuario = new ControladorUsuarios();
    $tareas = new ControladorTareas();

    /* ------ ------ ------ ------ */
    /* CONSULTA POR CANTIDAD DE RUTAS */
    /* ------ ------ ------ ------ */

    if (count(array_filter($rutasArray)) == 1) {

        /* ------ ------ ------ ------ */
        /* CONSULTANDO API POR RUTA REGISTRO */
        /* ------ ------ ------ ------ */

        if (array_filter($rutasArray)[1] == 'registro') {

            /* ------ ------ ------ ------ */
            /* REGISTRO USUARIO EN API POR METODO POST */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                    $datos = array(
                        "nombre"    => $_POST["nombre"],
                        "apellido"  => $_POST["apellido"],
                        "correo"    => $_POST["correo"],
                        "password"  => 'Cabrera2020$'                        
                    );
    
                    $usuario->create($datos);
                

                
            }
        }

        /* ------ ------ ------ ------ */
        /* CONSULTANDO API POR RUTA LOGIN */
        /* ------ ------ ------ ------ */

        if (array_filter($rutasArray)[1] == 'login') {

            /* ------ ------ ------ ------ */
            /* OBTENER DATOS FORMULARIO LOGIN POR METODO POST */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

                
                $datos = array(
                    "correo" => $_POST["correo"],
                    "password" => $_POST["password"]
                );
                $usuario->login($datos);
            }
            
            
            
        }

        /* ------ ------ ------ ------ */
        /* CONSULTANDO API POR RUTA USUARIO */
        /* ------ ------ ------ ------ */

        if (array_filter($rutasArray)[1] == 'usuarios') {
            
            /* ------ ------ ------ ------ */
            /* SOLICITANDO INFORMACION DE LOS USUARIOS POR METODO GET */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {

                $usuario->index();
            }

            

        }

        /* ------ ------ ------ ------ */
        /* CONSULTANDO API POR RUTA TAREAS */
        /* ------ ------ ------ ------ */

        if (array_filter($rutasArray)[1] == 'tareas') {

            /* ------ ------ ------ ------ */
            /* SOLICITANDO INFORMACION DE LAS TAREAS POR METODO GET */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {

                $tareas->index();
            }

            /* ------ ------ ------ ------ */
            /* CREAR TAREA POR METODO POST */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                $datos = array(
                    "id_usuario" => $_POST["id_usuario"],
                    "titulo" => $_POST["titulo"],
                    "descripcion" => $_POST["descripcion"]
                );

                $tareas->create($datos);
            }
        }
    } else {

        /* ------ ------ ------ ------ */
        /* CONSULTANDO API RUTA USUARIO POR UN SOLO REGISTRO */
        /* ------ ------ ------ ------ */
        if (array_filter($rutasArray)[1] == 'usuario' && is_numeric(array_filter($rutasArray)[2])) {

            /* ------ ------ ------ ------ */
            /* RUTA GET PARA SOLICITAR UN SOLO REGISTRO */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {

                $usuario->show(array_filter($rutasArray)[2]);
            }

            /* ------ ------ ------ ------ */
            /* RUTA PUT PARA ACTUALIZAR UN SOLO REGISTRO */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "PUT") {

                /* se crea un array vacio*/
                $datos = array();
                /*se reciben los datos del PUT y se Parsean para poner en array creado*/
                parse_str(file_get_contents('php://input'), $datos);
                /* Se envian los datos al controlador*/
                $usuario->update(array_filter($rutasArray)[2], $datos);
            }

            /* ------ ------ ------ ------ */
            /* RUTA DELETE PARA ELIMINAR UN SOLO REGISTRO */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "DELETE") {

                $usuario->delete(array_filter($rutasArray)[2]);
            }
        }

        /* ------ ------ ------ ------ */
        /* CONSULTANDO API RUTA TAREAS POR UN SOLO REGISTRO */
        /* ------ ------ ------ ------ */
        if (array_filter($rutasArray)[1] == 'tareas' && is_numeric(array_filter($rutasArray)[2])) {

            /* ------ ------ ------ ------ */
            /*  */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {

                $tareas->show(array_filter($rutasArray)[2]);
            }

            /* ------ ------ ------ ------ */
            /*  */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "PUT") {

                $tareas->update(array_filter($rutasArray)[2]);
            }

            /* ------ ------ ------ ------ */
            /*  */
            /* ------ ------ ------ ------ */

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "DELETE") {

                $tareas->delete(array_filter($rutasArray)[2]);
            }
        }

    }
}
