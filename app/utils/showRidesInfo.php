<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();
// Prepare the SQL query to get all the rides
$sql = "SELECT * FROM rides";
$stmt = $pdo->prepare($sql);
$stmt->execute();
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
                    <!--Loop through PHP to generate table rows -->
                    <?php while ($ride = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo $ride['ride_name']; ?></td>
                            <td><?php echo $ride['start_from']; ?></td>
                            <td><?php echo $ride['end_to']; ?></td>
                            <td>
                                <<!--Pass ride ID to editRides.php -->
                                <a href="see-ride.php?rideId=<?php echo $ride['id']; ?>" class="btn btn-primary">View</a>
                                <!-- Add delete functionality -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
