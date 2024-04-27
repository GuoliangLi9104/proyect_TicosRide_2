<?php
// Iniciar la sesión
session_start();

// Verificar si un rideId ha sido enviado y que la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rideId'])) {
    // Eliminar el ride
    require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
    $pdo = get_pdo_connection();

    $rideId = $_POST['rideId'];
    $sql = "DELETE FROM rides WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$rideId])) {
        $_SESSION['message'] = "Ride deleted successfully";
        header("Location: /pages/dashboard.php");
        exit();
    } else {
        // Si hay un error en la eliminación, mostrar un mensaje de error
        $_SESSION['error'] = "Error: Could not delete ride.";
        header("Location: /pages/dashboard.php");
        exit();
    }
} else {
    // Si no se proporcionó rideId, mostrar un mensaje de error
    $_SESSION['error'] = "Error: Ride ID not provided.";
    header("Location: /pages/dashboard.php");
    exit();
}
?>