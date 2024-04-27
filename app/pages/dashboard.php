<?php
session_start();

if (isset($_SESSION['success'])) {
    echo '<div style="color: green;">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); // Limpiar el mensaje de éxito después de mostrarlo
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Assuming you have a function or method to fetch user details
require($_SERVER['DOCUMENT_ROOT'] . '/functions/models/users.php');
$userDetails = get_user_by_id($_SESSION['user_id']);

if (isset($_SESSION['message'])) {
    echo "<p>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);  // Limpia el mensaje después de mostrarlo
}

if (isset($_SESSION['error'])) {
    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);  // Limpia el error después de mostrarlo
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticos-Ride-Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/styles/dashboard.css">


</head>



<body>
    <div class="background-image"></div>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-start flex-row">
                <div class="d-flex flex-column">
                    <div class="p-2">
                        <img class="image-size" src="../public/img/logo.png" alt="Car Travel Image">
                    </div>
                    <div class="p-">
                        <div class="relative" style="display: flex;">
                            <a class="menu-item active" href="dashboard.php" id="dashboard">Dashboard</a>
                            <a class="menu-item" href="create_ride.php" id="rides">Rides</a>
                            <a class="menu-item" href="settings.php" id="config">Settings</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col d-flex justify-content-end mt-auto p-2">
                Welcome &nbsp;
                <p id="username"></p>
                <img class="image-user" src="../public/img/user.png" alt="Car Travel Image">
            </div>
        </div>


        <div id="panel-view" class="table-container">
            <br>
            <h2>My Rides</h2>
            <br>
            <!-- Include the PHP file to show the list of rides -->
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/utils/showRidesId.php'); ?>

        </div>


        <div id="rides-view">

        </div>


    </div>




</body>

</html>