<?php

namespace App\http\middleware;

use Exception;

class Queue{

    //mapeamento de middleware
    //array
    private static $map = [];

    //mapeamento de middlewares que serao carregados em todas as rotas
    //array
    private static $default = [];

    //fila de migglewares a serem executados
    //array
    private $middlewares = [];

    //funçao de execuçao do controlador
    //Closure
    private $controller;

    //argumentos da funçao do controlaor
    //array
    private $controllerArgs = [];

    //responsavel por construir a classe de fila de middlewares
    //array $middlewares
    //Closure $controller
    //array $controllerArgs
    public function __construct($middlewares, $controller, $controllerArgs){
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    //responsavel por definir o mapeamento de middlewares
    //array $map
    public static function setMap($map){
        self::$map = $map;
    }

    //responsavel por definir o mapeamento de middlewares padroes
    //array $default
    public static function setDefault($default){
        self::$default = $default;
    }

    //responsavel por executar o proximo nivel da fila de midlleware
    //request
    //return response
    public function next($request){
        
        //verifica se a fila esta vazia
        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        //middlewares
        $middleware = array_shift($this->middlewares);

        //verifica o mapeamento
        if(!isset(self::$map[$middleware])){
            throw new \Exception("problemas ao processar o middleware da requisiçao", 500);
        }

        //next
        $queue = $this;
        $next = function($request) use($queue){
            return $queue->next($request);
        };

        //executa o middleware
        return (new self::$map[$middleware])->handle($request, $next);

    }

}