<?php


$env = parse_ini_file('../.env');
$host = $env['DB_HOST'];
$db = $env['DB'];
$user = $env['DB_USER'];
$pass = $env['DB_PASSWORD'];


$db = mysqli_connect($host, $user, $pass, $db);


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
