//funcion para buscar un registro
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
                    ver_registro();
                } else {
                    alert('El registro no existe, Deseas Añadirlo?.');
                }
            },
            error: function (xhr, status, error) {
                console.log('Error en la solicitud AJAX:', error);
            }
        });
    }

}

//Funcion para nuevo registro
function guardar() {

    $.ajax({
        type: "POST",
        url: "grabar.php",
        data: $("form").serialize(),
        success: function (resp) {
            document.getElementById('formulario').reset();
            alert("Registro Grabado");
        },
        error: function (xhr, status, error) {
            console.error("Error en el envío del formulario:", status, error);
            alert("Hubo un error al guardar los datos.");
        }
    });

}

//funcion para editar un registro
function actualizar_registro() {
    var prefijo = document.getElementById('fcedulaC1').value.trim();
    var tomo = document.getElementById('fcedulaC2').value.trim();
    var asiento = document.getElementById('fcedulaC3').value.trim();

    var id = prefijo + "-" + tomo + "-" + asiento;
    var datos = {
        id: id,
        fcedulaC1: prefijo,
        fcedulaC2: tomo,
        fcedulaC3: asiento,
        inputNamel1: document.getElementById('inputNamel1').value.trim(),
        inputNamel2: document.getElementById('inputNamel2').value.trim(),
        inputLastNamel1: document.getElementById('inputLastNamel1').value.trim(),
        inputLastNamel2: document.getElementById('inputLastNamel2').value.trim(),
        provincia: document.getElementById('provincia').value.trim(),
        distrito: document.getElementById('distrito').value.trim(),
        corregimiento: document.getElementById('corregimiento').value.trim(),
        htrabajadas: document.getElementById('htrabajadas').value.trim(),
        shora: document.getElementById('shora').value.trim(),
        salbruto: document.getElementById('salbruto').value.trim(),
        descuentoSocial: document.getElementById('descuentoSocial').value.trim(),
        descuentoEducativo: document.getElementById('descuentoEducativo').value.trim(),
        descuentoImpRenta: document.getElementById('descuentoImpRenta').value.trim(),
        otros_descuentos1: document.getElementById('otros_descuentos1').value.trim(),
        otros_descuentos2: document.getElementById('otros_descuentos2').value.trim(),
        otros_descuentos3: document.getElementById('otros_descuentos3').value.trim(),
        sueldoNeto: document.getElementById('sueldoNeto').value.trim()
    };

    $.ajax({
        type: "POST",
        url: "update_registro.php",
        data: datos,
        dataType: "json",
        success: function (response) {
            if (response.error) {
                console.log(response.error);
                return;
            }
            alert("Registro actualizado exitosamente");
            console.log("Registro editado con éxito");
        },
        error: function (xhr, status, error) {
            console.log('Error en la solicitud AJAX:', error);
        }
    });
}

//funcion para ver un registro
function ver_registro() {
    var prefijo = document.getElementById('fcedulaC1').value.trim();
    var tomo = document.getElementById('fcedulaC2').value.trim();
    var asiento = document.getElementById('fcedulaC3').value.trim();

    var id = prefijo + "-" + tomo + "-" + asiento;
    
    $.ajax({
        type: "POST",
        url: "Buscar_registros.php",
        data: { id: id },
        dataType: "json",
        success: function (response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            document.getElementById('inputNamel1').value = response.nombre1 || '';
            document.getElementById('inputNamel2').value = response.nombre2 || '';
            document.getElementById('inputLastNamel1').value = response.apellido1 || '';
            document.getElementById('inputLastNamel2').value = response.apellido2 || '';
            document.getElementById('provincia').value = response.provincia || '';

            // Actualizar el select de distrito y seleccionar el distrito correcto
            var distritoSelect = document.getElementById('distrito');
            distritoSelect.innerHTML = "<option value='" + response.distrito + "'>" + response.nombre_distrito + "</option>";
            
            // Actualizar el select de corregimiento y seleccionar el corregimiento correcto
            var corregimientoSelect = document.getElementById('corregimiento');
            corregimientoSelect.innerHTML = "<option value='" + response.corregimiento + "'>" + response.nombre_corregimiento + "</option>";
            
            document.getElementById('htrabajadas').value = response.htrabajadas || '';
            document.getElementById('shora').value = response.shora || '';
            document.getElementById('salbruto').value = response.sbruto || '';
            document.getElementById('descuentoSocial').value = response.ssocial || '';
            document.getElementById('descuentoEducativo').value = response.seducativo || '';
            document.getElementById('descuentoImpRenta').value = response.irenta || '';
            document.getElementById('otros_descuentos1').value = response.descuento1 || '';
            document.getElementById('otros_descuentos2').value = response.descuento2 || '';
            document.getElementById('otros_descuentos3').value = response.descuento3 || '';
            document.getElementById('sueldoNeto').value = response.sneto || '';
        },
        error: function (xhr, status, error) {
            console.log('Error en la solicitud AJAX:', error);
        }
    });
}


