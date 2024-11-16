<?php
session_start();

if (isset($_POST['fcedulaC1']) && isset($_POST['fcedulaC2']) && isset($_POST['fcedulaC3'])) {
    $_SESSION['cedula'] = $_POST['fcedulaC1'] . '-' . $_POST['fcedulaC2'] . '-' . $_POST['fcedulaC3'];
    echo "Cédula almacenada correctamente";
} else {
    echo "Error al almacenar la cédula";
}
?>
