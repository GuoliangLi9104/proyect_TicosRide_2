<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

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
    <title>Ticos-Ride-rides</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/styles/dashboard.css">


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-start flex-row">
                <div class="d-flex flex-column">
                    <div class="p-2">
                        <img class="image-size" src="../public/img/Logo.png" alt="Car Travel Image">
                    </div>
                    <div class="p-2">

                        <div class="relative" style="display: flex;">
                            <a class="menu-item" href="dashboard.php" id="dashboard">Dashboard</a>
                            <a class="menu-item active" href="ride.php" id="rides">Rides</a>
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
        <br>

        <div id="rides-view">
            <a href="dashboard.html">Dashboard</a>
            <span class="arrow">></span>
            <a href="ride.html">Rides</a>


        </div>

        <div id="settings-view">
            <br>
            <h2>Rides info</h2>
            <br>
            <!--Include the PHP file to get ride information -->
            <?php
            require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/getInfoRides.php');
            $rideId = isset($_GET['rideId']) ? $_GET['rideId'] : '';
            if (!$rideId) {
                echo "Error: Ride ID not provided.";
                exit();
            }
            ?>
            <form action="../functions/updateRide.php" method="post">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col"><label for="fullname" class="form-label">Ride Name</label>
                        <input type="text" class="form-control" id="rideName" name="rideName" value="<?php echo htmlspecialchars($rideName); ?>">
                        <br>
                    </div>

                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <label for="start" class="form-label">Start From</label>
                        <input type="text" class="form-control" id="startFrom" name="startFrom" value="<?php echo htmlspecialchars($startFrom); ?>">

                        <br>
                    </div>
                    <div class="col">
                        <label for="end" class="form-label">End</label>
                        <input type="text" class="form-control" id="end" name="end" value="<?php echo htmlspecialchars($endTo); ?>">

                        <br>
                    </div>
                </div>


                <div class="row-cols-md-4 justify-content-center align-items-center g-2">
                    <label for="aboutMe" class="form-label">Destination</label>
                    <div class="aboutMe">
                        <textarea class="form-control" id="description" name="description" rows="2"><?php echo htmlspecialchars($description); ?></textarea>

                    </div>

                </div>

                <hr>
                <h2>When</h2>

                <div class="row justify-content-center align-items-center g-2">

                    <div class="col">

                        <label for="departure" class="form-label">Departure</label>
                        <input type="time" class="form-control" id="departure" name="departure" value="<?php echo htmlspecialchars($departure); ?>">
                        <br>
                        <div> <label for="arrival" class="form-label">Estimated Arrival</label>
                            <input type="time" class="form-control form-control-sm" id="arrival" name="arrival" value="<?php echo htmlspecialchars($arrival); ?>">
                        </div>
                    </div>

                    <div class="col">
                        <h3>Sectect Days</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Monday" id="monday" name="monday" <?php if (in_array("Monday", $days)) echo "checked"; ?>>
                            <label class="form-check-label" for="monday">Monday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Tuesday" id="tuesday" name="tuesday" <?php if (in_array("Tuesday", $days)) echo "checked"; ?>>
                            <label class="form-check-label" for="tuesday">Tuesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Wednesday" id="wednesday" name="wednesday" <?php if (in_array("Wednesday", $days)) echo "checked"; ?>>
                            <label class="form-check-label" for="wednesday">Wednesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Thuerday" id="thuerday" name="thuerday" <?php if (in_array("Thuerday", $days)) echo "checked"; ?>>
                            <label class="form-check-label" for="thuerday">Thuerday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Friday" id="friday" name="friday" <?php if (in_array("Friday", $days)) echo "checked"; ?>>
                            <label class="form-check-label" for="flexCheckChecked">Friday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Saturday" id="saturday" name="saturday" <?php if (in_array("Saturday", $days)) echo "checked"; ?>>
                            <label class="form-check-label" for="saturday">Saturday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Sunday" id="sunday" name="sunday" <?php if (in_array("Sunday", $days)) echo "checked"; ?>>
                            <label class="form-check-label" for="sunday">Sunday</label>
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <br>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col"><a href="dashboard.html">Cancel</a></div>
                    <div class="col"><button class="save">Add</button></div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>