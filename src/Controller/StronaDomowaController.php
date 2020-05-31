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

class StronaDomowaController extends AbstractController
{

    /**
     * @Route("/home", name="strona_domowa")
     */
    public function index(EntityManagerInterface $em, Request $request, QuestionController $qc)
    {
       
        $questionForm = $this->createForm(QuestionType::class);
        $register = $this->createForm(RegistrationFormType::class);
        
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            $qc->newQuestion($em,$request);
            return $this->redirectToRoute('strona_domowa');
        }

        
        return $this->render('strona_domowa/index.html.twig', [
            'controller_name' => 'StronaDomowaController',
            'questionForm' => $questionForm->createView(),
            'registrationForm' => $register->createView(),

        ]);
    }
    
}
