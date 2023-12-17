<?php

namespace App\Module\Admin\Application\Joomla;

use App\Module\Admin\Application\Routing\AdminRoutingLoader;
use Joomla\CMS\Helper\ContentHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Twig\Environment;

final class ComponentHandler
{
    public function __construct(
        private readonly AdminRoutingLoader $adminRoutingLoader,
        private readonly Environment $twig,
    ) {}

    public function canDo(string $componentName, string $action): bool
    {
        return (bool) ContentHelper::getActions($componentName)->get($action);
    }

    public function handle(): ?Response
    {
        try {
            $response = $this->adminRoutingLoader->handleRequest();
        } catch (HttpExceptionInterface $exception) {
            $response = new Response($this->twig->render('admin/error.html.twig', [
                'statusCode' => $exception->getStatusCode(),
            ]));
        }

        return $response;
    }
}
