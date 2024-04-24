<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function authenticate($username, $password) {
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

}


