<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

// Asumir que el user_id se obtiene de la sesión
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
  echo "Error: User ID not provided.";
  exit();
}

// Preparar y ejecutar la consulta para obtener datos del usuario
$sql = "SELECT full_name, speed_avarage, about_me FROM profile WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$profile) {
  echo "Error: Profile not found.";
  exit();
}

// Asignar los valores obtenidos a las variables
$fullName = $profile['full_name'];
$speedAverage = $profile['speed_average'];
$aboutMe = $profile['about_me'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticos-Ride-Config</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/styles/dashboard.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col d-flex justify-content-start flex-row">
        <div class="d-flex flex-column">
          <div class="p-2">
            <img class="image-size" src="../public/img/logo.png" alt="Car Travel Image">
          </div>
          <div class="p-2">

            <div class="relative" style="display: flex;">
              <a class="menu-item active" href="dashboard.php" id="dashboard">Dashboard</a>
              <a class="menu-item" href="create_ride.php" id="rides">Rides</a>
              <a class="menu-item" href="settings.php" id="config">Settings</a>
            </div>
          </div>
          <div class="p-2">
            <h4 id="currentSection"></h4>
          </div>
        </div>

      </div>
      <div class="col d-flex justify-content-end mt-auto p-2">
        Welcome &nbsp;
        <p id="username"></p>
        <img class="image-user" src="../public/img/user.png" alt="Car Travel Image">
      </div>
    </div>

    <h2>Settings</h2>

    <div id="rides-view">
      <a href="dashboard.html">Dashboard</a>
      <span class="arrow">></span>
      <a href="configuration.html">Settings</a>
    </div>
    <div id="settings-view">
      <br>
      <form action="/actions/users/editUsers.php" method="post">
        <div class="row justify-content-center align-items-center g-2">
          <div class="col">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo htmlspecialchars($fullName); ?>" placeholder="Input text">
            <br>
          </div>
        </div>
        <div class="row justify-content-center align-items-center g-2">
          <div class="col">
            <label for="speedAverage" class="form-label">Speed Average</label>
            <input type="text" class="form-control" id="speedAverage" name="speedAverage" value="<?php echo htmlspecialchars($speedAverage); ?>" placeholder="Input text">
            <br>
          </div>
        </div>
        <div class="row-cols-md-4 justify-content-center align-items-center g-2">
          <label for="aboutMe" class="form-label">About Me</label>
          <div class="aboutMe">
            <textarea id="aboutMe" name="aboutMe" class="form-control" placeholder="Something about me goes here"><?php echo htmlspecialchars($aboutMe); ?></textarea>
          </div>
        </div>

        <br>
        <br>
        <br>

        <div class="row justify-content-center align-items-center g-2">
          <div class="col"><a href="dashboard.php" class="btn btn-secondary">Cancel</a></div>
          <div class="col"><button type="submit" class="btn btn-primary">Save Changes</button></div>
        </div>
      </form>

      <script type="text/javascript" src="../js/dashboard.js"></script>

</body>

</html>