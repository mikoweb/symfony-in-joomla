<?php

namespace App\Module\Service;

use App\Module\Site\Application\Routing\SiteRoutingLoader;

final readonly class SiteService
{
    public function __construct(
        public SiteRoutingLoader $routingLoader
    ) {}
}