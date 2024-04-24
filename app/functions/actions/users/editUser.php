<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Prepare the SQL query to update the ride
    $sql = "UPDATE rides SET name=?, last_name=?, phone=?, username=?, password=? WHERE id=?";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    if ($stmt->execute([$name, $last_name, $phone, $username, $password])) {
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        // Manejar errores si la consulta no se ejecuta correctamente
        // echo "Error: Could not execute $sql. " . $stmt->errorInfo();
        exit();
    }
}
