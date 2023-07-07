<?php

use App\http\Response;
use App\controller\pages;
use App\controller\admin;

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

//rota cadastro
$obRouter->get('/cadastro', [
    function($request){
        return new Response(200, pages\Register::getRegister($request));
    }
]);

//rota cadastro (insert)
$obRouter->post('/cadastro', [
    function($request){
        return new Response(200, pages\Register::insertRegister($request));
    }
]);

//rota cadastro (insert)
$obRouter->post('/logout', [
    function($request){
        return new Response(200, admin\Login::setLogout($request));
    }
]);

//rota perfil
$obRouter->get('/perfil', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200, pages\Profile::getProfile($request));
    }
]);

//rota perfil (insert)
$obRouter->post('/perfil', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200, pages\Profile::insertImageProfile($request));
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