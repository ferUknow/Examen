<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Registro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$new_username = $_POST['username'];
$new_password = $_POST['password'];

// Verificar si el usuario ya existe
$sql = "SELECT * FROM reg WHERE username = '$new_username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $error_message = "El usuario ya existe. Por favor, elige otro nombre de usuario.";
} else {
    // Preparar y ejecutar consulta SQL para insertar datos
    $sql = "INSERT INTO reg (username, password) VALUES ('$new_username', '$new_password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: inicio.html");
        $success_message = "Usuario creado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
</head>
<body>
    <h1>Registro de usuario</h1>
    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } elseif (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <a href="inicio.html">Volver al inicio</a>
</body>
</html>