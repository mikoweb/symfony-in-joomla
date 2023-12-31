<?php

namespace App\Module\Joomla\Admin\Application\Routing;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouterInterface;

final class AdminRouter implements UrlGeneratorInterface
{
    private ?RouterInterface $router = null;
    private ?Request $request = null;

    public function __construct(
        private readonly AdminRoutingLoader $adminRoutingLoader
    ) {}

    public function generate(string $name, array $parameters = [], int $referenceType = self::ABSOLUTE_PATH): string
    {
        $option = $parameters['option'] ?? $this->getRequest()->query->get('option', '');
        $query = $this->getRequest()->query->all();
        $query['option'] = $option;
        unset($parameters['option']);
        $query['task'] = $this->getRouter()->generate($name, $parameters, $referenceType);

        return $this->getRequest()->getBaseUrl() . '?' . urldecode(http_build_query($query));
    }

    public function generateAdminLink(array $queryParams = []): string
    {
        $inputBag = $this->getRequest()->query;
        $query = array_merge([
            'option' => $inputBag->get('option'),
            'task' => $inputBag->get('task'),
        ], $queryParams);

        return $this->getRequest()->getBaseUrl() . '?' . urldecode(http_build_query($query));
    }

    public function setContext(RequestContext $context): void
    {
        $this->getRouter()->setContext($context);
    }

    public function getContext(): RequestContext
    {
        return $this->getRouter()->getContext();
    }

    private function getRouter(): RouterInterface
    {
        if (is_null($this->router)) {
            $this->router = $this->adminRoutingLoader->load();
        }

        return $this->router;
    }

    private function getRequest(): Request
    {
        if (is_null($this->request)) {
            $this->request = Request::createFromGlobals();
        }

        return $this->request;
    }
}
