<?php

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

use Core\App\App;

$app = new App();

$app->run();
