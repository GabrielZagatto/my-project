<?php

namespace App\model\entity;

use WilliamCosta\DatabaseManager\Database;

class User{

    //id do usuario
    //int
    public $id;

    //nome do usuario
    //string
    public $nome;

    //email do usuario
    //string
    public $email;

    //senha do usuario
    //string
    public $senha;

    //responsavel por retornar um usuario com base em seu email
    //string $email
    //return User
    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

}