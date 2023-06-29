<?php

namespace App\controller\pages;

use App\utils\View;

class Page{

    private static function getHeader(){
        return View::render('pages/header');
    }

    private static function getFooter(){
        return View::render('pages/footer');
    }

    //retorna o conteudo (view) da nossa pagina
    //return string
    public static function getPage($title, $content){
        return View::render('pages/page', [
            'title' => $title,
            'content' => $content,
            'header' => self::getHeader(),
            'footer' => self::getFooter()
        ]);
    }

}