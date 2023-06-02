<?php
require_once("coneccion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departamento_nombre = $_POST["tags"];
    $id_empleado = $_POST["empl_id"];

    $sql = "SELECT id FROM departamentos WHERE nombre = ?";

    if ($stmt = $conn->prepare($sql)) {

        $param_nombre = $departamento_nombre;

        $stmt->bind_param("s", $param_nombre);

        if ($stmt->execute()) {

            $stmt->store_result();

            // se encontró el nombre
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id);
                if ($stmt->fetch()) {
                    
                    // echo "El id del departamento es: " . $id;

                    $sql_update = "UPDATE empleados SET departamento_id=? WHERE id=?";
                    if ($stmt_update = $conn->prepare($sql_update)) {
                        $stmt_update->bind_param("ii", $id, $id_empleado);

                        if ($stmt_update->execute()) {
                            echo "Empleado actualizado correctamente";
                        } else {
                            echo "Error al actualizar el empleado: " . $stmt_update->error;
                        }

                        $stmt_update->close();
                    }
                }
            } else {
                echo "No se encontró el departamento con ese nombre.";
            }
        } else {
            echo "Ocurrió un error. Inténtalo de nuevo.";
        }
    }

    $stmt->close();
    $conn->close();
}
