<?php

namespace Classes;

class Email
{
    public $email;
    public $nombre;
    public  $token;
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
    }
}
