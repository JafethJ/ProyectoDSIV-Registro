<?php

$host="localhost";
$user="d42024";
$pass="1234";
$BD="planilla";
$conexion = mysqli_connect($host, $user, $pass, $BD);

/*se obtienen los datos a guardar*/
$prefijo = $_POST['fcedulaC1'];
if ($prefijo == "") {
    $prefijo = "08";
}
$tomo = $_POST['fcedulaC2'];
$asiento = $_POST['fcedulaC3'];

//Unimos la cedula
$cedula = $prefijo . "-" . $tomo . "-" . $asiento;

$Pname=$_POST['inputNamel1'];
$Sname=$_POST['inputNamel2'];
$Papell=$_POST['inputLastNamel1'];
$Sapell=$_POST['inputLastNamel2'];

$provincia = $_POST['provincia'];
$distrito = $_POST['distrito'];
$corregimiento = $_POST['corregimiento'];

$htrabajadas = $_POST['htrabajadas'];
$sueldohora = $_POST['shora'];

$salariobruto = floatval($_POST['salbruto']);
$descsegSocial = floatval($_POST['descuentoSocial']);
$descEducativo = floatval($_POST['descuentoEducativo']);
$descImpRenta = floatval($_POST['descuentoImpRenta']);

$desc1 = floatval($_POST['otros_descuentos1']);
$desc2 = floatval($_POST['otros_descuentos2']);
$desc3 = floatval($_POST['otros_descuentos3']);

$sneto = floatval($_POST['sueldoNeto']);

/*se hace el envio a la base de */
$enviar = mysqli_query($conexion, "INSERT INTO planilla 
    (prefijo, tomo, asiento, cedula, nombre1, nombre2, apellido1, apellido2, provincia, distrito, corregimiento, htrabajadas, shora, sbruto, ssocial, seducativo, irenta, descuento1, descuento2, descuento3, sneto) 
    VALUES 
    ('$prefijo', '$tomo', '$asiento', '$cedula', '$Pname', '$Sname', '$Papell', '$Sapell', '$provincia', '$distrito', '$corregimiento', '$htrabajadas', '$sueldohora',  '$salariobruto', '$descsegSocial', '$descEducativo', '$descImpRenta', '$desc1', '$desc2', '$desc3', '$sneto')");

// Cerrar conexión
mysqli_close($conexion);
?>