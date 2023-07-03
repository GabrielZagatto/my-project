<?php

require __DIR__.'/vendor/autoload.php';

use App\http\Router;
use App\utils\View;

define('URL', 'http://localhost:8000');

//defini o valor padrao das variaveis
View::init([
    'URL' => URL
]);

//inicia o router
$obRouter=new Router(URL);

//inclui a rota de paginas
include __DIR__.'/routes/pages.php';

//imprime o response da rota
$obRouter->run()->sendResponse();