<?php

namespace App\session\admin;

class Login{

    //responsavel por iniciar a sessao
    private static function init(){
        //verifica se a sessao nao esta ativa
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    //responsavel por criar o login do usuario
    //User $obUSer
    //return  boolean
    public static function login($obUser){
        //inicia a sessao
        self::init();

        //define a sessao do usuario
        $_SESSION['admin']['usuario'] = [
            'id' => $obUser->id,
            'nome' => $obUser->nome,
            'email' => $obUser->email
        ];

        //sucesso
        return true;
    }

    //responsavel por verifica se o usuario esta logado
    //return boolean
    public static function isLogged(){
        //inicia a sessao
        self::init();

        //retorna a verificaçao
        return isset($_SESSION['admin']['usuario']['id']);
    }

    //responsavel por executar o logout do usuario
    //return boolean
    public static function logout(){
        //inicia a sessao
        self::init();

        //desloga o usuario
        unset($_SESSION['admin']['usuario']);

        //sucesso
        return true;
    }

}