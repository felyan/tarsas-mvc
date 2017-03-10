<?php

namespace Tarsas\Models;

use PDO;
use stdClass;

class Model extends stdClass
{
  public $db;
  protected $res;
  protected $config;

  public function __construct()
  {
    $this->getConfig();
    $this->connect();
  }

  /**
   * Kiolvassa a konfigurációt az általános beállításokhoz tartozó ini fájlból.
   */
  protected function getConfig()
  {
    $this->config = parse_ini_file('config/general.ini', true);
  }

  /**
   * Példányosítja a PDO objektumot, a config-ban megadott authentikációs adatokkal.
   * Alapértelmezetten UTF8 kódolással dolgozunk.
   */
  public function connect()
  {
    $this->db = new PDO(
      'mysql:host=localhost;dbname=' . $this->config['db']['name'],
      $this->config['db']['user'],
      $this->config['db']['pass'],
      [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
    );
  }

}
