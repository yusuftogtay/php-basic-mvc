<?php

namespace Core\Base\Controller;

use Core\Http\Response;
use Core\Template\Template;

/**
 * Controller Interface
 */
abstract class BaseController
{

    /**
     * Index
     *
     * @return Response
     */
    public abstract function index(): Response;

    /**
     * Create View 
     *
     * @param string $path
     * @param array $params
     * @return Response
     */
    public function view(string $path, array $params = null): Response
    {
        $view = new Template(__DIR__ . '/../../../App/View');
        $renderedView = $view->render($path, $params);
        return new Response(200, $renderedView);
    }
}
