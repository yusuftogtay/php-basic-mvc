<?php

namespace Core\Router;

use Core\Http\Request;
use Core\Http\Response;
use Core\Base\Controller\BaseController;

/**
 * Route
 */
class Route
{
    /** @var string $uri */
    private string $uri;

    /** @var BaseController $controller */
    private BaseController $controller;

    /** @var string $method */
    private string $method;

    /** @var array $parameters */
    private array $parameters;

    /** @var array $middlewares */
    private array $middlewares;

    /** @var array $queryParams */
    private array $queryParams;

    /**
     * Constructor
     *
     * @param string $uri
     * @param BaseController $controller
     * @param string $method
     * @param array $middlewares
     * @param array $parameters
     */
    public function __construct(string $uri, BaseController $controller, string $method, array $middlewares = [], array $parameters = [],)
    {
        $this->uri = $uri;
        $this->controller = $controller;
        $this->method = $method;
        $this->parameters = $parameters;
        $this->middlewares = $middlewares;
    }

    /**
     * Match Route
     *
     * @param string $uri
     * @return boolean
     */
    public function match(string $uri): bool
    {
        $parsedUri = $this->parseUri($uri);

        if ($this->uri === $parsedUri['uri']) {
            return true;
        }

        $pattern = preg_replace_callback('/{([^}]+)}/', function ($matches) {
            $paramName = $matches[1];
            $paramPattern = isset($this->parameters[$paramName]) ? $this->parameters[$paramName] : '[^/]+';
            return '(' . $paramPattern . ')';
        }, $this->uri);
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';

        if (preg_match($pattern, $parsedUri['uri'], $matches)) {
            $parameters = [];
            preg_match_all('/{([^}]+)}/', $this->uri, $paramNames);

            foreach ($paramNames[1] as $index => $paramName) {
                if (isset($matches[$index + 1])) {
                    $parameters[$paramName] = $matches[$index + 1];
                } else {
                    $parameters[$paramName] = null;
                }
            }

            $this->parameters = $parameters;
            return true;
        }

        return false;
    }


    /**
     * Call Route
     *
     * @param Request $request
     * @return Response
     */
    public function call(Request $request): Response
    {
        $method = $this->method;

        if (array_key_exists('method', $this->parameters)) {
            $method = $this->parameters['method'];
        }

        $reflection = new \ReflectionMethod($this->controller, $method);
        $args = [];


        foreach ($reflection->getParameters() as $parameter) {
            if (array_key_exists($parameter->name, $this->parameters)) {
                $args[] = $this->parameters[$parameter->name];
            } else {
                $args[] = $request->get($parameter->name);
            }
        }

        return $reflection->invoke($this->controller, ...$args);
    }

    /**
     * Parse Uri
     *
     * @param string $uri
     * @return array
     */
    private function parseUri(string $uri): array
    {
        $parts = parse_url($uri);
        $queryParams = [];

        if (isset($parts['query'])) {
            parse_str($parts['query'], $queryParams);
        }

        return [
            'uri' => $parts['path'],
            'queryParams' => $queryParams,
        ];
    }
}
