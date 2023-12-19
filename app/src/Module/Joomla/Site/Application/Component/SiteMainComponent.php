<?php

namespace App\Module\Joomla\Site\Application\Component;

use App\Module\Joomla\Site\Application\Joomla\ComponentHandler;
use Symfony\Component\HttpFoundation\Response;

final readonly class SiteMainComponent
{
    public function __construct(
        private ComponentHandler $componentHandler
    ) {}

    public function display(): Response
    {
        return $this->componentHandler->handle();
    }
}
