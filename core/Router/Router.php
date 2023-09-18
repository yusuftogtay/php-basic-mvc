<?php

namespace Core\Router;

use Core\Base\Controller\BaseController;
use Core\Http\Request;
use Core\Http\Response;

/**
 * Routers Class
 */
class Router
{
    /** @var array $routers */
    private array $routes = [];

    /**
     * Add Route
     *
     * @param string $uri
     * @param BaseController $controller
     * @param string $method
     * @param array $parameters
     * @return void
     */
    public function addRoute(string $uri, BaseController $controller, string $method, array $parameters = []): void
    {
        $this->routes[] = new Route($uri, $controller, $method, $parameters);
    }

    /**
     * Dispatch
     *
     * @param Request $request
     * @return Response
     */
    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->match($request->getUri())) {
                return $route->call($request);
            }
        }

        return new Response(404, 'Not Found');
    }
}
