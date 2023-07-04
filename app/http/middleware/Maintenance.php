<?php

namespace App\http\middleware;

use Exception;

class Maintenance{

    //responsavel por executar o middleware
    //Request $request
    //Closure $next
    //return Response
    public function handle($request, $next){

        //verifica o estado de manutençao de uma pagina
        if(getenv('MAINTENANCE') == 'true'){
            throw new \Exception('Pagina em manutençao', 200);
        }

        //executa o proximo nivel do middleware
        return $next($request);
    }

}