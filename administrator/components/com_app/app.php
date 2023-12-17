<?php

defined('_JEXEC') or die;

use App\Container;
use Joomla\CMS\Factory;
use Symfony\Component\HttpFoundation\RedirectResponse;

$container = Container::get()->getContainer();
$response = $container->get('admin')->mainComponent->display();

if ($response instanceof RedirectResponse) {
    $app = Factory::getApplication();
    $app->redirect($response->getTargetUrl());
} else {
    echo $response->getContent();
}
