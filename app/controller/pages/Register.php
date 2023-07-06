<?php

namespace App\controller\pages;

use App\model\entity\Register as RegisterModel;
use App\controller\pages\Testimony;

use App\utils\View;

class Register extends Page{

    public static function getRegister($request){
        
        //view de cadastro
        $content = View::render('pages/cadastro', []);
        //retorna a view da pagina
        return parent::getPage('cadastro-work-project', $content);
    }

    //responsavel por cadastrar um usuario
    //intancia de request
    //return string
    public static function insertRegister($request){
        //dados do POST
        $postVars = $request->getPostVars();

        $obRegister = new RegisterModel;
        $obRegister->nome = $postVars['nome'];
        $obRegister->email = $postVars['email'];
        $obRegister->senha = self::EscondeSenha($postVars['senha']);
        $obRegister->cadastrar();
        /** AQUI PODERIAMOS FAZER UMA VALIDAÇAO PARA VER SE OS DADOS REALMENTE CHEGARAM ^^^*/
        //retorna a pagina de listagem de depoimentos
        return Testimony::getTestimonies($request);
    }

    //criptografa a senha
    private function EscondeSenha($senha){
        return password_hash($senha, PASSWORD_BCRYPT);
    }
}