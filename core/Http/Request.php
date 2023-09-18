<?php

namespace Core\Http;

class Request
{
    /** @var string uri */
    private string $uri;

    /** @var array parameters */
    private array $parameters;

    /**
     * Constructor
     *
     * @param string $uri
     * @param array $parameters
     */
    public function __construct(string $uri, array $parameters = [])
    {
        $this->uri = $uri;
        $this->parameters = $parameters;
    }

    /**
     * Get Uri
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Get Parameters Array
     *
     * @param string $name
     * @return mixed
     */
    public function getParameter(string $name): mixed
    {
        return $this->parameters[$name] ?? null;
    }

    /**
     * Get the value of a request parameter.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name): mixed
    {
        return $this->getParameter($name);
    }
}
