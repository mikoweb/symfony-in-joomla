<?php

namespace App\Module\Joomla\Site\Application\Twig\Extension;

use App\Module\Joomla\Site\Application\Routing\SiteRouter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class SiteRouteExtension extends AbstractExtension
{
    public function __construct(
        private readonly SiteRouter $siteRouter,
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('site_route', [$this, 'getSiteRoute']),
        ];
    }

    public function getSiteRoute(
        string $name,
        array $parameters = [],
        int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH
    ): string
    {
        return $this->siteRouter->generate($name, $parameters, $referenceType);
    }
}
