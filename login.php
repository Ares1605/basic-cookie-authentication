<?php
require_once('Env.php');
require_once('SessionManager.php');
if (!isset($_POST['password'])) {
  die('must contain password data to login!');
}
$password = $_POST['password'];
if (!password_verify($password, Env::get('PASSWORD_HASHED'))) {
  die('incorrect');
}

$session_id = SessionManager::create_session();
setcookie(
  'session_id',
  $session_id,
  [
    'expires' => time() + 28800, // 8 hours
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
  ]
);

echo 'success';
