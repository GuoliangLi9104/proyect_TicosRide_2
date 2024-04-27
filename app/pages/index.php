<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/rides.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/users.php';

$rides = array();
// Se verifica si la solicitud HTTP es de tipo POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se obtienen los valores de los parámetros 'from' y 'to' enviados a través del formulario html
    $from = $_POST['from'];
    $to = $_POST['to'];
    // Se llama a la función searchRides($from, $to) con los valores de $from y $to como argumentos para buscar "rides"
    $rides = searchRides($from, $to);
} else {
     // Si la solicitud no es de tipo POST, se llaman a la función getRides() 
    $rides = getRides();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticos-Ride-Dashboard-Pricipal-page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/styles/principalPage.css">


</head>

<body>
    <div class="button">
        <a id="login" href="login.php" class="save">Login</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-start flex-row">
                <div class="d-flex flex-column">
                    <div class="p-2">
                        <img class="image-size" src="../public/img/logo.png" alt="Car Travel Image">
                    </div>

                    <div class="p-2">
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-end mt-auto p-2">
                Welcome &nbsp;
                <p id="username"></p>
                <img class="image-user" src="../public/img/user.png" alt="Car Travel Image">
            </div>
        </div>
        <div class="row justify-content-center align-items-center g-2">
            <div class="col">
                <h2>Welcome to TicoRides.com</h2>
                <br>
                <br>
                <br>
            </div>

        </div>

        <div id="panel-view" class="table-container">

            <h6>Search for a ride</h6>
            <div class="card">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-5 d-flex align-items-center"> <span>From</span> <input type="text"
                            class="form-control ms-2" id="from" placeholder="Input text"> 
                    <div class="col-5 d-flex align-items-center">
                        <span>To</span>
                        <input type="text" class="form-control ms-2" id="to" placeholder="Input text">
                        
                    </div>
                    <div class="col-2"><button class="save">Find my Ride!</button></div>
                </div>
            </div>

            <br>
            <br>
        </div>

        <div id="settings-view">
            <h4>Result for Rides that matches your criteria:</h4>
            <div class="settings">
                 <!-- Include the PHP file to show the list of rides -->
                 <?php foreach ($rides as $ride) {
                                $user = get_user_by_id($ride['user_id']);
                                $username = $user['username'];

                                echo "<tr>";
                                echo "<td>{$username}</td>";
                                echo "<td>{$ride['start']}</td>";
                                echo "<td>{$ride['end']}</td>";
                                echo "<td><a href='/pages/view.php?id={$ride['id']}' class='btn btn-second btn-sm'>View</a></td>"; 
                                echo "</tr>";
                            }
                ?>

</body>

</html>