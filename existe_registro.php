<?php
$host ="localhost";
$user ="d42024"; 
$pass ="1234";
$db   ="planilla";
$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$cedula = $_POST['cedula'];

// Verificar si el registro ya existe en la base de datos
$query = "SELECT * FROM planilla WHERE cedula = '$cedula'";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) > 0) {
    // Si el registro ya existe
    echo json_encode(['exists' => true]);
} else {
    // Si no existe el registro
    echo json_encode(['exists' => false]);
}

mysqli_close($conexion);
?>
