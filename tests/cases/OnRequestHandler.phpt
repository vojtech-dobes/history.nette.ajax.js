<?php

require __DIR__ . '/../bootstrap.php';

Tester\Environment::$checkAssertions = FALSE;


$prophet = new Prophecy\Prophet();
$httpRequest = $prophet->prophesize(Nette\Http\IRequest::class);
$onResponseHandler = $prophet->prophesize(VojtechDobes\NetteAjax\OnResponseHandler::class);
$application = $prophet->prophesize(Nette\Application\Application::class);

$httpRequest->isAjax()->willReturn(TRUE);
$application->getRequests()->willReturn([1, 2]);

$onRequestHandler = new VojtechDobes\NetteAjax\OnRequestHandler($httpRequest->reveal(), $onResponseHandler->reveal());
$onRequestHandler($application->reveal(), $httpRequest->reveal());

$onResponseHandler->markForward()->shouldHaveBeenCalled();
$prophet->checkPredictions();
