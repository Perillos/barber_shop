<?php

namespace Controllers;

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

    public static function olvide()
    {
        echo "LoginController olvide";
    }

    public static function recuperar()
    {
        echo "LoginController recuperar";
    }

    public static function crear(Router $router)
    {
        $router->render('auth/crear-cuenta', []);
    }
}