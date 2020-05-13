<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use App\Form\DoctorType;

class AdminPanelController extends AbstractController
{
    /**
     * @Route("/admin-panel", name="Panel Administracyjny")
     */
    public function panel(QuestionRepository $questionsRepository)
    {
        return $this->render('admin-panel/admin2.html.twig', [
            'controller_name' => 'AdminPanelController',
            'questions' => $questionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin_add_doctor", name="dodaj_doktora")
     */
    public function index(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(DoctorType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question = $form->getData();

            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('Panel Administracyjny');
        }

        return $this->render('admin-panel/add_doctor.html.twig', [
            'controller_name' => 'AdminPanelController',
            'questionForm' => $form->createView(),

        ]);
    }
}
?>