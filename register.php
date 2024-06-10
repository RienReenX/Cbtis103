<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = isset($_POST['username']) ? $_POST['username'] : '';
    $nombre_aspirante = isset($_POST['nombre_aspirante']) ? $_POST['nombre_aspirante'] : '';
    $especialidad = isset($_POST['especialidad']) ? $_POST['especialidad'] : '';
    $curp = isset($_POST['curp']) ? $_POST['curp'] : '';
    $escuela = isset($_POST['escuela']) ? $_POST['escuela'] : '';
    $pass = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

    $sql = "INSERT INTO users (username, nombre_aspirante, especialidad, curp, escuela, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssss", $user, $nombre_aspirante, $especialidad, $curp, $escuela, $pass);

        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
