<?php
require_once("coneccion.php");

function limpiarValidarDato($dato)
{
    // trim borra espacios al principio y final
    $dato = trim($dato);
    // caracteres especiales
    $dato = htmlspecialchars($dato);
    return $dato;
}

$apellido_materno = limpiarValidarDato($_POST["apellido_materno"] ?? "");
$apellido_paterno = limpiarValidarDato($_POST["apellido_paterno"] ?? "");
$nombre = limpiarValidarDato($_POST["nombre"] ?? "");
$edad = limpiarValidarDato($_POST["edad"] ?? "");
$sexo = limpiarValidarDato($_POST["sexo"] ?? "");
$direccion = limpiarValidarDato($_POST["direccion"] ?? "");
$salario = limpiarValidarDato($_POST["salario"] ?? "");

// campos vacíos
if (!empty($apellido_materno) && !empty($apellido_paterno) && !empty($nombre) && !empty($edad) && !empty($sexo) && !empty($direccion) && !empty($salario)) {
    // formato y longitud
    if (preg_match("/^[a-zA-Z\s]{1,20}$/", $apellido_materno) && preg_match("/^[a-zA-Z\s]{1,20}$/", $apellido_paterno) && preg_match("/^[a-zA-Z\s]{1,30}$/", $nombre) && is_numeric($edad) && is_numeric($salario) && preg_match("/^\d+(\.\d{1,2})?$/", $salario)) {

        $sql = "INSERT INTO empleados (apellido_materno, apellido_paterno, nombre, edad, sexo, direccion, salario) VALUES ('$apellido_materno', '$apellido_paterno', '$nombre', $edad, '$sexo', '$direccion', '$salario')";

        if ($conn->query($sql) === TRUE) {
            echo "Empleado ingresado correctamente";
            $apellido_materno = "";
            $apellido_paterno = "";
            $nombre = "";
            $edad = "";
            $sexo = "";
            $direccion = "";
            $salario = "";
        } else {
            echo $conn->error;
        }
    } else {
        echo "Formato incorrecto";
    }
} else {
    echo "Todos los campos son requeridos.";
}

$conn->close();
