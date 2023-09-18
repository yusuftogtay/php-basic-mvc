<?php

namespace Core\Template;

/**
 * Template Engine Class
 */
class Template
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * Constructor.
     * @param string $path
     * @param array $parameters
     */
    public function __construct(string $path, array $parameters = [])
    {
        $this->path = rtrim($path, '/') . '/';
        $this->parameters = $parameters;
    }

    /**
     * @param string $view
     * @param array $context
     * @return string
     * @throws \Exception
     */
    public function render(string $view, array $context = []): string
    {
        return $this->load($view, array_merge($context, ['template' => $this]));
    }

    private function load(string $view, array $context): string
    {

        if (!file_exists($file = $this->path . $view)) {
            throw new \Exception(sprintf('The file %s could not be found.', $file));
        }

        extract($context);

        ob_start();

        include($file);

        return ob_get_clean();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->parameters[$key] ?? null;
    }
}
