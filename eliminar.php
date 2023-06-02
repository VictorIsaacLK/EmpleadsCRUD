<?php
require_once("coneccion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empleado_id = $_POST["elim_id"];

    $sql_eliminado = "SELECT * FROM empleados WHERE id = $empleado_id AND status = false";
    $sql_activo = "SELECT * FROM empleados WHERE id = $empleado_id AND status = true";

    $resul_eliminado = $conn->query($sql_eliminado);
    $resul_activo = $conn->query($sql_activo);

    if ($resul_activo->num_rows > 0) {
        // Eliminar el empleado de la tabla
        $sql = "UPDATE empleados SET status=false WHERE id=$empleado_id";

        if ($conn->query($sql) === TRUE) {
            echo "Empleado eliminado correctamente";
        } else {
            echo "Error al eliminar el empleado: " . $conn->error;
        }
    } elseif ($resul_eliminado->num_rows > 0) {
        // Activar el empleado de la tabla
        $sql = "UPDATE empleados SET status=true WHERE id=$empleado_id";

        if ($conn->query($sql) === TRUE) {
            echo "Empleado activado correctamente";
        } else {
            echo "Error al activar el empleado: " . $conn->error;
        }
    } else {
        echo "No se encontró el empleado con ese ID.";
    }
}
?>
