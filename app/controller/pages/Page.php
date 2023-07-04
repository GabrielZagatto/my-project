<?php

namespace App\controller\pages;

use App\utils\View;

class Page{

    private static function getHeader(){
        return View::render('pages/header');
    }

    private static function getFooter(){
        return View::render('pages/footer');
    }

    //responsavel por renderizar o layout de paginaçao
    //param request $request
    //param pagination $obpagination
    //return string
    public static function getPagination($request, $obPagination){

        //paginas
        $pages = $obPagination->getPages();
        
        //verifica a quantidade de paginas
        if(count($pages) <= 1) return '';

        //links
        $links = '';

        //URL atual (sem GETS)
        $url = $request->getRouter()->getCurrentUrl();

        //GET
        $queryParams = $request->getQueryParams();

        //renderiza os links
        foreach($pages as $page){
            //altera a pagina
            $queryParams['page'] = $page['page'];

            //link
            $link = $url.'?'.http_build_query($queryParams);

            //view
            $links .= View::render('pages/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }
        //renderiza  box de paginaçao
        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }

    //retorna o conteudo (view) da nossa pagina
    //return string
    public static function getPage($title, $content){
        return View::render('pages/page', [
            'title' => $title,
            'content' => $content,
            'header' => self::getHeader(),
            'footer' => self::getFooter()
        ]);
    }

}