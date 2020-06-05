<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\RegistrationController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Controller\QuestionController;
use App\Form\RegistrationFormType;

class WizytyController extends AbstractController
{

    /**
     * @Route("/wizyty", name="strona_wizyty")
     */
    public function wizyty(EntityManagerInterface $em, Request $request, QuestionController $qc)
    {
       
        $questionForm = $this->createForm(QuestionType::class);
        $register = $this->createForm(RegistrationFormType::class);
        
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            $qc->newQuestion($em,$request);
            return $this->redirectToRoute('strona_domowa');
        }

        
        return $this->render('wizyty/wizyty.html.twig', [
            'controller_name' => 'WizytyController',
            'questionForm' => $questionForm->createView(),
            'registrationForm' => $register->createView(),

        ]);
    }
    
}
