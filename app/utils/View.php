<?php

namespace App\utils;

class View{
    
    //variaveis padroes da view
    //array
    private static $vars = [];
    //responsavel por definir os dados iniciais da classe
    //array($vars)
    public static function init($vars = []){
        self::$vars = $vars;
    }
    //recebe string
    //return string
    //retorna o conteudo de uma view
    private static function getContentView($view){
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        return file_exists($file) ?  file_get_contents($file) : '';
    }
    //recebe string $view e um array $vars(numerico/string)
    //return string
    //retorna o conteudo renderizado de uma view
    public static function render($view, $vars = []){
        //conteudo da view
        $contentView = self::getContentView($view);
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);

        //retorna o conteudo renderizado
        return str_replace($keys, array_values($vars), $contentView);
    }
}