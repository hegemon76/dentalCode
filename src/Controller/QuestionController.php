<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Routing\Annotation\Route;


class QuestionController extends AbstractController
{
    /**
     * @Route("/questions_index", name="questions", methods={"GET"})
     */
    public function index(QuestionRepository $questionsRepository): Response{
    
        return $this->render('question/index.html.twig', [
            'questions' => $questionsRepository->findAll(),
        ]);
    }


    /**
     * @Route("/question/{id}", name="question_show", methods={"GET"})
     */
    public function show(Question $question): Response{
        return $this->render('question/show.html.twig',[
        'question' => $question,
        ]);
    }

    public function new(EntityManagerInterface $em, Request $request)
    {
        $question = new Question();

        $questionForm = $this->createForm(QuestionType::class);
        $questionForm->handleRequest($request);

            $question = $questionForm->getData();

            $em->persist($question);
            $em->flush();
            $this->addFlash('success','Udalo sie');
    }

     /**
     * @Route("/question/{id}", name="question_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Question $question): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_panel');
    }
}
