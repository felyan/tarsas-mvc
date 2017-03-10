<?php

namespace Tarsas\Controllers;

use Autoloader;
use stdClass;

/*
 * Minden Controller ebből az osztályból származik.
 * A közösen használt metódusok itt vannak.
 */
class Controller extends stdClass
{
  protected $user;
  protected $routing;
  protected $viewsPath;
  protected $view;
  protected $layout;

  public function __construct($routing)
  {
    // Munkamenetre mindig szükség lehet.
    session_start();
    // A routing objektumot átadjuk a controllernek is, hogy a benne lévő getRoute helpert használni tudjuk.
    $this->routing = $routing;
    $this->getUser();
    $this->viewsPath = Autoloader::getPath(__NAMESPACE__) . '/../Views/';
  }

  public function index()
  {
    // Alapértelmezett index metódus, ami példányosításkor felülírható.
  }

  /*
   * Ha már bejelentkezett a felhasználó, akkor a $_SESSION
   * tömbben ott vannak az adatai, azt kiolvassuk.
   * A "setter" metódusok beállítják az objektum egyik változóját.
   * A "getter" metódusok pedig visszaadják a már benne lévő értéket.
   */
  private function getUser()
  {
    if (isset($_SESSION['user'])) {
      $this->user = $_SESSION['user'];
    }
  }

  public function setLayout($layout)
  {
    $this->layout = $layout;
  }

  public function setView($view)
  {
    $this->view = $view;
  }

  /**
   * A render metódus megvizsgálja, hogy létezik-e a megjelenítendő fájl.
   * Ha igen, akkor használjuk, tehát "include" metódussal behívjuk.
   *
   * @param null $view
   */
  public function render($view = null)
  {
    if (is_null($view)) {
      $view = $this->view;
    }
    if (file_exists($view)) {
      include($view);
    }
  }

  /*
   * Ezzel az eljárással rendereljük a "layout"-ot.
   */
  public function renderLayout()
  {
    $this->render($this->viewsPath . 'layouts/' . $this->layout . '.php');
  }

  /**
   * Ezzel az eljárással rendereljük a "view" fájlokat.
   *
   * @param null $view
   */
  public function renderView($view = null)
  {
    if (is_null($view)) {
      $view = $this->view;
    }
    $this->render($this->viewsPath . $view . '.php');
  }

  /**
   * Ha létezik az adott kulcs a $_GET tömbben,
   * akkor visszaadja annak az értékét.
   *
   * @param $key
   * @return mixed
   */
  public function get($key)
  {
    if (isset($_GET[$key])) {
      return $_GET[$key];
    }
  }

  /**
   * Ha létezik az adott kulcs a $_POST tömbben,
   * akkor visszaadja annak az értékét.
   *
   * @param $key
   * @return mixed
   */
  public function post($key)
  {
    if (isset($_POST[$key])) {
      return $_POST[$key];
    }
  }

  /**
   * Adott kulcs értékét megkeresi a $_POST vagy a $_GET tömbökben.
   * Ha a post-ben találja, akkor azt adja vissza,
   * egyébként pedig a get-ben fogja keresni.
   *
   * @param $key
   * @return mixed
   */
  public function request($key)
  {
    $request = $this->post($key);
    if ($request) {
      return $request;
    }
    return $this->get($key);
  }
}
