<?php

namespace App\model\entity;

use WilliamCosta\DatabaseManager\Database;

class Testimony{
    //id do depoimento
    //int
    public $id;
    //nome do usuario que fez o depoimento
    //string
    public $nome;
    //mensagem do depoimento
    //string
    public $mensagem;
    // data de publicaçao do depoimento
    //string
    public $data;
    //responsavel por cadastrar a intancia atual no banco de dados
    //return boolean
    public function cadastrar(){

        //define a data
        $this->data = date('Y-m-d H:i:s');

        //insere o depoimento no banco de dados
        $this->id = (new Database('depoimentos'))->insert([
            'nome' => $this->nome,
            'mensagem' => $this->mensagem,
            'data' => $this->data
        ]);

        //deu bom
        return true;
    }
}