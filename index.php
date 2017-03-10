<?php

// Az alkalmazás névtere utal a funkcióra
namespace Tarsas;

// Az autoloader intézi, hogy a PHP Class-okban a "use" megfelelő helyról húzza be a fájlokat
require_once 'app/Autoloader.php';

use Tarsas\Routing;

// Az index.php-ben példányosítjuk a Routing-ot, ami a kérések kiszolgálását intézi
new Routing();
