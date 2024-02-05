<?php



$sql_drop = "DROP TABLE IF EXISTS servicios";

$result = mysqli_query($db, $sql_drop);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
}


$sql = "
CREATE TABLE servicios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60),
    precio DECIMAL(5,2),
    PRIMARY KEY (id)
);
";
$result = mysqli_query($db, $sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
}
echo "Servicios table created";
echo "<br>";
