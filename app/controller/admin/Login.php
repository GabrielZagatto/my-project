<?php

namespace App\controller\admin;
use App\utils\View;
use App\model\entity\User;
use App\session\admin\Login as SessionAdminLogin;
use App\controller\pages\Page as NormalPage;
use App\controller\pages\Register;

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
        return  NormalPage::getPage('WORK-PROJECT-LOGIN', $content);
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

        //verifica a senha do usuario
        if(!password_verify($senha, $obUser->senha)){
            return self::getLogin($request, 'E-mail ou senha incorretos');
        }

        //cria a sessao de login
        SessionAdminLogin::login($obUser);
        
        //redireiona o usuario para a home do admin
        $request->getRouter()->redirect('/depoimentos');
    }

    //responsavel por deslogar o usuario
    //Request $request
    public static function setLogout($request){
         //destroi a sessao de login
         SessionAdminLogin::logout();
        
         //redireiona o usuario para a tela de login
         $request->getRouter()->redirect('/admin/login');
    }

}