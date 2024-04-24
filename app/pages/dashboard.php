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
                            <a class="menu-item" href="settings.html" id="config">Settings</a>
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
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/utils/showRidesInfo.php'); ?>
        </div>


        <div id="rides-view">

        </div>


    </div>




</body>

</html>