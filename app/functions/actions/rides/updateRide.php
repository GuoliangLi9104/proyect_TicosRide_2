<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rideId = $_POST['rideId'];
    $rideName = $_POST['rideName'];
    $startFrom = $_POST['startFrom'];
    $endTo = $_POST['end'];
    $description = $_POST['description'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];

    //Concatenate the selected days
    $days = '';
    $daysArray = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    foreach ($daysArray as $day) {
        if (!empty($_POST[$day])) {
            $days .= $_POST[$day] . ',';
        }
    }
    $days = rtrim($days, ',');

    //Prepare the SQL query to update the ride
    $sql = "UPDATE users SET ride_name=?, start_from=?, end_to=?, description=?, departure_time=?, arrival_time=?, days=? WHERE id=?";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    if ($stmt->execute([$rideName, $startFrom, $endTo, $description, $departure, $arrival, $days, $rideId])) {
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        // Manejar errores si la consulta no se ejecuta correctamente
        // echo "Error: Could not execute $sql. " . $stmt->errorInfo();
        exit();
    }
}
