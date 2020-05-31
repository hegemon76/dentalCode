<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Question;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\QuestionController;

class KontaktController extends AbstractController
{
    /**
     * @Route("/kontakt", name="strona_kontakt")
     */
    public function kontakt(EntityManagerInterface $em, Request $request, QuestionController $qc)
    {
        $questionForm = $this->createForm(QuestionType::class);

        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            $qc->newQuestion($em,$request);
            return $this->redirectToRoute('strona_domowa');
        }

        

        return $this->render('kontakt/kontakt.html.twig', [
            'controller_name' => 'KontaktController',
            'questionForm' => $questionForm->createView(),
        ]);
    }
}
?>