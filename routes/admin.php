<?php

use App\http\Response;
use App\controller\admin;

//rota admin
$obRouter->get('/admin', [
    'middlewares' => [
        'required-admin-login'
    ],
    function(){
        return new Response(200, 'ADM CARAI');
    }
]);

//rota login
$obRouter->get('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request){
        return new Response(200, admin\Login::getLogin($request));
    }
]);

//rota admin (POST)
$obRouter->post('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request){
        return new Response(200, admin\Login::setLogin($request));
    }
]);

//rota logout
$obRouter->get('/admin/logout', ['middlewares' => [
    'required-admin-login'
],
    function($request){
        return new Response(200, admin\Login::setLogout($request));
    }
]);