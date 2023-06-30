<?php

namespace App\http;

class Request{
    //metodo http da requisiçao
    //string
    private $httpMethod;
    //uri da pagina
    //string
    private $uri;
    //parametros da url ($_GET)
    //array
    private $queryParams = [];
    //variaveis recebidas no POST da pagina ($_POST)
    //array
    private $postVars = [];
    //cabeçalho da requisiçao
    //array
    private $headers = [];
    //construtor da classe
    public function __construct(){
        $this->queryParams = $_GET  ?? [];
        $this->postVars = $_GET  ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }
    //responsavel por retornar o metodo http da requisiçao 
    //return string
    public function getHttpMethod(){
        return $this->httpMethod;
    }
    //responsavel por retornar a URI da requisiçao 
    //return string
    public function getUri(){
        return $this->uri;
    }
    //responsavel por retornar os headers da requisiçao 
    //return array
    public function getHeaders(){
        return $this->headers;
    }
    //responsavel por retornar os parametros da URL da requisiçao 
    //return array
    public function getQueryParams(){
        return $this->queryParams;
    }
    //responsavel por retornar as variaveis POST da requisiçao 
    //return array
    public function getPostVars(){
        return $this->postVars;
    }

}