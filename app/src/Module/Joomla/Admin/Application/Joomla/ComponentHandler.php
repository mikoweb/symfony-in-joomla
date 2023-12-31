<?php

namespace App\Module\Joomla\Admin\Application\Joomla;

use App\Module\Joomla\Admin\Application\Routing\AdminRoutingLoader;
use Joomla\CMS\Helper\ContentHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Twig\Environment;

final readonly class ComponentHandler
{
    public function __construct(
        private AdminRoutingLoader $adminRoutingLoader,
        private Environment $twig,
    ) {}

    public function canDo(string $componentName, string $action): bool
    {
        return (bool) ContentHelper::getActions($componentName)->get($action);
    }

    public function handle(): Response
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
