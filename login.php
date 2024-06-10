<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "users_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username= '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Obtener la fila de resultados
        if (password_verify($pass, $row['password'])) {
           $_SESSION['username'] = $user;
           header("Location: welcome.php");
           exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}

$conn->close();
?>
