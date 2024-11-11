<?php
// Configuración de la base de datos
$host = "btvax3f1faoz6dli8zrx-mysql.services.clever-cloud.com";
$user = "uwn4oeduomhguidh";
$password = "9fZhJdADyQ3edlVjPTaJ";
$dbname = "btvax3f1faoz6dli8zrx";
$port = 3306;

try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $user, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        echo json_encode($usuario);
    } else {
        echo json_encode(["error" => "Usuario no encontrado"]);
    }
} else {
    echo json_encode(["error" => "ID de usuario no proporcionado"]);
}
?>
