<?php

namespace App\Module\Service;

use App\Module\Joomla\Admin\Application\Component\MainComponent;

final readonly class AdminService
{
    public function __construct(
        public MainComponent $mainComponent
    ) {}
}
