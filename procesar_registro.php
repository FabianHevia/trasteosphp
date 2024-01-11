<?php

$mysqli = new mysqli('localhost', 'root', '', 'init');

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $fecha = $_POST['fecha'];

    // Validar datos (puedes agregar más validaciones según tus necesidades)
    if (empty($rut) || empty($nombre) || empty($email) || empty($contrasena) || empty($fecha)) {
        die('Por favor, complete todos los campos del formulario.');
    }

    // Hash de la contraseña (se recomienda usar funciones de hash seguras)
    $hashed_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

    // Preparar la consulta de inserción
    $insert_query = "INSERT INTO usuarios (rut, nombre, email, contraseña, fecha) VALUES ('$rut', '$nombre', '$email', '$hashed_contrasena', '$fecha')";

    // Verificar si la inserción fue exitosa
    if ($mysqli->query($insert_query) === true) {
        echo 'Registro exitoso.';
    } else {
        die('Error en la inserción: ' . $mysqli->error);
    }
}

$mysqli->close();

?>

