<?php

class Autoloader
{

  /**
   * Fizikai (absolsolute) fájl elérési útvonalat generál, a porjekt logikájához illően.
   *
   * @param $className
   * @return string
   */
  static public function getPath($className)
  {
    /**
     * getcwd - jelenlegi útvonal, ami az index.php-n keresztül ment
     * A fejlesztői gépen ez: /home/hp/www/tarsas2
     */
    return getcwd() . '/app/' . str_replace('\\', '/', $className);
  }

  /**
   * Bármelyik fájl elején ott van, hogy "use valamiFile", akkor
   * a "loader" eljárás megkapja a "valamiFile" argumentumot.
   * A projekt logikája szerint legeneráljuk az elérési útvonalat,
   * amennyiben a fájl létezik, mehet a requre_once!
   *
   * @param $className
   * @return bool
   */
  static public function loader($className)
  {
    $filename = Autoloader::getPath($className) . '.php';
    if (file_exists($filename)) {
      require_once($filename);
      if (class_exists($className)) {
        return true;
      }
    }
    return false;
  }
}

/*
 * http://php.net/manual/en/function.spl-autoload-register.php
 */
spl_autoload_register('Autoloader::loader');
