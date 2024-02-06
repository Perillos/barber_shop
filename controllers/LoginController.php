<?php

namespace Controllers;

use Models\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $router->render('auth/login');
    }

    public static function logout()
    {
        echo "LoginController logout";
    }

    public static function olvide(Router $router)
    {
        $router->render('auth/olvide-password', []);
    }

    public static function recuperar()
    {
        echo "LoginController recuperar";
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario;

        $alerta = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alerta = $usuario->validarNuevaCuenta();
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alerta' => $alerta
        ]);
    }
}
