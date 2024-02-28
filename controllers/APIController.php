<?php

namespace Controllers;

use Models\Servicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar()
    {
        $respuesta = [
            'mensaje' => 'Todo Ok'
        ];
    }
}
