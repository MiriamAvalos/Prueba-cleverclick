<?php
// Conexión a la base de datos
$host = "btvax3f1faoz6dli8zrx-mysql.services.clever-cloud.com";
$user = "uwn4oeduomhguidh";
$password = "9fZhJdADyQ3edlVjPTaJ";
$dbname = "btvax3f1faoz6dli8zrx";
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $user, $password);
    // Establecer el modo de error de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Enviar respuesta JSON con el error si falla la conexión
    echo json_encode(["error" => "Conexión fallida: " . $e->getMessage()]);
    exit;
}

// Verificación de si los campos POST están definidos
if (isset($_POST['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['age'], $_POST['curp'])) {

    // Obtener datos del formulario de manera segura
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $curp = $_POST['curp'];

    // Validación básica
    if (!is_numeric($user_id) || !is_numeric($age)) {
        // Responder con un error si los datos no son válidos
        echo json_encode(["error" => "El ID de usuario y la edad deben ser números."]);
        exit;
    }

    // Consulta para actualizar el usuario
    $sql = "UPDATE users SET first_name = ?, last_name = ?, age = ?, curp = ? WHERE id = ?";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$first_name, $last_name, $age, $curp, $user_id]);
        // Responder con un mensaje de éxito en formato JSON
        echo json_encode(["success" => "Usuario actualizado exitosamente."]);
    } catch (PDOException $e) {
        // Enviar respuesta JSON con el error
        echo json_encode(["error" => "Error al actualizar usuario: " . $e->getMessage()]);
    }

} else {
    // Responder con un error si faltan datos
    echo json_encode(["error" => "Faltan datos del formulario."]);
}
?>
