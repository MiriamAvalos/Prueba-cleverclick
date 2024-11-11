<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


$host = "btvax3f1faoz6dli8zrx-mysql.services.clever-cloud.com";
$user = "uwn4oeduomhguidh";
$password = "9fZhJdADyQ3edlVjPTaJ";
$dbname = "btvax3f1faoz6dli8zrx";
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
