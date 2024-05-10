<?php
require_once('./vendor/autoload.php');

class Env
{
  private static $loaded = false;

  public static function get($key)
  {
    if (!Env::$loaded) Env::load();

    return $_ENV[$key];
  }

  private static function load()
  {
    Env::$loaded = true;

    $dotenv = Dotenv\Dotenv::createImmutable('./');
    $dotenv->load();
  }
}
