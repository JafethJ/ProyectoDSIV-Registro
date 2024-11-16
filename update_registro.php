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
$prefijo = $_POST['fcedulaC1'];
if ($prefijo == "") {
    $prefijo = "08";
}
$tomo = $_POST['fcedulaC2'];
$asiento = $_POST['fcedulaC3'];
$cedula = $prefijo . "-" . $tomo . "-" . $asiento;
$nombre1 = $_POST['inputNamel1'];
$nombre2 = $_POST['inputNamel2'];
$apellido1 = $_POST['inputLastNamel1'];
$apellido2 = $_POST['inputLastNamel2'];
$provincia = $_POST['provincia'];
$distrito = $_POST['distrito'];
$corregimiento = $_POST['corregimiento'];
$htrabajadas = $_POST['htrabajadas'];
$shora = $_POST['shora'];
$sbruto = $_POST['salbruto'];
$ssocial = $_POST['descuentoSocial'];
$seducativo = $_POST['descuentoEducativo'];
$irenta = $_POST['descuentoImpRenta'];
$descuento1 = $_POST['otros_descuentos1'];
$descuento2 = $_POST['otros_descuentos2'];
$descuento3 = $_POST['otros_descuentos3'];
$sneto = $_POST['sueldoNeto'];

// Actualizar los valores en la base de datos donde la cédula sea igual a $cedula
$actualizar = mysqli_query($conexion, "UPDATE planilla SET 
    prefijo = '$prefijo',
    tomo = '$tomo',
    asiento = '$asiento',
    nombre1 = '$nombre1',
    nombre2 = '$nombre2',
    apellido1 = '$apellido1',
    apellido2 = '$apellido2',
    provincia = '$provincia',
    distrito = '$distrito',
    corregimiento = '$corregimiento',
    htrabajadas = '$htrabajadas',
    shora = '$shora',
    sbruto = '$sbruto',
    ssocial = '$ssocial',
    seducativo = '$seducativo',
    irenta = '$irenta',
    descuento1 = '$descuento1',
    descuento2 = '$descuento2',
    descuento3 = '$descuento3',
    sneto = '$sneto'
    WHERE cedula = '$cedula'");

// Verificar si la actualización fue exitosa
if ($actualizar) {
    echo "Registro actualizado con éxito.";
} else {
    echo "Error al actualizar el registro: " . mysqli_error($conexion);
}

// Cerrar conexión
mysqli_close($conexion);
?>
