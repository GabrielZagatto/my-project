<?php

use App\http\Response;
use App\controller\admin;

//rota admin
$obRouter->get('/admin', [
    function(){
        return new Response(200, 'ADM CARAI');
    }
]);

//rota login
$obRouter->get('/admin/login', [
    function($request){
        return new Response(200, admin\Login::getLogin($request));
    }
]);

//rota admin (POST)
$obRouter->post('/admin/login', [
    function($request){
        return new Response(200, admin\Login::setLogin($request));
    }
]);