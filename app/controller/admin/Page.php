<?php

namespace App\controller\admin;

use App\utils\View;

class Page{

    //responsavel por retornar o conteudo (view) da estrutura generica de pagina do painel
    //string $tittle
    //string $content
    //return string
    public static function getPage($tittle, $content){
        return View::render('admin/page', [ 
            'title' => $tittle,
            'content' => $content
        ]);
    }

}