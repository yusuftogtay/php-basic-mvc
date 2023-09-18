<?php

namespace Core\App;

use Core\Http\Kernel\HttpKernel;
use Core\Http\Request;

/**
 * APP Class
 */
class App
{
    /**
     * App Run.
     *
     * @return void
     */
    public function run()
    {
        $kernel = new HttpKernel();
        $response = $kernel->handle(new Request($_SERVER['REQUEST_URI']));

        echo print_r($response->getContent());
    }
}
