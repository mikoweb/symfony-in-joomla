<?php

defined('_JEXEC') or die;

use App\Container;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Document\Document;
use Joomla\CMS\Factory;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class PlgSystemApp extends JPlugin
{
    private readonly CMSApplication $app;
    private readonly Document $document;
    private readonly ContainerInterface $container;

    public function __construct(&$subject, $config = [])
    {
        parent::__construct($subject, $config);
        $this->app = Factory::getApplication();
        $this->document = Factory::getDocument();
    }

    public function onAfterInitialise(): void
    {
        $this->initApp();
        $this->container = Container::get()->getContainer();
        $this->container->get('bootstrap')->bootstrap();
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
}
