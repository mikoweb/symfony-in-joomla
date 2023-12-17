<?php

namespace App\Module\Admin\Application\Routing;

use Symfony\Component\HttpFoundation\Request;

final class RequestFactory
{
    public function createRequest(): Request
    {
        $request = Request::createFromGlobals();
        $newUri = $request->query->get('task', '/');
        $_SERVER['REQUEST_URI'] = $newUri;
        $newRequest = Request::createFromGlobals();
        $_SERVER['REQUEST_URI'] = $request->getRequestUri();

        parse_str(parse_url($newUri)['query'] ?? '', $newQuery);
        unset($newQuery['option']);
        unset($newQuery['task']);

        foreach ($newQuery as $key => $value) {
            $newRequest->query->set($key, $value);
        }

        return $newRequest;
    }
}
