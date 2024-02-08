<?php


$env = parse_ini_file('../.env');
$email_host = $env['EMAIL_HOST'];
$email_port = $env['EMAIL_PORT'];
$email_user = $env['EMAIL_USERNAME'];
$email_pass = $env['EMAIL_PASSWORD'];