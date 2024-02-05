<?php


$env = parse_ini_file('../../.env');
$host = $env['DB_HOST'];
$name_db = $env['DB'];
$user = $env['DB_USER'];
$pass = $env['DB_PASSWORD'];


$db = mysqli_connect($host, $user, $pass);


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}

// Formatear la base de datos
$sql = "DROP DATABASE IF EXISTS " . $name_db;
if (mysqli_query($db, $sql) === TRUE) {
    echo "Database dropped successfully";
    echo "<br>";
} else {
    echo "Error dropping database: " . $db->error;
}

// Crear la base de datos
$sql = "CREATE DATABASE " . $name_db;
if (mysqli_query($db, $sql) === TRUE) {
    echo "Database created successfully";
    echo "<br>";
} else {
    echo "Error creating database: " . $db->error;
}
$db = mysqli_connect($host, $user, $pass, $name_db);

require_once __DIR__ . '/1_create_usuarios_table.php';
require_once __DIR__ . '/2_create_servicios_table.php';
require_once __DIR__ . '/3_create_citas_table.php';
require_once __DIR__ . '/4_create_citasservicios_table.php';
require_once __DIR__ . '/../seeds/citas.php';
