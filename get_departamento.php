<?php
require_once("coneccion.php");

// Obtenemos el ID del departamento de la petición POST
$departamento_id = $_POST["departamento_id"];

$sql = "SELECT * FROM departamentos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $departamento_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo json_encode($row);
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
