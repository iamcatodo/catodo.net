<?php
use Zend\Stratigility\MiddlewarePipe;
use Zend\Diactoros\Server;
use League\Plates\Extension\URI as PlatesUri;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

$app    = new MiddlewarePipe();
$server = Server::createServer($app, $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$routes = require 'config/routes.php';

// Routing system
$app->pipe('/', function ($req, $res, $next) use ($routes) {
    $path     = $req->getUri()->getPath();
    $template = new League\Plates\Engine(__DIR__ . '/../views');
    $template->loadExtension(new PlatesUri($req->getUri()->getPath()));

    // 404 error
    if (!in_array($path, array_keys($routes))) {
        return $res->withStatus('404')->end($template->render('404'));
    }

    $route = new $routes[$path]($template);
    return $res->end($route($req, $res, $next));
});

$server->listen();
