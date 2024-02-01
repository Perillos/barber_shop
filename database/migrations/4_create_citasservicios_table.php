<?php



$sql_drop = "DROP TABLE IF EXISTS citasservicios";

$result = mysqli_query($db, $sql_drop);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
}


$sql = "
CREATE TABLE citasservicios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    citald INT(11) NOT NULL,
    serviciold INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (citald) REFERENCES citas(id),
    FOREIGN KEY (serviciold) REFERENCES servicios(id)
);

";
$result = mysqli_query($db, $sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
}
echo "Citasservicios table created";
echo "<br>";
