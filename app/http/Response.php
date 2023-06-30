<?php

namespace App\http;

class Response{
    //codigo do status HTTP
    //integer
    private $httpCode = 200;
    //cabeçalho do response
    //array
    private $headers = [];
    //tipo de conteudo que esta sendo retornado
    //string
    private $contentType = 'text/html';
    //conteudo do response
    //mixed(pode ser uma string/array/etc)
    private $content;
    //responsavel por iniciar a classe e definir os valores
    //integer($httpCode)
    //mixed($content)
    //string($contentType)
    public function __construct($httpCode, $content, $contentType = 'text/html'){
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }
    //responsavel por alterar o contentType do response
    //string
    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }
    //responsavel por adicionar um registro no cabeçalho do response
    //string($key)
    //string($value)
    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }
    //responsavel por enviar os headers para o navegador
    private function sendHeaders(){
        //STATUS
        http_response_code($this->httpCode);
        //ENVIAR HEADERS
        foreach($this->headers as $key=>$value){
            header($key.': '.$value);
        }
    }
    //responsavel por enviar a resposta para o usuario
    public function sendResponse(){
        //envia os headers
        $this->sendHeaders();
        //imprime o conteudo
        switch($this->contentType){
            case 'text/html':
                echo $this->content;
                die;
        }
    }

}