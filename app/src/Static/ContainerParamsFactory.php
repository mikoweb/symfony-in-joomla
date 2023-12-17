<?php

namespace App\Static;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class ContainerParamsFactory
{
    public static function setupFromJoomla(ContainerBuilder $builder, Registry $params): void
    {
        self::setLocale($builder);
    }

    public static function setupFromEnv(ContainerBuilder $builder): void
    {
        $builder->setParameter('twig_debug', ($_ENV['TWIG_DEBUG'] ?? 'false') === 'true');
    }

    private static function setLocale(ContainerBuilder $builder): void
    {
        $locale = Factory::getLanguage()->getTag() ?? 'en-GB';
        $builder->setParameter('locale_full', $locale);
        $builder->setParameter('locale', explode('-', $locale)[0]);
    }
}
