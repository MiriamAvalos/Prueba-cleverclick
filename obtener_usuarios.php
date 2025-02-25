<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


// Conexión a la base de datos
$host = "sql107.infinityfree.com";
$user = "if0_38397056";
$password = "Tv0iZMVUyhsoa";
$dbname = "if0_38397056_crud_usuarios";
$port = 3306;


$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, first_name, last_name, age, curp FROM users";
$result = $conn->query($sql);

$usuarios = [];

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}


echo json_encode($usuarios);



$conn->close();
?>
