<?php

class Autoloader
{
  static public function getPath($className)
  {
    return getcwd() . '/app/' . str_replace('\\', '/', $className);
  }

  static public function loader($className)
  {
    $filename = Autoloader::getPath($className) . '.php';
//    echo $filename . PHP_EOL;
    if (file_exists($filename)) {
      require_once($filename);
      if (class_exists($className)) {
        return true;
      }
    }
    return false;
  }
}

spl_autoload_register('Autoloader::loader');
