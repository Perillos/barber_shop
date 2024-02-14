<?php

namespace Models;

class Usuario extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de una cuenta

    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del cliente es obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido del cliente es obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El telefono del cliente es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email del cliente es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password del cliente es obligatorio';
        }
        // TODO: Hay una función que valida el password, utilizarla
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe ser de al menos 6 caracteres';
        }
        return self::$alertas;
    }


    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El E-Mail es obligatorio.';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es obligatorio.';
        }

        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El E-Mail es obligatorio.';
        }
        return self::$alertas;
    }

    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password)) {
            self::$alertas['error'][] = 'El password debe ser de al menos 6 caracteres';
        }
    }

    // Revisa si el usuario ya existe
    public function existeUsuario()
    {
        $query = "
            SELECT * 
            FROM " . self::$tabla . "
            WHERE email = '" . $this->email . "'
            LIMIT 1
        ";

        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya existe';
        }

        return $resultado;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }

    public function comprobarVerificado()
    {
        if (!$this->confirmado) {
            self::$alertas['error'][] = 'Tu cuenta no ha sido confirmada';
            return false;
        } else {
            return true;
        }
    }

    public function comprobarPassword($password)
    {
        $resultado = password_verify($password, $this->password);
        if ($resultado) {
            return true;
        } else {
            self::$alertas['error'][] = 'El usuario y contraseña no coinciden';
            return false;
        }
    }
}
