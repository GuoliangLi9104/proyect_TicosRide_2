<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/functions/models/users.php');

session_start(); // Esto es necesario para usar $_SESSION

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $result = authenticate($username, $password);

    if ($result) {
       $_SESSION['user'] = $result;
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['success'] = "Login successful! Welcome, " . $user['username'] . ".";

        // Redireccionar al dashboard
        header("Location: /pages/dashboard.php");
        exit;
    } else {    
        // Mostrar mensaje de error
        $_SESSION['error'] = "Invalid username or password";
        header("Location: /pages/login.php"); // Asegúrate de manejar y mostrar este mensaje en login.php
        exit;
    }
}

