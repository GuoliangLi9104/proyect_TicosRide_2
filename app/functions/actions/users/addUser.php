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
    $sql = "INSERT INTO rides (name, last_name, phone, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name, $last_name, $phone, $username, $password])) {
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        echo "Error: No se pudo ejecutar la consulta SQL.";
    }
}
