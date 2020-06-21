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
use App\Form\RegistrationFormType;
use App\Form\VisitType;
use App\Repository\DoctorRepository;
use App\Repository\VisitRepository;
use PhpParser\Node\Stmt\Foreach_;
use App\Entity\Doctor;
use Doctrine\ORM\Mapping\OrderBy;

class AdminPanelController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_panel")
     */
    public function panel(QuestionRepository $questionsRepository, DoctorRepository $doctors, RegistrationFormType $register, VisitRepository $visit)
    {

        $register = $this->createForm(RegistrationFormType::class);

        return $this->render('admin-panel/admin2.html.twig', [
            'controller_name' => 'AdminPanelController',
            'questions' => $questionsRepository->findAll(),
            'registrationForm' => $register->createView(),
            'doctors' => $doctors->findAll(),
            'visits' => $visit->findAll()
        ]);
    }

    /**
     * @Route("admin/add_doctor", name="dodaj_doktora")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(DoctorType::class);
        $visitForm = $this->createForm(VisitType::class);

        $form->handleRequest($request);
        $visitForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctor = $form->getData();

            $em->persist($doctor);
            $em->flush();

            return $this->redirectToRoute('Panel Administracyjny');
        }

        return $this->render('admin-panel/add_doctor.html.twig', [
            'controller_name' => 'AdminPanelController',
            'addDoctorForm' => $form->createView(),
            'visitForm' => $form->createView(),

        ]);
    }
}
?>