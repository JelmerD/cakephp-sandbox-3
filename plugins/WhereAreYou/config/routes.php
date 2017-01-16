<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::plugin('WhereAreYou', ['path' => '/way'], function (RouteBuilder $routes) {
    $routes->connect('/:hash', ['plugin' => 'WhereAreYou', 'controller' => 'Way', 'action' => 'index']);
    $routes->connect('/', ['plugin' => 'WhereAreYou', 'controller' => 'Way', 'action' => 'index']);
    $routes->connect('/data/:hash', ['plugin' => 'WhereAreYou', 'controller' => 'Way', 'action' => 'data']);
    $routes->fallbacks(DashedRoute::class);
});