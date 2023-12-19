<?php

namespace App\Module\Joomla\Admin\Application\Component;

use App\Module\Joomla\Admin\Application\Joomla\ComponentHandler;
use App\Module\Joomla\Admin\Domain\Constant\MainComponentConstant;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

final class MainComponent
{
    private const string NAME = MainComponentConstant::NAME;

    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly ComponentHandler $componentHandler
    ) {}

    public function display(): Response
    {
        ToolbarHelper::title($this->translator->trans('admin.main_component_name'));

        if ($this->canDo('core.admin') || $this->canDo('core.options')) {
            ToolbarHelper::preferences(self::NAME);
        }

        return $this->componentHandler->handle();
    }

    public function canDo(string $action): bool
    {
        return $this->componentHandler->canDo(self::NAME, $action);
    }
}
