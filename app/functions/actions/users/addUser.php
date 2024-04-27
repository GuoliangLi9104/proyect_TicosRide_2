<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Preparar la consulta SQL para la inserción del viaje
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, last_name, phone, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name, $last_name, $phone, $username, $passwordHash])) {
        $lastInsertedId = $pdo->lastInsertId();

        // Supongamos que quieres insertar en `profile` también
        $sqlP = "INSERT INTO profile (full_name, speed_average, about_me, user_id) VALUES (?, ?, ?, ?)";
        $stmtP = $pdo->prepare($sqlP);
        if ($stmtP->execute(["", "", "", $lastInsertedId])) {
            $_SESSION['message'] = "User registered successfully!";
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to create profile.";
            header("Location: register.php"); // Suponiendo que tienes una página de registro
            exit();
        }
    } else {
        $_SESSION['error'] = "Error: No se pudo ejecutar la consulta SQL.";
        header("Location: register.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: register.php");
    exit();
}
