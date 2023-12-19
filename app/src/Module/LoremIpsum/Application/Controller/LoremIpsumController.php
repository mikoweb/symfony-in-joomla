<?php

namespace App\Module\LoremIpsum\Application\Controller;

use App\Module\Joomla\Site\Application\Controller\AbstractSiteController;
use Joomla\CMS\Document\Document;
use Joomla\CMS\Factory;
use Symfony\Component\HttpFoundation\Response;

final class LoremIpsumController extends AbstractSiteController
{
    public function index(): Response
    {
        /** @var Document $document */
        $document = Factory::getApplication()->getDocument();
        $document->setTitle($document->getTitle() . ' - Lorem Ipsum');

        return $this->render('site/lorem_ipsum.html.twig');
    }
}
