<?php

namespace App\Controller;

use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\QuestionController;
use App\Form\RegistrationFormType;
use App\Repository\DoctorRepository;
use App\Form\VisitType;
use App\Entity\Visit;

class WizytyController extends AbstractController
{

    /**
     * @Route("/wizyty", name="strona_wizyty")
     */
    public function wizyty(EntityManagerInterface $em, Request $request, QuestionController $qc, DoctorRepository $doctors)
    {
       
        $questionForm = $this->createForm(QuestionType::class);
        $register = $this->createForm(RegistrationFormType::class);
        
        $questionForm->handleRequest($request);

        $visitForm = $this->createForm(VisitType::class);
        $visitForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            $qc->newQuestion($em,$request);
            return $this->redirectToRoute('strona_domowa');
        }

        if($visitForm->isSubmitted() && $visitForm->isValid())
        {
            $visit = new Visit();

            $visit = $visitForm->getData();
            
            $em->persist($visit);
            $em->flush();
        }
        
        return $this->render('wizyty/wizyty2.html.twig', [
            'controller_name' => 'WizytyController',
            'questionForm' => $questionForm->createView(),
            'visitForm' => $visitForm->createView(),
            'registrationForm' => $register->createView(),
            'doctors' => $doctors->findAll(),

        ]);
    }
    
}
