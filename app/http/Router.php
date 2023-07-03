<?php

namespace App\http;
use Closure;
use Exception;
use ReflectionFunction;

class Router{
    //URL completa do projeto
    //string
    private $url = '';
    //prefixo de todas as rotas
    //string
    private $prefix = '';
    //indice de rotas
    //array
    private $routes = [];
    //intancia de request
    //Request
    private $request;
    //responsavel por iniciar a classe
    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }
    //responsavel por definir o prefixo das rotas
    private function setPrefix(){
        //informaçoes da url atual 
        $parseUrl = parse_url($this->url);
        //defini o prefixo
        $this->prefix = $parseUrl['path'] ?? '';
    }
    //responsavel por adicionar uma rota na classe
    //string($method)
    //string($route)
    //array($params)
    private function addRoute($method, $route, $params = []){
        //validaçao dos parametros
        foreach($params as $key => $value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }
        //variaveis de rota
        $params['variables'] = [];

        //padrao de validaçao das variaveis das rotas
        $patternVariable = '/{(.*?)}/';
        if(preg_match_all($patternVariable,$route,$matches)){
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }
        //padrao de validaçao da URL
        $patternRoute = '/^'.str_replace('/', '\/', $route).'$/';  
        //adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;
    }
    //responsavel por definir uma rota de GET
    //string($route)
    //array($params)
    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);
    }
    //responsavel por definir uma rota de POST
    //string($route)
    //array($params)
    public function post($route, $params = []){
        return $this->addRoute('POST', $route, $params);
    }
    //responsavel por definir uma rota de PUT
    //string($route)
    //array($params)
    public function put($route, $params = []){
        return $this->addRoute('PUT', $route, $params);
    }
    //responsavel por definir uma rota de DELETE
    //string($route)
    //array($params)
    public function delete($route, $params = []){
        return $this->addRoute('DELETE', $route, $params);
    }
    //responsavel por retornar a URI desconsiderando o prefixo
    //return string
    private function getUri(){
        //URI da Request
        $uri = $this->request->getUri();
        //fatia a URI com o prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        //retorna a URI sem prefixo
        return end($xUri);
    }
    //responsavel por retornar os dados da rota atual
    //return array
    private function getRoute(){
        //URI (acho q e para desconsiderar o prefixo)
        $uri = $this->getUri();

        //method
        $httpMethod = $this->request->getHttpMethod();

        //valida as rotas
        foreach($this->routes as $patternRoute=>$methods){
            //verifica se a URI bate o padrao
            if(preg_match($patternRoute, $uri, $matches)){
                //verifica o metodo
                if(isset($methods[$httpMethod])){
                    //remove a primeira posiçao
                    unset($matches[0]);
                    //variaveis processadas
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    //retorno dos parametros da rota
                    return $methods[$httpMethod];
                }
                //metodo nao permitido
                throw new Exception("Metodo nao permitido", 405);
                
            }
        }
        throw new Exception("Url nao encontrada", 404);
    }
    //responsavel por executar a rota atual
    //return Response
    public function run(){
        try{
            //obtem a rota atual
            $route = $this->getRoute();

            //verifica o controlador
            if(!isset($route['controller'])){
                throw new Exception("A URL nao pode ser processada", 500);
            }
            //argumentos da funçao
            $args = [];
            //reflection
            $reflection = new ReflectionFunction($route['controller']);
            foreach($reflection->getParameters() as $parameter){
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }
            //retorna a execuçao da funçao
            return call_user_func_array($route['controller'], $args);
        }catch(Exception $e){
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}