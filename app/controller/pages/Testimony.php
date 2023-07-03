<?php

namespace App\controller\pages;

use App\utils\View;

class Testimony extends Page{
    //metodo responsavel por retornar o conteudo view de depoimentos
    //return string
    public static function getTestimonies(){
        
        //view de depoimentos
        $content = View::render('pages/testimonies', [

        ]);
        //retorna a view da pagina
        return parent::getPage('testimonies-work-project', $content);
    }

}