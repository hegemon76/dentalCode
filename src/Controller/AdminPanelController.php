<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(DoctorType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctor = $form->getData();

            $em->persist($doctor);
            $em->flush();

            return $this->redirectToRoute('Panel Administracyjny');
        }

        return $this->render('admin-panel/add_doctor.html.twig', [
            'controller_name' => 'AdminPanelController',
            'addDoctorForm' => $form->createView(),

        ]);
    }
}
?>