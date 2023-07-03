<?php

namespace App\controller\pages;

use App\utils\View;
use App\model\entity\Testimony as EntityTestimony;

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

    //responsavel por cadastrar um depoimento
    //intancia de request
    //return string
    public static function insertTestimony($request){
        //dados do POST
        $postVars = $request->getPostVars();

        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();
        /** AQUI PODERIAMOS FAZER UMA VALIDAÇAO PARA VER SE OS DADOS REALMENTE CHEGARAM ^^^*/

        echo "<pre>"; print_r($postVars); echo "</pre>"; exit;
        return self::getTestimonies();
    }

}