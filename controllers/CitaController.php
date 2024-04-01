<?php

namespace Controllers;

use MVC\Router;

class CitaController
{
    public static function index(Router $router)
    {

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre_completo'],
            // TODO: Cambiar id como input hidden en el formulario
            'id' => $_SESSION['id']
        ]);
    }
}
