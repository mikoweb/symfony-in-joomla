<?php

namespace App\Module\Service;

use App\Module\Joomla\Site\Application\Component\SiteMainComponent;
use App\Module\Joomla\Site\Application\Routing\SiteRoutingLoader;

final readonly class SiteService
{
    public function __construct(
        public SiteRoutingLoader $routingLoader,
        public SiteMainComponent $siteMainComponent
    ) {}
}
