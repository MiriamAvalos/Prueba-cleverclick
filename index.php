<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <form id="userForm" method="POST" action="guardar_usuario.php">
        <label for="first_name">Nombre:</label>
        <input type="text" id="first_name" name="first_name" required>
    
        <label for="last_name">Apellidos:</label>
        <input type="text" id="last_name" name="last_name" required>
    
        <label for="age">Edad:</label>
        <input type="number" id="age" name="age" required>
    
        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" required>
    
        <button type="submit">Guardar</button>
    </form>
    
    <script src="script.js"></script>
</body>
</html>