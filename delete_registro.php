<?php
$host = "localhost";
$user = "d42024"; 
$pass = "1234";
$db = "planilla";
$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener los valores de los inputs del formulario
$prefijo = $_POST['prefijo'];
if ($prefijo == "") {
    $prefijo = "8";
}
$tomo = $_POST['tomo'];
$asiento = $_POST['asiento'];

// Construir la cédula
$cedula = $prefijo . "-" . $tomo . "-" . $asiento;

// Verificar si la cédula no está vacía
if (!empty($cedula)) {
    // Preparar la consulta para eliminar el registro donde la cédula sea igual a $cedula
    $eliminar = mysqli_query($conexion, "DELETE FROM planilla WHERE cedula = '$cedula'");

    // Verificar si la eliminación fue exitosa
    if ($eliminar) {
        echo "Registro eliminado con éxito.";
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    echo "Cédula no válida.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
