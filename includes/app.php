<?php

require __DIR__.'/../vendor/autoload.php';

use App\utils\View;
use \WilliamCosta\DotEnv\Environment;
use WilliamCosta\DatabaseManager\Database;
use App\http\middleware\Queue as MiddlewareQueue;

//carrega variaveis de ambiente
Environment::load(__DIR__.'/../');

//define as configuraçoes de banco de dados
Database::config(getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_PORT'));

//defini a constante de URL do projeto
define('URL', getenv('URL'));

//defini o valor padrao das variaveis
View::init([
    'URL' => URL
]);

//define o mapeamento de middlewares
MiddlewareQueue::setMap([
    'maintenance' => App\http\middleware\Maintenance::class
]);

//define o mapeamento de middlewares padroes (executados em todas as rotas)
MiddlewareQueue::setDefault([
    'maintenance'
]);