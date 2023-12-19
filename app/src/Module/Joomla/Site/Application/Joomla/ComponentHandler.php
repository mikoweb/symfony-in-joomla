<?php

namespace App\Module\Joomla\Site\Application\Joomla;

use App\Module\Joomla\Site\Application\Routing\SiteRoutingLoader;
use Symfony\Component\HttpFoundation\Response;

final readonly class ComponentHandler
{
    public function __construct(
        private SiteRoutingLoader $siteRoutingLoader
    ) {}

    public function handle(): Response
    {
        return $this->siteRoutingLoader->handleRequest();
    }
}
