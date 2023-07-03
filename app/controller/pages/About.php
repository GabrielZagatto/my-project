<?php

namespace App\controller\pages;

use App\utils\View;
use App\model\entity\Organization;

class About extends Page{
    //metodo responsavel por retornar o conteudo view da nossa pagina de sobre
    //return string
    public static function getAbout(){
        $obOrganization = new Organization;
        
        //view da home
        $content = View::render('pages/about', [
            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
            'email' => $obOrganization->email
        ]);
        //retorna a view da pagina
        return parent::getPage('sobre-work-project', $content);
    }

}