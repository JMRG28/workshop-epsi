<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Reponse;
use App\Form\CreateReponse;
use App\Form\UpdateQuestion;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/questions', name: 'questions')]
    public function index(QuestionRepository $questionRepository, ReponseRepository $reponseRepository): Response
    {
        $questions = $questionRepository->findAll();
        $allReponses = [];

        foreach ($questions as $question){
            $reponses = $reponseRepository->findBy(array('question' => $question->getId()));
            foreach ($reponses as $rep){
                array_push($allReponses, $rep);
            }
        }

        return $this->render('questions/index.html.twig', [
            'controller_name' => 'QuestionsController',
            'questions' => $questions,
            'reponses' => $allReponses
        ]);
    }

    #[Route('/deleteQuestion/{id}', name: 'deleteQuestion')]
    public function deleteQuestion(Question $question): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($question);
        $em->flush();

        return $this->redirectToRoute('questions');
    }

    #[Route('/updateQuestion/{id}', name: 'updateQuestion')]
    public function updateQuestion(Request $request, Question $question): Response
    {
        $form = $this->createForm(UpdateQuestion::class,$question);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($question);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification réussie');
            return $this->redirectToRoute('questions');
        }

        return $this->render('questions/updateQuestion.html.twig', [
            'controller_name' => 'QuestionsController',
            'action' => 'Modification',
            'form' => $form->createView()
        ]);
    }

    #[Route('/createQuestion', name: 'createQuestion')]
    public function createQuestion(Request $request): Response
    {
        $om = $this->getDoctrine()->getManager();
        $question = new Question();
        $form = $this->createForm(UpdateQuestion::class,$question);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $om->persist($question);
            $om->flush();
            $this->addFlash('success','Ajout réussi');
            return $this->redirectToRoute('questions');

        }

        return $this->render('questions/updateQuestion.html.twig', [
            'controller_name' => 'QuestionsController',
            'action' => 'Création',
            'form' => $form->createView()
        ]);
    }

    #[Route('/questionsSearch', name: 'questionsSearch')]
    public function search(QuestionRepository $questionRepository, Request $request): Response
    {
        $questions = $questionRepository->findByCustom($request->request->get('attribut'), $request->request->get('value'));

        return $this->render('questions/index.html.twig', [
            'controller_name' => 'QuestionsController',
            'questions' => $questions,
        ]);
    }

    #[Route('/createReponse/{id}', name: 'createReponse')]
    public function createReponse(Request $request, Question $id): Response
    {
        $om = $this->getDoctrine()->getManager();
        $reponse = new Reponse();
        $reponse->setQuestion($id);
        $form = $this->createForm(CreateReponse::class, $reponse);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($reponse);
            $om->flush();
            $this->addFlash('success', 'Ajout réussi');
            return $this->redirectToRoute('questions');
        }

        return $this->render('questions/createReponse.html.twig', [
            'controller_name' => 'QuestionsController',
            'action' => 'Création',
            'form' => $form->createView()
        ]);
    }

    #[Route('/updateReponse/{id}', name: 'updateReponse')]
    public function updateReponse(Request $request, Reponse $reponse): Response
    {
        $form = $this->createForm(CreateReponse::class,$reponse);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($reponse);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification réussie');
            return $this->redirectToRoute('questions');
        }

        return $this->render('questions/createReponse.html.twig', [
            'controller_name' => 'QuestionsController',
            'action' => 'Modification',
            'form' => $form->createView()
        ]);
    }

    #[Route('/deleteReponse/{id}', name: 'deleteReponse')]
    public function deleteReponse(Reponse $reponse): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($reponse);
        $em->flush();

        return $this->redirectToRoute('questions');
    }
}
