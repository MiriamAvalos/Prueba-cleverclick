$(document).ready(function() {
    $("#userForm").submit(function(e) {
        e.preventDefault();

        let firstName = $("#first_name").val();
        let lastName = $("#last_name").val();
        let age = $("#age").val();
        let curp = $("#curp").val();

        if (age < 1 || age > 120) {
            alert("Por favor, ingresa una edad válida entre 1 y 120.");
            return;
        }

        
        let curpPattern = /^[A-Z0-9]+$/;
        if (!curpPattern.test(curp)) {
            alert("El CURP solo puede contener letras y números.");
            return;
        }

        $.ajax({
            url: 'http://localhost/cleverclick/guardar_usuario.php',
            type: 'POST',
            data: {
                first_name: firstName,
                last_name: lastName,
                age: age,
                curp: curp
            },
            success: function(response) {
                alert("Usuario guardado exitosamente.");
                obtenerUsuarios();
                       // Limpiar los campos del formulario
                       $("#first_name").val('');
                       $("#last_name").val('');
                       $("#age").val('');
                       $("#curp").val('');
            },
            error: function(xhr, status, error) {
                console.log("Error status:", status);
                console.log("Error message:", error);
                console.log("Response text:", xhr.responseText);
                alert("Ocurrió un error al guardar el usuario.");
            }
        });
       
    });

    // Función para obtener y mostrar los usuarios
    function obtenerUsuarios() {
        fetch('http://localhost/cleverclick/obtener_usuarios.php')
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
                        </tr>
                    `;
                });
                
                document.getElementById('usuarios').innerHTML = usuariosHTML;
            })
            .catch(error => console.error('Error al obtener los usuarios:', error));
    }

    // Llama a la función obtenerUsuarios al cargar la página
    obtenerUsuarios();

});
