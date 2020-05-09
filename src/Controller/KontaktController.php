<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Question;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class KontaktController extends AbstractController
{
    /**
     * @Route("/kontakt", name="strona_kontakt")
     */
    public function kontakt(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(QuestionType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() )
        {
            $question = $form->getData();
            
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('strona_domowa');
        }

        return $this->render('kontakt/kontakt.html.twig', [
            'controller_name' => 'KontaktController',
            'questionForm' => $form->createView(),
        ]);
    }
}
?>