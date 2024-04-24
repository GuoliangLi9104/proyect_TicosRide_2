<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

//Check if a ride ID was received in the URL
if (isset($_GET['rideId'])) {
    $rideId = $_GET['rideId'];
    //Prepare the SQL query to obtain the ride information
    $sql = "SELECT * FROM rides WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rideId]);
    $ride = $stmt->fetch(PDO::FETCH_ASSOC);

    //Check if the ride was found
    if ($ride) {
        $rideName = $ride['ride_name'];
        $startFrom = $ride['start_from'];
        $endTo = $ride['end_to'];
        $description = $ride['description'];
        $departure = $ride['departure_time'];
        $arrival = $ride['arrival_time'];
        $days = explode(',', $ride['days']);
        $user_id = $ride['user_id'];
    } else {
        //If the ride was not found
        echo "Error: Ride not found.";
        exit();
    }
} else {
    //If no ride ID was provided in the URL
    echo "Error: Ride ID not provided.";
    exit();
}
?>