<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    var_dump($_POST);  

    
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['age']) && !empty($_POST['curp'])) {
       
        $host = "btvax3f1faoz6dli8zrx-mysql.services.clever-cloud.com";
        $user = "uwn4oeduomhguidh";
        $password = "9fZhJdADyQ3edlVjPTaJ";
        $dbname = "btvax3f1faoz6dli8zrx";
        $port = 3306;

        
        $conn = new mysqli($host, $user, $password, $dbname, $port);

      
        if ($conn->connect_error) {
            error_log("Conexión fallida: " . $conn->connect_error); 
            die("Conexión fallida: " . $conn->connect_error);
        } else {
            echo "Conexión exitosa a la base de datos.<br>"; 
        }

   
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $age = (int)$_POST['age']; 
        $curp = $conn->real_escape_string($_POST['curp']);

  
        $sql = "INSERT INTO users (first_name, last_name, age, curp) VALUES ('$first_name', '$last_name', $age, '$curp')";

       
        if ($conn->query($sql) === TRUE) {
            echo "Nuevo usuario creado exitosamente";
        } else {
            error_log("Error en consulta: " . $conn->error);  // Registra el error en el archivo de log
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        
        $conn->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
