<?php
/**
 * Created by Miguel Pazo <https://miguelpazo.com>.
 */

require __DIR__ . '/vendor/autoload.php';

session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addGroup('/integration_php_example', function (FastRoute\RouteCollector $r) {
        $r->get('/', 'index');
        $r->get('/auth-endpoint', 'endpoint');
        $r->get('/home', 'home');
        $r->get('/logout', 'logout');
    });
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        switch ($handler) {
            case 'index':
                $controller = new \Controllers\IndexController();
                $controller->run($vars);
                break;
            case 'endpoint':
                $controller = new \Controllers\EndpointController();
                $controller->run($vars);
                break;
            case 'home':
                $controller = new \Controllers\HomeController();
                $controller->run($vars);
                break;
            case 'logout':
                $controller = new \Controllers\IndexController();
                $controller->logout();
                break;
        }
        break;
}