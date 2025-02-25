<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Mostrar los datos recibidos para depuración
    var_dump($_POST);

    // Asegurarse de que se ha proporcionado el ID del usuario para eliminar
    if (isset($_POST['id'])) {
        $userId = $_POST['id'];

        // Datos de conexión a la base de datos
       // Conexión a la base de datos
$host = "sql107.infinityfree.com";
$user = "if0_38397056";
$password = "Tv0iZMVUyhsoa";
$dbname = "if0_38397056_crud_usuarios";
$port = 3306;


        // Conectar a la base de datos
        $conn = new mysqli($host, $user, $password, $dbname, $port);

        // Verificar si hubo error en la conexión
        if ($conn->connect_error) {
            error_log("Conexión fallida: " . $conn->connect_error);
            die("Conexión fallida: " . $conn->connect_error);
        } else {
            echo "Conexión exitosa a la base de datos.<br>";
        }

        // Preparar y ejecutar la consulta de eliminación
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "Usuario eliminado correctamente.";
        } else {
            echo "Error al eliminar el usuario.";
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo "No se ha proporcionado un ID de usuario para eliminar.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
