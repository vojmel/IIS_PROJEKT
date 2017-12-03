<?php

use Nette\Application\Routers\Route;
use Nette\Application\Routers\SimpleRouter;
use Nette\Application\Routers\RouteList;

/*
// Load Nette Framework
if (@!include __DIR__ . '/../nette/loader.php') {
    die('Install Nette using `composer update`');
}
*/

// Configure application
$configurator = new Nette\Configurator;

// Enable Nette Debugger for error visualisation & logging

$configurator->setDebugMode(true);

// if selectuji itemy tak nechci nikdy tracy
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($actual_link, 'selecteditems') !== false) {
    $configurator->setDebugMode(false);
}

$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/../config.local.neon');

$container = $configurator->createContainer();


$router = new RouteList;
$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

$container->addService('router', $router);


Nette\Object::extensionMethod('Nette\Forms\Container::addSelectItem', function($form, $name, $label = NULL, $from){
    $form[$name] = new \SelectItemControl($name, $label, $from);
    return $form[$name];
});

return $container;
