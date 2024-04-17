<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Registro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta a la base de datos
$sql = "SELECT * FROM reg WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario y contraseña válidos, redirigir a la página de bienvenida
    header("Location: bienvenida.html");
    exit();
} else {
    // Usuario o contraseña incorrectos, mostrar un mensaje de error
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>