<?php

namespace App\Module\Site\Application\Joomla;

use App\Module\Site\Application\Routing\SiteRoutingLoader;
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
