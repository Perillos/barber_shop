<?php

namespace Controllers;

use Models\Cita;
use Models\CitaServicio;
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
      // Almacenar la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena la Cita y el Servicio
        $idServicios = explode(',', $_POST['servicios']);

        // Almacena los servicios con ID de la cita
        foreach ($idServicios as $idServicio) {
            $arg = [
                'citaId' => $id,
                'servicioId' => $idServicio,
            ];
            $citaServicio = new CitaServicio($arg);
            $citaServicio->guardar();
        }

        // Retorna una respuesta
        $respuesta = [
          'resultado' => $resultado,
        ];
        echo json_encode($respuesta);
    }
}
