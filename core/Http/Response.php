<?php

namespace Core\Http;

class Response
{
    private ?int $statusCode;
    private mixed $content;
    private array $headers;
    private bool $isFinal = false;



    /**
     * Constructor
     *
     * @param integer|null $statusCode
     * @param mixed $content
     */
    public function __construct(?int $statusCode, mixed $content = null)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    /**
     * Get Status Code
     *
     * @return integer
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Set Header
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setHeader(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    /**
     * Set Status Code
     *
     * @param integer $statusCode
     * @return void
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Get Content
     *
     * @return mixed
     */
    public function getContent(): mixed
    {
        return $this->content;
    }

    /**
     * Set Content 
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Set Headers
     *
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * Get Headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Is Final
     *
     * @return boolean
     */
    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    /**
     * Set Final
     *
     * @return void
     */
    public function setFinal(): void
    {
        $this->isFinal = true;
    }

    /**
     * Handle
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        return $this;
    }
}
