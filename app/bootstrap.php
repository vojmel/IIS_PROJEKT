<?php

use Nette\Application\Routers\Route;
use Nette\Application\Routers\SimpleRouter;
use Nette\Application\Routers\RouteList;


// Load Nette Framework
if (@!include __DIR__ . '/../nette/loader.php') {
	die('Install Nette using `composer update`');
}

// Configure application
$configurator = new Nette\Configurator;

// Enable Nette Debugger for error visualisation & logging
$configurator->setDebugMode(TRUE);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config.neon');
$container = $configurator->createContainer();


$router = new RouteList;
$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

$container->addService('router', $router);

return $container;
