<?php
// Configuración de la base de datos
// Conexión a la base de datos
$host = "sql107.infinityfree.com";
$user = "if0_38397056";
$password = "Tv0iZMVUyhsoa";
$dbname = "if0_38397056_crud_usuarios";
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
