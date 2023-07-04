<?php

require __DIR__.'/includes/app.php';

use App\http\Router;

//inicia o router
$obRouter=new Router(URL);

//inclui a rota de paginas
include __DIR__.'/routes/pages.php';

//inclui a rota do painel
include __DIR__.'/routes/admin.php';

//imprime o response da rota
$obRouter->run()->sendResponse();