<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        require './../includes/email_credential.php';
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $email_host;
        $mail->SMTPAuth = true;
        $mail->Port = $email_port;
        $mail->Username = $email_user;
        $mail->Password = $email_pass;

        $mail->setFrom('gesiofernando@gmail.com');
        $mail->addAddress('gesiofernando@gmail.com', 'fernando.com');
        $mail->Subject = 'Confirmar cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<htm>";
        $contenido .= "<p>hola</p>";

        $mail->Body = $contenido;


        // Enviar emal
        $mail->send();
    }
}