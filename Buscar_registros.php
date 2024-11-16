<?php
$host = "localhost";
$user = "d42024";
$pass = "1234";
$db = "planilla";

// Crear conexión
$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificar conexión
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obtener el ID de la solicitud POST
$id = $_POST['id'];

// Consultar datos del registro en la tabla planilla
$query = "SELECT * FROM planilla WHERE cedula = '$id'";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // Obtener los códigos de distrito y corregimiento
    $codigo_distrito = $data['distrito'];
    $codigo_corregimiento = $data['corregimiento'];

    // Consultar el nombre del distrito
    $query_distrito = "SELECT nombre_distrito FROM distrito WHERE codigo_distrito = '$codigo_distrito'";
    $result_distrito = mysqli_query($conexion, $query_distrito);
    $nombre_distrito = mysqli_fetch_assoc($result_distrito)['nombre_distrito'];

    // Consultar el nombre del corregimiento
    $query_corregimiento = "SELECT nombre_corregimiento FROM corregimiento WHERE codigo_corregimiento = '$codigo_corregimiento'";
    $result_corregimiento = mysqli_query($conexion, $query_corregimiento);
    $nombre_corregimiento = mysqli_fetch_assoc($result_corregimiento)['nombre_corregimiento'];

    // Añadir los nombres de distrito y corregimiento a los datos
    $data['nombre_distrito'] = $nombre_distrito;
    $data['nombre_corregimiento'] = $nombre_corregimiento;

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No se encontraron datos']);
}

// Cerrar conexión
mysqli_close($conexion);
?>
