<?php
/*require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rideName = $_POST['rideName'];
    $startFrom = $_POST['startFrom'];
    $endTo = $_POST['end'];
    $description = $_POST['description'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $user_id =$_POST['user_id'];

    //Concatenate the selected days
    $days = '';
    $daysArray = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    foreach ($daysArray as $day) {
        if (!empty($_POST[$day])) {
            $days .= $_POST[$day] . ',';
        }
    }
    $days = rtrim($days, ',');

    //Prepare the SQL query
    $sql = "INSERT INTO rides (ride_name, start_from, end_to, description, departure_time, arrival_time, days, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$rideName, $startFrom, $endTo, $description, $departure, $arrival, $days, $user_id])) {
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
       // echo "Error: Could not execute $sql. " . $pdo->errorInfo();
    }
}*/
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rideName = $_POST['rideName'];
    $startFrom = $_POST['startFrom'];
    $endTo = $_POST['end'];
    $description = $_POST['description'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $user_id = $_POST['user_id'];

    // Verificar si el usuario existe
    $userExists = false;
    $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    if ($stmt->fetchColumn()) {
        $userExists = true;
    }

    if (!$userExists) {
        echo "Error: El usuario con ID $user_id no existe.";
        exit(); // Detener el proceso si el usuario no existe
    }

    // Concatenar los días seleccionados
    $days = '';
    $daysArray = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    foreach ($daysArray as $day) {
        if (!empty($_POST[$day])) {
            $days .= $_POST[$day] . ',';
        }
    }
    $days = rtrim($days, ',');

    // Preparar la consulta SQL para la inserción del viaje
    $sql = "INSERT INTO rides (ride_name, start_from, end_to, description, departure_time, arrival_time, days, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$rideName, $startFrom, $endTo, $description, $departure, $arrival, $days, $user_id])) {
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        echo "Error: No se pudo ejecutar la consulta SQL.";
    }
}

?>