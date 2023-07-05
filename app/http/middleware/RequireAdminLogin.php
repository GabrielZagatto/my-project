<?php

namespace App\http\middleware;

use App\session\admin\Login as SessionAdminLogin;

class RequireAdminLogin{

    //responsavel por executar o middleware
    //Request $request
    //Closure $next
    //return Response
    public function handle($request, $next){

        //verifica se o usuario esta logado
        if(!SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/admin/login');
        }

        //continua a execuçao
        return $next($request);
    }

}