//-------------------------------------------
//funcion para verificar los campos obligatorios antes de ser mandados a la base de datos
function verificar_campus_obligatorio() {
    let cedula_C2 = document.getElementById('fcedulaC2').value.trim();
    let cedula_C3 = document.getElementById('fcedulaC3').value.trim();
    let primernombre = document.getElementById('inputNamel1').value.trim();
    let primerapellido = document.getElementById('inputLastNamel1').value.trim();
    let segundoapellido = document.getElementById('inputLastNamel2').value.trim();
    let sueldo_hora = document.getElementById('shora').value.trim();
    let horas_trabajadas = document.getElementById('htrabajadas').value.trim();

    // Verificar si los campos obligatorios están llenos
    if (cedula_C2 === "") {
        alert("Error en la cedula: \nPor favor escriba el tomo de su cedula");
    }else if (cedula_C3 === "") {
        alert("Error en la cedula: \nPor favor escriba el asiento de su cedula");
    }else if (primernombre === "") {
        alert("Por favor, Escriba su primer nombre");
    }else if (primerapellido === "") {
        alert("Por favor, Escriba su primer Apellido");
    }else if (segundoapellido === "") {
        alert("Por favor, Escriba su segundo apellido");
    }else if (sueldo_hora === "") {
        alert("Por favor, Escriba su sueldo por hora");
    }else if (horas_trabajadas === "") {
        alert("Por favor, Escriba la cantidad de horas laboradas");
    }else{
        guardar();
    }
}


function verificar_campus_obligatorio_Actualizar() {
    let primernombre = document.getElementById('inputNamel1').value.trim();
    let primerapellido = document.getElementById('inputLastNamel1').value.trim();
    let segundoapellido = document.getElementById('inputLastNamel2').value.trim();
    let sueldo_hora = document.getElementById('shora').value.trim();
    let horas_trabajadas = document.getElementById('htrabajadas').value.trim();

    // Verificar si los campos obligatorios están llenos
    if(primernombre === "") {
        alert("Por favor, Escriba su primer nombre");
    }else if (primerapellido === "") {
        alert("Por favor, Escriba su primer Apellido");
    }else if (segundoapellido === "") {
        alert("Por favor, Escriba su segundo apellido");
    }else if (sueldo_hora === "") {
        alert("Por favor, Escriba su sueldo por hora");
    }else if (horas_trabajadas === "") {
        alert("Por favor, Escriba la cantidad de horas laboradas");
    }else{
        actualizar_registro();
    }
}
//------------------------------------------

/*FUNCION PARA GUARDAR EN LA BASE DE DATOS*/
function guardar() {
    $.ajax({
        type: "POST",
        url: "guardar.php",
        data: $("form").serialize(),
        success: function(resp) {
            console.log("Datos enviados:", $("form").serialize());
            document.getElementById('formulario').reset();
            alert("Registro Guardado");
        },
        error: function(xhr, status, error) {
            console.error("Error en el AJAX:", status, error);
        }
    });
}

//FUNCION PARA EDITAR REGISTRO (HABILITAR CAMPOS)
// Función para cambiar el estado de readonly y disabled para inputs y selects
function habilitar_campus() {
    const inputs = document.querySelectorAll('.editable-input');
    const selects = document.querySelectorAll('.editable-select');
    const buttons_update = document.querySelectorAll('.btn-update');
    const buttons_cancel = document.querySelectorAll('.btn-cancel');

    inputs.forEach(input => {
        input.removeAttribute('readonly'); // Permite editar
        input.removeAttribute('disabled'); // Habilita el campo
    });

    selects.forEach(select => {
        select.removeAttribute('disabled'); // Habilita el select
    });

    buttons_update.forEach(button => {
        button.classList.remove('disabled'); // Habilita el botón
        button.removeAttribute('hidden');    // Hace visible el botón eliminando el atributo hidden
    });

    // Ocultar los botones de editar y eliminar
    buttons_cancel.forEach(button => {
        button.setAttribute('hidden', 'true'); // Oculta los botones de editar y eliminar
    });

    alert("Campos habilitados para edición."); // Opcional: alerta de confirmación
}
//FUNCON PARA REVERTIR LOS CAMPUS HABILITADOS
function Deshabilitar_campus() {
    const inputs = document.querySelectorAll('.editable-input');
    const selects = document.querySelectorAll('.editable-select');
    const buttons_update = document.querySelectorAll('.btn-update');
    const buttons_cancel = document.querySelectorAll('.btn-cancel');

    inputs.forEach(input => {
        input.setAttribute('readonly', 'true'); // Deshabilita la edición
        input.setAttribute('disabled', 'true'); // Deshabilita el campo
    });

    selects.forEach(select => {
        select.setAttribute('disabled', 'true'); // Deshabilita el select
    });

    buttons_update.forEach(button => {
        button.classList.add('disabled'); // Deshabilita el botón
        button.setAttribute('hidden', 'true'); // Oculta el botón
    });

    // Mostrar los botones de editar y eliminar
    buttons_cancel.forEach(button => {
        button.removeAttribute('hidden'); // Muestra los botones de editar y eliminar
    });
}

//FUNCION PARA CANCELAR ACTUALIZACION
function cancelar_actualizacion() {
    revisar_si_existe();
    Deshabilitar_campus();
}

// Función para eliminar un registro
function delete_registro() {
    var prefijo = document.getElementById('fcedulaC1').value.trim();
    var tomo = document.getElementById('fcedulaC2').value.trim();
    var asiento = document.getElementById('fcedulaC3').value.trim();

    var id = prefijo + "-" + tomo + "-" + asiento;  // Construcción de la cédula

    if (confirm("¿Está seguro que desea eliminar el registro con ID: " + id + "?")) {
        $.ajax({
            type: "POST",
            url: "delete_registro.php",  // Enviar la solicitud a eliminar_registro.php
            data: {
                prefijo: prefijo,
                tomo: tomo,
                asiento: asiento
            },
            success: function (response) {
                alert("Registro eliminado con éxito.");
                location.reload();  // Recargar la página para reflejar los cambios
            },
            error: function (xhr, status, error) {
                console.error("Error en el envío del formulario:", xhr.responseText);
                alert("Hubo un error al eliminar el registro con ID: " + id + "\nStatus: " + status + "\nError: " + error);
            }
        });
    }
}


