<?php



$sql_drop = "DROP TABLE IF EXISTS usuarios";

$result = mysqli_query($db, $sql_drop);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
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
$result = mysqli_query($db, $sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
}
echo "Usuarios table created";
echo "<br>";
