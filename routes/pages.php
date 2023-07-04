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

//rota depoimentos
$obRouter->get('/depoimentos', [
    function($request){
        return new Response(200, pages\Testimony::getTestimonies($request));
    }
]);

//rota depoimentos (insert)
$obRouter->post('/depoimentos', [
    function($request){
        return new Response(200, pages\Testimony::insertTestimony($request));
    }
]);

/** mataro ela F
 * //rota dinamica
$obRouter->get('/pagina/{idPagina}/{acao}', [
    function($idPagina, $acao){
        return new Response(200,'pagina '.$idPagina.' - '.$acao);
    }
]);
 */