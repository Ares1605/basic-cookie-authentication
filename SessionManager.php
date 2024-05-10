<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Env.php';

class SessionManager
{
  private ?string $session_id;
  private bool $queried_session = false;
  private ?array $session = null;
  private static string $sessions_file_path;

  function __construct()
  {
    $this->session_id = $_COOKIE['session_id'] ?? null;
    return $this;
  }

  public static function init()
  {
    self::$sessions_file_path = Env::get('SECURE_DIRECTORY') . 'sessions.txt';
  }
  private static function get_ip()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
  }

  private static function generate_session_id()
  {
    $random_bytes = random_bytes(32);
    $session_id = bin2hex($random_bytes);
    return $session_id;
  }
  public static function create_session()
  {
    $ip = self::get_ip();
    $session_id = self::generate_session_id();
    $json = json_encode(['session_id' => $session_id, 'ip' => $ip, 'expires_on' => strtotime('+8 hours')]) . "\n";

    if (file_put_contents(self::$sessions_file_path, $json, FILE_APPEND | LOCK_EX) === false)
      throw new Error("Failed to create session");

    return $session_id;
  }

  public static function invalid_session()
  {
    header('Content-Type: application/json');
    die(json_encode(['logged_in' => 0]));
  }
  public static function valid_session()
  {
    header('Content-Type: application/json');
    die(json_encode(['logged_in' => 1]));
  }

  public function validate_session()
  {
    if ($this->session_id === null) self::invalid_session();
    $session = $this->get_session();
    if ($session === null || self::get_ip() !== $session['ip']) self::invalid_session();
  }


  public function get_session()
  {
    if ($this->queried_session)
      return $this->session;
    $this->queried_session = true;
    $this->session = $this->find_session();
    return $this->session;
  }

  private function find_session()
  {
    if ($this->session_id === null) return null;

    $sessions = $this->clean_sessions();
    foreach ($sessions as $session) {
      if ($session['session_id'] == $this->session_id)
        return $session;
    }

    return null; // session does not exist
  }
  private function clean_sessions()
  {
    if (!file_exists(self::$sessions_file_path)) return [];

    $valid_sessions = [];
    $valid_lines = [];
    $file = file(self::$sessions_file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($file as $line) {
      $session = json_decode($line, true);
      if (isset($session['expires_on']) && $session['expires_on'] > time()) {
        $valid_sessions[] = $session;
        $valid_lines[] = $line;
      }
    }

    file_put_contents(self::$sessions_file_path, implode(PHP_EOL, $valid_lines) . PHP_EOL, LOCK_EX);

    return $valid_sessions;
  }
}
SessionManager::init();
