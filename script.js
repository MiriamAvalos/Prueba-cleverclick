$(document).ready(function() {
    $("#userForm").submit(function(e) {
        e.preventDefault();

        let firstName = $("#first_name").val();
        let lastName = $("#last_name").val();
        let age = $("#age").val();
        let curp = $("#curp").val();
        let userId = $("#user_id").val();  // Este campo tendrá el ID del usuario que estamos editando

        // Validaciones
        if (age < 1 || age > 120) {
            alert("Por favor, ingresa una edad válida entre 1 y 120.");
            return;
        }

        let curpPattern = /^[A-Z0-9]+$/;
        if (!curpPattern.test(curp)) {
            alert("El CURP solo puede contener letras y números.");
            return;
        }

        // Determinar si es para guardar o editar
        let url = userId ? 'https://sql107.infinityfree.com/editar_usuarios.php' : 'https://sql107.infinityfree.com/guardar_usuario.php';

        $.ajax({
            url: url,  // Cambiar la URL dependiendo si es edición o creación
            type: 'POST',
            data: {
                user_id: userId,  // Enviar el ID si estamos editando
                first_name: firstName,
                last_name: lastName,
                age: age,
                curp: curp
            },
            success: function(response) {
                alert("Usuario guardado exitosamente.");
                obtenerUsuarios();  // Actualizar la lista de usuarios
                // Limpiar los campos del formulario
                $("#first_name").val('');
                $("#last_name").val('');
                $("#age").val('');
                $("#curp").val('');
                $("#user_id").val('');  // Limpiar el campo oculto user_id
            },
            error: function(xhr, status, error) {
                console.log("Error status:", status);
                console.log("Error message:", error);
                console.log("Response text:", xhr.responseText);
                alert("Ocurrió un error al guardar el usuario.");
            }
        });
    });
});

// Función para obtener y mostrar los usuarios
function obtenerUsuarios() {
    fetch('https://sql107.infinityfree.com/obtener_usuarios.php')
        .then(response => response.json())
        .then(data => {
            console.log("Datos recibidos:", data);

            let usuariosHTML = '';
            data.forEach(usuario => {
                usuariosHTML += `
                    <tr>
                        <td>${usuario.id}</td>
                        <td>${usuario.first_name}</td>
                        <td>${usuario.last_name}</td>
                        <td>${usuario.age}</td>
                        <td>${usuario.curp}</td>
                        <td><button onclick="editarUsuario(${usuario.id})">Editar</button></td>
                        <td><button onclick="eliminarUsuario(${usuario.id})">Eliminar</button></td>
                    </tr>
                `;
            });

            document.getElementById('usuarios').innerHTML = usuariosHTML;
        })
        .catch(error => console.error('Error al obtener los usuarios:', error));
}

obtenerUsuarios();

// Función para editar un usuario
function editarUsuario(userId) {
    $.ajax({
        url: 'https://sql107.infinityfree.com/obtener_usuario.php',
        type: 'GET',
        data: { id: userId },
        success: function(response) {
            let usuario = JSON.parse(response);

            console.log("Tipo de usuario:", typeof usuario);

            $("#first_name").val(usuario.first_name);
            $("#last_name").val(usuario.last_name);
            $("#age").val(usuario.age);
            $("#curp").val(usuario.curp);
            $("#user_id").val(usuario.id);
        },
        error: function(xhr, status, error) {
            console.log("Error al obtener usuario:", error);
            alert("Ocurrió un error al obtener los datos del usuario.");
        }
    });
}

// Función para eliminar un usuario
function eliminarUsuario(userId) {
    if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
        console.log("Intentando eliminar usuario con ID:", userId);
        $.ajax({
            url: 'https://sql107.infinityfree.com/eliminar_usuario.php',
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                console.log("Respuesta del servidor para eliminación:", response);
                obtenerUsuarios();
            },
            error: function(xhr, status, error) {
                console.log("Error status:", status);
                console.log("Error message:", error);
                console.log("Response text:", xhr.responseText);
                alert("Ocurrió un error al eliminar el usuario.");
            }
        });
    }
}
