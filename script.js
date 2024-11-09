$(document).ready(function() {
    $("#userForm").submit(function(e) {
        e.preventDefault(); 

        let firstName = $("#first_name").val();
        let lastName = $("#last_name").val();
        let age = $("#age").val();
        let curp = $("#curp").val();

        // Validación de edad
        if (age < 1 || age > 120) {
            alert("Por favor, ingresa una edad válida entre 1 y 120.");
            return;
        }

        // Validación de CURP: solo letras y números
        let curpPattern = /^[A-Z0-9]+$/;  // Solo letras mayúsculas y números
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
