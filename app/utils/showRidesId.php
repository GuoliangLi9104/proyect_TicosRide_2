<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

// Asumiendo que la sesión ya está iniciada en algún lugar del script antes de llegar a este punto.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirecciona si no está logueado
    exit;
}

$user_id = $_SESSION['user_id']; 

// Prepare the SQL query to get all the rides for the logged-in user
$sql = "SELECT * FROM rides WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]); // Correctamente enlazar el parámetro user_id

?>

<div class="card mt-2">
    <label class="form-label ms-3 my-2">Your current list of Rides</label>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through PHP to generate table rows -->
                    <?php while ($ride = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ride['ride_name']); ?></td>
                            <td><?php echo htmlspecialchars($ride['start_from']); ?></td>
                            <td><?php echo htmlspecialchars($ride['end_to']); ?></td>
                            <td>
                                <!-- Pass ride ID to editRides.php -->
                                <a href="edit_ride.php?rideId=<?php echo $ride['id']; ?>" class="btn btn-primary">Edit</a>
                                <!-- Add delete functionality -->
                                <a href="/actions/deleteRide.php?rideId=<?php echo $ride['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ride?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

