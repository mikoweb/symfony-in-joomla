<?php

defined('_JEXEC') or die;

use App\Container;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

final class PlgSystemApp extends JPlugin
{
    private readonly CMSApplication $app;
    private readonly ContainerInterface $container;

    public function __construct(&$subject, $config = [])
    {
        parent::__construct($subject, $config);
        $this->app = Factory::getApplication();
    }

    public function onAfterInitialise(): void
    {
        $this->initApp();
        $this->container = Container::get()->getContainer();
        $this->container->get('bootstrap')->bootstrap();
        $this->handleSiteRouting();
    }

    private function initApp(): void
    {
        require_once __DIR__ . '/../../../app/app.php';
        Container::setParams($this->params);
    }

    private function isSite(): bool
    {
        return $this->app->isClient('site');
    }

    private function handleSiteRouting(): void
    {
        if ($this->isSiteRoute()) {
            $uri = Uri::getInstance();
            $uri->parse($uri->getScheme() . '://' . $uri->getHost() . '/index.php?option=com_app');
        }
    }

    private function isSiteRoute(): bool
    {
        if ($this->isSite()) {
            $routingLoader = $this->container->get('site')->routingLoader;
            $request = $routingLoader->getRequest();
            $urlMatcher = $routingLoader->getMatcher();

            try {
                $matches = $urlMatcher->match($request->getPathInfo());

                return !empty($matches);
            } catch (ResourceNotFoundException $exception) {}
        }

        return false;
    }
}
