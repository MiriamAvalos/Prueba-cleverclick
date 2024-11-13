<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Asegúrate de incluir Font Awesome solo una vez -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="contenedor">
        <section class="formulario">
            <h1>Registrar Usuario</h1>
            <form id="userForm" method="POST" action="guardar_usuario.php" class="formulario">
                <input type="text" id="first_name" name="first_name" placeholder="Nombre" class="inputFormRegister" required>
                <br>
                <input type="text" id="last_name" name="last_name" placeholder="Apellido" class="inputFormRegister" required>
                <br>
                <input type="number" id="age" name="age" placeholder="Edad" class="inputFormRegister" required>
                <br>
                <input type="text" id="curp" name="curp" placeholder="CURP" class="inputFormRegister" required>
                <input type="hidden" id="user_id">
                <br>
                <button type="submit" class="saveButton">Guardar</button>
            </form>
        </section>

        <section class="tabla">
            <h1>Lista de Usuarios</h1>
            <table border="1" class="tablaUsuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>CURP</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="usuarios"></tbody>
            </table>
        </section>
    </header>
    <script src="script.js"></script>
</body>
</html>
