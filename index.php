<?php

require_once 'controller/rutas.controlador.php';
require_once 'controller/usuarios.controlador.php';
require_once 'controller/tareas.controlador.php';

require_once 'model/tareas.modelo.php';
require_once 'model/usuarios.modelo.php';


$rutas = new ControladorRutas();
$rutas -> index();