<?php

$host="localhost";
$user="d42024";
$pass="1234";
$BD="planilla";
$conexion = mysqli_connect($host, $user, $pass, $BD);

$corr  = $_POST['corr'];
?>

<label class="textColor" class="form-label" >Corregimiento: </label>
<select class="form-select" id="corregimiento" name="corregimiento">
    <?php
        $busca_corregimiento = mysqli_query($conexion, "SELECT * FROM corregimiento WHERE codigo_distrito = '$corr'");
        while ($corregimiento_encontrada=mysqli_fetch_assoc($busca_corregimiento)){
            echo "<option value='".$corregimiento_encontrada['codigo_corregimiento']."'>".$corregimiento_encontrada['nombre_corregimiento']."</option>";
        }
    ?>
</select>