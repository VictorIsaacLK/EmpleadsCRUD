<?php
require_once("coneccion.php");

$sql = "SELECT * FROM empleados";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 resultados";
}

//conversion de los objetos a un json
echo json_encode($data);

$conn->close();
?>