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
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p><a href='http://" . $_SERVER['HTTP_HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puede ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar emal
        $mail->send();
    }

    public function enviarInstrucciones()
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
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<htm>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p><a href='http://" . $_SERVER['HTTP_HOST'] . "/recuperar?token=" . $this->token . "'>Reestablecer password</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puede ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar emal
        $mail->send();
    }
}
