<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StronaDomowaController extends AbstractController
{
    /**
     * @Route("/", name="strona_domowa")
     */
    public function index()
    {
        return $this->render('strona_domowa/index.html.twig', [
            'controller_name' => 'StronaDomowaController',
        ]);
    }
}
