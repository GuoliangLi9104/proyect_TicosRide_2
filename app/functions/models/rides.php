<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function getRides() {
    // Obtener la conexión a la base de datos
    $conn = get_pdo_connection();

    $query = "SELECT * FROM rides";

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Fetch all results as an associative array
    $rides = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rides;
}

function searchRides($from, $to) {
    $conn = get_pdo_connection(); 

    // Prepara la consulta con los placeholders de PDO
    $query = "SELECT * FROM rides WHERE start_from LIKE :from AND destination LIKE :to";
    $stmt = $conn->prepare($query);

    // Usa '%' con bindValue directamente
    $stmt->bindValue(':from', "%$from%");
    $stmt->bindValue(':to', "%$to%");

    // Ejecutar la declaración preparada
    $stmt->execute();

    // Obtener todos los resultados
    $rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $rides;
}

?>