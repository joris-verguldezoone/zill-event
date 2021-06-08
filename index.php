<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controller\Controller;
use App\Controller\test;


session_start();
// var_dump($_SESSION);
spl_autoload_register(function ($className) {
    $className = str_replace('App', 'src', $className);
    $filePath =  str_replace('\\', '/', $className) . '.php';
    if (file_exists($filePath)) {
        require($filePath);
    }
});

$app = AppFactory::create();

define('BASE_PATH', rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/'));
define('HTTP_HOST', $_SERVER["HTTP_HOST"]);
$app->setBasePath(BASE_PATH);

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/', controller::class . ':home');
$app->get('/about', controller::class . ':about');

$app->run();
