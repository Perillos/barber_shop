<?php


// $env = parse_ini_file('../../.env');
// $host = $env['DB_HOST'];
// $db = $env['DB'];
// $user = $env['DB_USER'];
// $pass = $env['DB_PASSWORD'];


// $db = mysqli_connect($host, $user, $pass, $db);


// if(!$db) {
//     echo "Error: No se pudo conectar a MySQL.";
//     echo "errno de depuración: " . mysqli_connect_errno();
//     echo "error de depuración: " . mysqli_connect_error();
//     exit;
// }


$sql = "
INSERT INTO servicios 
    (id, nombre, precio) 
VALUES
    (1, 'Corte de Cabello Mujer', 90.00),
    (2, 'Corte de Cabello Hombre', 80.00),
    (3, 'Corte de Cabello Niño', 60.00),
    (4, 'Peinado Mujer', 80.00),
    (5, 'Peinado Hombre', 60.00),
    (6, 'Peinado Niño', 60.00),
    (7, 'Corte de Barba', 60.00),
    (8, 'Tinte Mujer', 300.00),
    (9, 'Uñas', 400.00),
    (10, 'Lavado de Cabello', 50.00),
    (11, 'Tratamiento Capilar', 150.00);
";
if (mysqli_query($db, $sql) === FALSE) {
    die('Invalid query: ' . mysqli_error($db));
}

echo "<br>";
echo "Citas ejemplo creadas";
echo "<br>";
