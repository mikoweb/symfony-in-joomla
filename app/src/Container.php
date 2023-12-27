<?php

namespace App;

use App\Static\ContainerParamsFactory;
use Joomla\Registry\Registry;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class Container
{
    private static ?Container $instance = null;
    private static ?Registry $params = null;
    private ?ContainerBuilder $builder = null;
    private ?ContainerInterface $container = null;

    private function __construct() {}
    private function __clone() {}

    public function getContainer(): ContainerInterface
    {
        if (is_null($this->builder)) {
            $containerBuilder = new ContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator(Path::getConfigPath()));
            $loader->load(Path::getConfigPath('services.yaml'));

            $this->builder = $containerBuilder;

            if (!is_null(self::$params)) {
                ContainerParamsFactory::setupFromJoomla($containerBuilder, self::$params);
                ContainerParamsFactory::setupFromEnv($containerBuilder);
            }

            $this->container = $this->builder->get('service_container');
            $this->container->compile();
        }

        return $this->container;
    }

    public function getService(string $id): ?object
    {
        return $this->getContainer()->get($id);
    }

    public function getParameter(string $name): mixed
    {
        return $this->getContainer()->getParameter($name);
    }

    public static function get(): Container
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function setParams(?Registry $params): void
    {
        self::$params = $params;
    }
}
