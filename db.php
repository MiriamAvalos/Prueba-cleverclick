<?php
// Parámetros de conexión a Clever Cloud
$servername = "sql107.infinityfree.com";
$username = "if0_38397056"; 
$password = "Tv0iZMVUyhsoa";  
$dbname = "if0_38397056_crud_usuarios";  
$port = 3306;  


$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

echo "Conexión exitosa a la base de datos";


$conn->set_charset("utf8");


$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(150) NOT NULL,
    age INT NOT NULL,
    curp VARCHAR(18) NOT NULL UNIQUE
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' creada exitosamente";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}


$conn->close();

?>
