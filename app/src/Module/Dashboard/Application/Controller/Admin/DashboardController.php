<?php

namespace App\Module\Dashboard\Application\Controller\Admin;

use App\Module\Joomla\Admin\Application\Controller\AbstractAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class DashboardController extends AbstractAdminController
{
    public function getDashboard(Request $request): Response
    {
        return $this->render('admin/dashboard/dashboard.html.twig');
    }
}
