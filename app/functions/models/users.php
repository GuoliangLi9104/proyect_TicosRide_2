<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

/*function authenticate($username, $password) {
  $conn = get_pdo_connection();
  $password = md5($password);
  $query = "SELECT * FROM users where username = '$username' AND password='$password'";
  $result = $conn->query($query);
  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    return $user;
  } else {
    return false;
  }

}*/

function authenticate($username, $password) {
  
  $conn = get_pdo_connection();

  // Preparar la consulta para obtener solo el hash de la contraseña del usuario
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Verificar si encontramos un usuario y si la contraseña coincide
  if ($user && password_verify($password, $user['password'])) {
      return $user; // Retornar el usuario si la contraseña es correcta
  } else {
      return false; // Retornar falso si no hay usuario o la contraseña no coincide
  }
}


/*function get_user_by_id($user_id) {
  $conn = get_pdo_connection();
  $query = "SELECT * FROM users WHERE id=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result && $result->num_rows > 0 ){
    $user = $result->fetch_assoc();
    return $user;
  } else {
    return null;
  }
}*/

/*function get_user_by_id($user_id) {
  $conn = get_pdo_connection();
  $query = "SELECT * FROM users WHERE id = :user_id";
  $stmt = $conn->prepare($query);
  
  // Usar execute con un array asociativo para enlazar los parámetros
  $stmt->execute(['user_id' => $user_id]);
  
  // Usar fetch() para obtener el usuario
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
      return $user;
  } else {
      return null;
  }
}*/
function get_user_by_id($user_id) {
  // Asegurarte de que la conexión a la base de datos es accesible
  $conn = get_pdo_connection();

  // Preparar la consulta SQL utilizando placeholders para prevenir inyección SQL
  $query = "SELECT * FROM users WHERE id = :user_id";
  $stmt = $conn->prepare($query);
  
  // Ejecutar la consulta con un array asociativo para enlazar el parámetro 'user_id'
  $stmt->execute(['user_id' => $user_id]);
  
  // Obtener el resultado como un array asociativo
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Retornar el usuario si se encontró alguno, o null si no se encontró
  if ($user) {
      return $user;
  } else {
      return null;
  }
}


