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

    public function enviarEmail($email, $nombre, $token)
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = '';
        $phpmailer->SMTPAuth = '';
        $phpmailer->Port = '';
        $phpmailer->Username = '';
        $phpmailer->Password = '';
    }
}
