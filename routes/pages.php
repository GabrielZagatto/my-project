<?php

use App\http\Response;
use App\controller\pages;

//rota home
$obRouter->get('/', [
    function(){
        return new Response(200, pages\Home::getHome());
    }
]);

//rota sobre
$obRouter->get('/sobre', [
    function(){
        return new Response(200, pages\About::getAbout());
    }
]);

//rota dinamica
$obRouter->get('/pagina/{idPagina}/{acao}', [
    function($idPagina, $acao){
        return new Response(200,'pagina '.$idPagina.' - '.$acao);
    }
]);