<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use App\Entity\Question;

class MainController extends AbstractController
{
    
    private function Roulette($nbMax){
        $result = rand(0,$nbMax);
        return $result;
    }

    private function InitialiserQuizz($repository){

        $question = new Question;
        $QuestionsFaciles = $repository->findQuestionFacile();
        $QuestionsNormales = $repository->findQuestionNormale();
        $QuestionsDifficiles = $repository->findQuestionDifficile();

        for($i=0;$i<10;$i++){
            if($i<3){

                $Rdm = self::Roulette(sizeof($QuestionsFaciles)-1);
                $question->setEnonce($QuestionsFaciles[$Rdm]->getEnonce());
                array_splice($QuestionsFaciles, $Rdm, 1);
                $monQuestionnaire[$i]=$question->getEnonce();

            }elseif ($i>2 && $i<7) {
                $Rdm = self::Roulette(sizeof($QuestionsNormales)-1);
                $question->setEnonce($QuestionsNormales[$Rdm]->getEnonce());
                array_splice($QuestionsNormales, $Rdm, 1);
                $monQuestionnaire[$i]=$question->getEnonce();

            }else {
                $Rdm = self::Roulette(sizeof($QuestionsDifficiles)-1);
    
                $question->setEnonce($QuestionsDifficiles[$Rdm]->getEnonce());
                array_splice($QuestionsDifficiles, $Rdm, 1);

                $monQuestionnaire[$i]=$question->getEnonce();
                

            }
        }
        return $monQuestionnaire;
    }

    private function ChercherReponses($repository, $question, $reponseRepo){
        $idQuestion = $repository->findIdQuestion($question);
        $idQuestion = $idQuestion[0]->getId();
        $reponses= $reponseRepo->findReponses($idQuestion);
        return $reponses;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
            return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            
        ]);
    }

    #[Route('/tests', name: 'PageTest')]
    public function PageTest(ReponseRepository $reponseRepo, QuestionRepository $repository, $Question=null, $Questionnaire=null, $Choix=null): Response
    {
        

        if (isset($_SESSION['Quizz']) ) {
            if (count($_SESSION['Quizz'])==0) {
                unset($_SESSION['Quizz']);
            }else{
                $monQuestionnaire=$_SESSION['Quizz'];
                $question=$monQuestionnaire[0];
                array_splice($monQuestionnaire, 0, 1);
                $_SESSION['Quizz']=$monQuestionnaire;
            }
        }else {
            $monQuestionnaire = self::InitialiserQuizz($repository);
            $question=$monQuestionnaire[0];
            array_splice($monQuestionnaire, 0, 1);
            $_SESSION['Quizz']=$monQuestionnaire;

            
        }
        if (isset($question)) {
            $reponses = self::ChercherReponses($repository, $question, $reponseRepo);
            for ($i=0; $i < count($reponses); $i++) { 
                $mesReponses[$i]=$reponses[$i]->getReponse();
            }
        }
        else{
            $question = "merci d'avoir participé";
            $mesReponses="";
        }
            return $this->render('main/pageTest.html.twig', [
            'Question' => $question,
            'Reponses'=> $mesReponses
            
        ]);
    }

    #[Route('/resultat', name: 'Resultat')]
    public function Resultats(): Response
    {
            return $this->render('main/resultats.html.twig', [
            'controller_name' => 'MainController',
            
        ]);
    }

    #[Route('/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
