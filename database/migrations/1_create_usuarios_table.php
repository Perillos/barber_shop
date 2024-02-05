<?php

// $db = mysqli_connect($host, $user, $pass, $name_db);
$sql_drop = "DROP TABLE IF EXISTS usuarios";

if (mysqli_query($db, $sql_drop) === FALSE) {
    die('Invalid query: 11' . mysqli_error($db));
}


$sql = "
CREATE TABLE usuarios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60),
    apellido VARCHAR(60),
    telefono VARCHAR(60),
    admin TINYINT(1),
    confirmado TINYINT(1),
    token VARCHAR(60),
    PRIMARY KEY (id)
);
";

if (mysqli_query($db, $sql) === FALSE) {
    die('Invalid query: 12' . mysqli_error($db));
}

echo "Usuarios table created";
echo "<br>";
