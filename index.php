<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controller\Controller;
use App\Controller\test;
// use App\Controller\event;

session_start();
// session_destroy();

//var_dump($_SESSION);

// session_destroy();
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
$app->get('/home', controller::class . ':home');
$app->get('/about', controller::class . ':about');
$app->get('/skills', controller::class . ':skills');
$app->get('/event', controller::class . ':event');
$app->get('/request_path', controller::class . ':request_path');
$app->map(['GET', 'POST'], '/admin', controller::class . ':admin');
$app->map(['GET', 'POST'], '/admin_connexion', controller::class . ':getConnexion');
// $app->post('/connexion_admin', controller::class . ':connexion_admin');
$app->get('/inscription_admin', controller::class . ':inscription_admin');
$app->map(["GET", "POST"], '/deconnexion', controller::class . ':deconnexion');
$app->post('/newPost', controller::class . ':newPost');
$app->get('/blog', controller::class . ':blog');
$app->get('/admin_post_modify', controller::class . ':admin_post_modify');

$app->run();
