<?php

namespace Tarsas;

use stdClass;

class Routing extends stdClass
{
  public $name;

  protected $routes;
  // http://tarsas2.local/index.php?TARTALOM=profil_regisztracio
  protected $routeGetName = 'tartalom';
  // http://tarsas2.local/index.php?tartalom=FOOLDAL
  // Az oldal első betöltésénél ezt a route-ot fogja használni
  protected $defaultRoute = 'fooldal';
  protected $defaultLayout = 'main';
  // A route-hoz tartozó Controller melyik metódusát használjuk
  protected $defaultMethod = 'index';

  public function __construct()
  {
    $this->getRoutes();
    $name = $this->getName();
    $uses = $this->getUses($name);
    $layout = $this->getLayout($name);
    $method = $this->getMethod($name);
    $controller = new $uses($this);
    // Alapértelmezett view a $name alapján
    $controller->setView($name);
    $controller->setLayout($layout);
    $controller->$method();
    $controller->renderLayout();
  }

  /*
   * Kiolvassuk az ini fájlból a routing konfigurációját.
   */
  private function getRoutes()
  {
    $this->routes = parse_ini_file('config/routing.ini', true);
  }

  /*
   * A routeingból kiolvassuk, hogy melyik Controller intézi a művletet.
   */
  private function getUses($name)
  {
    if (isset($this->routes[$name]) and isset($this->routes[$name]['uses'])) {
      return $this->routes[$name]['uses'];
    }
  }

  /*
   * Ha a routing-ban meg van adva más layout, mint az alapértelmezett,
   * akkor azt használjuk.
   */
  private function getLayout($name)
  {
    if (isset($this->routes[$name]) and isset($this->routes[$name]['layout'])) {
      return $this->routes[$name]['layout'];
    }
    return $this->defaultLayout;
  }

  /*
   * Ha a Controller-ben nem az "index" metódus kell, akkor a routing-ban megadhatjuk,
   * hogy melyik metódus intézi a művletet.
   */
  private function getMethod($name)
  {
    if (isset($this->routes[$name]) and isset($this->routes[$name]['method'])) {
      return $this->routes[$name]['method'];
    }
    return $this->defaultMethod;
  }

  /*
   * Az URL-ben lévő adatok alapján meghatározom hogy melyik tartalmat kell betölteni.
   * Azaz a route-ban lévő konfiguráció kulcsát (azaz nevét).
   */
  private function getName()
  {
    // Ha van "tartalom" $_GET-es paraméter
    if (isset($_GET[$this->routeGetName])) {
      // Kiolvassuk azt, és $name-ként kezeljük
      $name = $_GET[$this->routeGetName];
      // Ha van ilyen "route", akkor azzal dolgozunk
      if (isset($this->routes[$name])) {
        return $name;
      }
      // Ha nincs, akkor 404
      return '404';
    } else {
      // Ha nincs "tartalom" a $_GET-es paraméterek közt
      // Akkor vagy a főoldal kell, vagy megint csak 404
      if ($_SERVER['REQUEST_URI'] == '/index.php') {
        return $this->defaultRoute;
      }
      return '404';
    }
  }

  /*
   * Helper eljárás.
   * A "view" fájlokban az URL-ek kiírására használjuk.
   */
  public function getRoute($key)
  {
    if (isset($this->routes[$key])) {
      echo '/index.php?' . $this->routeGetName . '=' . $key;
    }
  }
}
