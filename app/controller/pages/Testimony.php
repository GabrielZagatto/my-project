<?php

namespace App\controller\pages;

use App\utils\View;
use App\model\entity\Testimony as EntityTestimony;
use WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Page{

    //responsavel por obter a renderizaçao dos itens de depoimento da pagina
    //param request $request
    //param pagination $obpagination
    //return string
    public static function getTestimonyItems($request, &$obPagination){

        //depoimentos
        $itens = '';

        //quantidade total de registros
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
        
        //pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;
        
        //instancia de paginaçao
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 3);

        //resultados da pagina
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        //renderiza o item
        while($obTestimony = $results->fetchObject(EntityTestimony::class)){
            $itens .= View::render('pages/testimony/item', [
                'nome' => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem,
                'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
            ]);
        }

        //retorna os depoimentos
        return $itens;
    }

    //metodo responsavel por retornar o conteudo view de depoimentos
    //param de request
    //return string
    public static function getTestimonies($request){
        
        //view de depoimentos
        $content = View::render('pages/testimonies', [
            'itens' => self::getTestimonyItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);
        //retorna a view da pagina
        return parent::getPage('testimonies-work-project', $content);
    }

    //responsavel por cadastrar um depoimento
    //intancia de request
    //return string
    public static function insertTestimony($request){
        //dados do POST
        $postVars = $request->getPostVars();

        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();
        /** AQUI PODERIAMOS FAZER UMA VALIDAÇAO PARA VER SE OS DADOS REALMENTE CHEGARAM ^^^*/
        //retorna a pagina de listagem de depoimentos
        return self::getTestimonies($request);
    }

}