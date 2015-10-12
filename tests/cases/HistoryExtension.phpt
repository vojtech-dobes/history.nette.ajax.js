<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;


$configurator = new Nette\Configurator();
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->addConfig(__DIR__ . '/../data/config.neon');
$container = $configurator->createContainer();
Assert::type(VojtechDobes\NetteAjax\OnRequestHandler::class, $container->getByType(VojtechDobes\NetteAjax\OnRequestHandler::class));
Assert::type(VojtechDobes\NetteAjax\OnResponseHandler::class, $container->getByType(VojtechDobes\NetteAjax\OnResponseHandler::class));
