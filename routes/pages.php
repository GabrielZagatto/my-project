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
        return new Response(200, pages\About::getHome());
    }
]);