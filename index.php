<?php

require __DIR__.'/vendor/autoload.php';

use App\http\Router;

define('URL', 'http://localhost:8000');

$obRouter=new Router(URL);

//inclui a rota de paginas
include __DIR__.'/routes/pages.php';

//imprime o response da rota
$obRouter->run()->sendResponse();