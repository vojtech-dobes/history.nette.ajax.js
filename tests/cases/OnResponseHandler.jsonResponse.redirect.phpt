<?php

require __DIR__ . '/../bootstrap.php';

Tester\Environment::$checkAssertions = FALSE;


$prophet = new Prophecy\Prophet();
$httpRequest = $prophet->prophesize(Nette\Http\Request::class);
$onResponseHandler = $prophet->prophesize(VojtechDobes\NetteAjax\OnResponseHandler::class);
$presenter = $prophet->prophesize(Nette\Application\UI\Presenter::class);
$application = $prophet->prophesize(Nette\Application\Application::class);
$router = $prophet->prophesize(Nette\Application\IRouter::class);
$response = $prophet->prophesize(Nette\Application\Responses\JsonResponse::class);
$url = $prophet->prophesize(Nette\Http\UrlScript::class);

$presenter->getParameters()->willReturn([]);
$presenter->link('this', [])->shouldNotBeCalled();
$application->getPresenter()->willReturn($presenter->reveal());
$application->run()->shouldBeCalled();
$response->getPayload()->willReturn((object) ['redirect' => 'Foo:default #fragment']);
$httpRequest->getUrl()->willReturn($url->reveal());
$router->match(\Prophecy\Argument::type(Nette\Http\IRequest::class))->willReturn(TRUE);

$onResponseHandler = new VojtechDobes\NetteAjax\OnResponseHandler($httpRequest->reveal(), $router->reveal());
$onResponseHandler($application->reveal(), $response->reveal());

$prophet->checkPredictions();
