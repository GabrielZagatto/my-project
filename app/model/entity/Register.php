<?php

namespace App\model\entity;

use WilliamCosta\DatabaseManager\Database;

class Register{
    //id do usuario
    //int
    public $id;
    //nome do usuario
    //string
    public $nome;
    //email do usuario
    //string
    public $email;
    // senha do usuario
    //string
    public $senha;
    //responsavel por cadastrar a intancia atual no banco de dados
    //return boolean
    public function cadastrar(){

        //insere o usuario no banco de dados
        $this->id = (new Database('usuarios'))->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);

        //deu bom
        return true;
    }
}