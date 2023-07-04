<?php

namespace App\controller\admin;
use App\utils\View;
use App\model\entity\User;

class Login extends Page{

    //responsavel por retornar a renderizaçao da pagina de login
    //request $reques
    //string $errorMessage
    //return string
    public static function getLogin($request, $errorMessage = null){
        //status
        $status = !is_null($errorMessage) ? View::render('admin/login/status',[
            'mensagem' => $errorMessage
        ]) : '';

        //conteudo da pagina de login
        $content = View::render('admin/login',[
            'status' => $status
        ]);

        //retorna a pagina completa
        return parent::getPage('WORK-PROJECT-LOGIN', $content);
    }

    //responsavel por definir o login do usuario
    //Request $request
    public static function setLogin($request){
        //post vars
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        //busca o usuario pelo email
        $obUser = User::getUserByEmail($email);
        if(!$obUser instanceof User){
            return self::getLogin($request, 'E-mail ou senha incorretos');
        }
    }

}