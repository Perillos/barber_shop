<?php



$sql_drop = "DROP TABLE IF EXISTS citas";

$result = mysqli_query($db, $sql_drop);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
}


$sql = "
CREATE TABLE citas (
    id INT(11) NOT NULL AUTO_INCREMENT,
    fecha TIME NOT NULL,
    usuariold INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuariold) REFERENCES usuarios(id)
);
";
$result = mysqli_query($db, $sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($db));
}
echo "Citas table created";
echo "<br>";
