<?php

namespace App\Middlewares;

use Core\Http\Request;
use Core\Http\Response;
use Core\Services\AuthServices;

/**
 * Auth Middleware
 */
class AuthMiddleware
{

    /**
     * Auth Middleware Handle
     *
     * @param Request $request
     * @return void
     */
    public function handle(Request $request)
    {
        $response = new Response(null, null);
        $auth = new AuthServices();
        if ($auth->checkLoggedIn()) {
            echo 'Logged In';
        }

        return $request;
    }
}
