<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPanelController extends AbstractController
{
    /**
     * @Route("/admin-panel", name="Panel Administracyjny")
     */
    public function panel()
    {
        return $this->render('admin-panel/admin-panel.html.twig', [
            'controller_name' => 'AdminPanelController',
        ]);
    }
}
?>