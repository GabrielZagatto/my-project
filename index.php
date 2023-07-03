<?php

require __DIR__.'/vendor/autoload.php';

use App\http\Router;
use App\utils\View;
use \WilliamCosta\DotEnv\Environment;

//carrega variaveis de ambiente
Environment::load(__DIR__);

//defini a constante de URL do projeto
define('URL', getenv('URL'));

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