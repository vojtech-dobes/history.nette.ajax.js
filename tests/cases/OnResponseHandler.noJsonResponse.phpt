<?php

require __DIR__ . '/../bootstrap.php';

Tester\Environment::$checkAssertions = FALSE;


$prophet = new Prophecy\Prophet();
$httpRequest = $prophet->prophesize(Nette\Http\IRequest::class);
$onResponseHandler = $prophet->prophesize(VojtechDobes\NetteAjax\OnResponseHandler::class);
$presenter = $prophet->prophesize(Nette\Application\UI\Presenter::class);
$application = $prophet->prophesize(Nette\Application\Application::class);
$router = $prophet->prophesize(Nette\Application\IRouter::class);
$response = $prophet->prophesize(\Nette\Http\IResponse::class);

$onResponseHandler = new VojtechDobes\NetteAjax\OnResponseHandler($httpRequest->reveal(), $router->reveal());
$onResponseHandler->markForward();
$onResponseHandler($application->reveal(), $response->reveal());

$prophet->checkPredictions();
