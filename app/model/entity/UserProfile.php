<?php

namespace App\model\entity;

use WilliamCosta\DatabaseManager\Database;

class Register{
    //id do usuario
    //int
    public $id;
    //imagem do usuario
    //imagem
    public $imagem;

    public function cadastrar(){

        //insere o usuario no banco de dados
        $this->id = (new Database('imagem_perfil'))->insert([
            'imagem' => $this->imagem
        ]);

        //deu bom
        return true;
    }
}