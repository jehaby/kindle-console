<?php

require 'vendor/autoload.php';




use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Jehaby\Kindle;


$container = new Container();

$container->add('Request', function () {
    return Request::createFromGlobals();
});

require 'db.php';

$router = new League\Route\RouteCollection($container);

$container->add('database_collection_manager', 'Jehaby\Kindle\DatabaseCollectionManager')
    ->withArgument('Illuminate\Database\Capsule\Manager');

$container->add('api_controller', 'Jehaby\Kindle\Controllers\ApiController')
    ->withArgument('database_collection_manager');

require 'router.php';