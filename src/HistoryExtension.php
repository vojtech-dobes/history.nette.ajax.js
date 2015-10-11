<?php

namespace VojtechDobes\NetteAjax;

use Nette\DI;


/**
 * Provides support for History API
 */
class HistoryExtension extends DI\CompilerExtension
{

	public function loadConfiguration()
	{
		$container = $this->getContainerBuilder();

		$container->addDefinition($this->prefix('onRequestHandler'))
			->setClass(OnRequestHandler::class);

		$container->addDefinition($this->prefix('onResponseHandler'))
			->setClass(OnResponseHandler::class);

		$application = $container->getDefinition('application');
		$application->addSetup('$service->onRequest[] = ?', array('@' . $this->prefix('onRequestHandler')));
		$application->addSetup('$service->onResponse[] = ?', array('@' . $this->prefix('onResponseHandler')));
	}

}
