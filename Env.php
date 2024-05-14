<?php
require_once(__DIR__ . '/vendor/autoload.php');

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

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
  }
}
