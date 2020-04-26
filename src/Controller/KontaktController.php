<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KontaktController extends AbstractController
{
    /**
     * @Route("/kontakt", name="strona_kontakt")
     */
    public function kontakt()
    {
        return $this->render('kontakt/kontakt.html.twig', [
            'controller_name' => 'KontaktController',
        ]);
    }
}
?>