<?php
$servername = "localhost";
$username = "root"; // Cambia esto si tu usuario de MySQL es diferente
$password = ""; // Cambia esto si tu contraseña de MySQL es diferente
$dbname = "users_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $nombre_aspirante = $_POST['nombre_aspirante'];
    $especialidad = $_POST['especialidad'];
    $curp = $_POST['curp'];
    $escuela = $_POST['escuela'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, nombre_aspirante,especialidad,curp,escuela,password) VALUES ('$user','$nombre_aspirante','$especialidad','$curp','$escuela','$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
