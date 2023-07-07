<?php

namespace App\controller\pages;

use App\utils\View;
use App\session\admin\Login;
use App\model\entity\User;
use App\model\entity\UserProfile;

class Profile extends Page{

    //responsavel por retornar o conteudo da view de profile
    //Request $request
    public static function getProfile($request){

        Login::sessaoforcada();

        //view do perfil
        $content = View::render('pages/profile', [
            "nome" => $_SESSION['admin']['usuario']['nome'],
            "email" => $_SESSION['admin']['usuario']['email'],
            "senha" => "*****"
        ]);

        //retorna a view da pagina
        return parent::getPage('seu-perfil-work-project', $content);
    }

    public static function insertImageProfile($request){
        //dados do POST
        $postVars = $request->getPostVars();

        $obUser = new User;

    }

}