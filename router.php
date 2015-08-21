<?php

use Symfony\Component\HttpFoundation\Request;
use League\Route\Strategy\RestfulStrategy;
use Jehaby\Kindle\Controllers\ApiController;


$router->setStrategy(new RestfulStrategy());


$router->addRoute('GET', '/', 'Jehaby\Kindle\Controllers\ApiController::index');


$router->addRoute('GET', '/test42', function (Request $request) {

    $c = new ApiController();
    return $c->index($request);
    return ['test'];
});


$dispatcher = $router->getDispatcher();
$request = $container->get('Symfony\Component\HttpFoundation\Request');

$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
$response->send();
