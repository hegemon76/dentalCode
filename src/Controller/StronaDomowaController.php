<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class StronaDomowaController extends AbstractController
{

    /**
     * @Route("/home", name="strona_domowa")
     */
    public function index(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(QuestionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question = $form->getData();

            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('strona_domowa');
        }

        return $this->render('strona_domowa/index.html.twig', [
            'controller_name' => 'StronaDomowaController',
            'questionForm' => $form->createView(),

        ]);
    }

    

    /**
     * @Route("/submit", name="submit")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(QuestionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $question = new Question();
            $question->setName($data['name']);
            $question->setSurname($data['surname']);
            $question->setEmail($data['email']);
            $question->setBody($data['body']);

            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('strona_kontakt');
        }

        return $this->render('strona_domowa/index.html.twig', [
            'questionForm' => $form->createView(),
        ]);
    }
}
