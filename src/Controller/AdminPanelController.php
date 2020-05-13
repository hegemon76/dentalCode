<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Repository\QuestionRepository;

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
}
?>