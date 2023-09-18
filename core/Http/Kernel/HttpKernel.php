<?php

namespace Core\Http\Kernel;

use Core\Http\Request;
use Core\Http\Response;

class HttpKernel
{

    /**
     * Handle
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $routes = include __DIR__ . '/../../../app/Routes/routes.php';

        foreach ($routes as $route) {
            if ($route->match($request->getUri())) {
                if (!empty($route->middlewares)) {
                    $request = $this->callMiddleware($route->middlewares, $request);
                }
                return $route->call($request);
            }
        }

        return new Response(404, 'Not Found');
    }

    /**
     * Call Middlewire
     *
     * @param array $middlewares
     * @param Request $request
     * @return Response
     */
    public function callMiddleware(array $middlewares, Request $request): Response
    {
        foreach ($middlewares as $middleware) {
            $response = $middleware->handle($request);

            if ($response->isFinal()) {
                return $response;
            }
        }
    }
}
