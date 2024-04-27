<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
$pdo = get_pdo_connection();

// Verificar si se recibió un user_id en la URL
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Preparar la consulta SQL para obtener la información del perfil del usuario
    $sql = "SELECT * FROM profile WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el perfil
    if ($profile) {
        $fullName = $profile['full_name'];
        $speedAverage = $profile['speed_avarage'];  // Asegúrate de que el nombre del campo es correcto en la DB
        $aboutMe = $profile['about_me'];
    } else {
        // Si no se encontró el perfil
        echo "Error: Profile not found for user ID " . htmlspecialchars($userId);
        exit();
    }
} else {
    // Si no se proporcionó user_id en la URL
    echo "Error: User ID not provided.";
    exit();
}
?>
