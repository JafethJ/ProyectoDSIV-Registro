function mostrar_btn_ver() {
    document.getElementById('boton_buscar').setAttribute('hidden', 'true'); // Oculta botón Buscar
    document.getElementById('boton_agregar').setAttribute('hidden', 'true'); // Oculta botón Agregar
    document.getElementById('boton_ver').removeAttribute('hidden'); // Muestra botón Ver
}

function mostrar_btn_agregar() {
    document.getElementById('boton_buscar').setAttribute('hidden', 'true'); // Oculta botón Buscar
    document.getElementById('boton_ver').setAttribute('hidden', 'true'); // Oculta botón Ver
    document.getElementById('boton_agregar').removeAttribute('hidden'); // Muestra botón Agregar
}

function recargar_pagina() {
    location.reload(); // Recarga la página
}


//REVISAR SI EXISTE LA CEDULA
function revisar_si_existe() {
    var prefijo = document.getElementById('fcedulaC1').value.trim();
    var tomo = document.getElementById('fcedulaC2').value.trim();
    var asiento = document.getElementById('fcedulaC3').value.trim();

    if (prefijo === '' || tomo === '' || asiento === '') {
    } else {
        var cedula = prefijo + "-" + tomo + "-" + asiento;

        $.ajax({
            type: "POST",
            url: "existe_registro.php",
            data: { cedula: cedula },
            dataType: 'json', // Recibimos la respuesta como JSON
            success: function (response) {
                if (response.exists) {
                    alert('El registro existe');
                    mostrar_btn_ver();
                } else {
                    alert('El registro no existe');
                    mostrar_btn_agregar();
                }
            },
            error: function (xhr, status, error) {
                console.log('Error en la solicitud AJAX:', error);
            }
        });
    }

}

//ABRIR ARCHIVO DE VER REGISTRO
function abrirVerRegistro() {
    // Obtener los valores de los campos de la cédula
    var prefijo = document.getElementById('fcedulaC1').value;
    var tomo = document.getElementById('fcedulaC2').value;
    var asiento = document.getElementById('fcedulaC3').value;

    // Concatenar los valores de la cédula en el formato deseado
    var cedula = prefijo + "-" + tomo + "-" + asiento;

    // Redirigir a ver_registro.php pasando los valores como parámetros
    window.location.href = "ver_registro.php?cedula=" + encodeURIComponent(cedula) +
        "&prefijo=" + encodeURIComponent(prefijo) +
        "&tomo=" + encodeURIComponent(tomo) +
        "&asiento=" + encodeURIComponent(asiento);
}

//ABRIR ARCHIVO DE AGREGAR REGISTRO
function abrirAgregarRegistro() {
    // Obtener los valores de los campos de la cédula
    var prefijo = document.getElementById('fcedulaC1').value;
    var tomo = document.getElementById('fcedulaC2').value;
    var asiento = document.getElementById('fcedulaC3').value;

    // Concatenar los valores de la cédula en el formato deseado
    var cedula = prefijo + "-" + tomo + "-" + asiento;

    // Redirigir a ver_registro.php pasando los valores como parámetros
    window.location.href = "New_registro.php?cedula=" + encodeURIComponent(cedula) +
        "&prefijo=" + encodeURIComponent(prefijo) +
        "&tomo=" + encodeURIComponent(tomo) +
        "&asiento=" + encodeURIComponent(asiento);

}