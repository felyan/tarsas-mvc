<?php

namespace Tarsas;

use stdClass;

class Routing extends stdClass
{
  public $name;

  protected $routes;
  protected $controller;
  protected $routeGetName = 'tartalom';
  protected $defaultRoute = 'fooldal';
  protected $defaultLayout = 'main';
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

  private function getRoutes()
  {
    $this->routes = parse_ini_file('config/routing.ini', true);
  }

  private function getUses($name)
  {
    // TODO: Kivételkezelés 404 esetére!
    return $this->routes[$name]['uses'];
  }

  private function getLayout($name)
  {
    if (isset($this->routes[$name]) and isset($this->routes[$name]['layout'])) {
      return $this->routes[$name]['layout'];
    }
    return $this->defaultLayout;
  }

  private function getMethod($name)
  {
    if (isset($this->routes[$name]) and isset($this->routes[$name]['method'])) {
      return $this->routes[$name]['method'];
    }
    return $this->defaultMethod;
  }

  private function getName()
  {
    return isset($_GET[$this->routeGetName]) ? $_GET[$this->routeGetName] : $this->defaultRoute;
  }

  public function getRoute($key)
  {
    if (isset($this->routes[$key])) {
      echo '/index.php?' . $this->routeGetName . '=' . $key;
    }
  }
}
