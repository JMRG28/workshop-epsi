<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private function Roulette($nbMax){
        $result = rand(0,$nbMax-1);
        return $result;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
            return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            
        ]);
    }

    #[Route('/tests', name: 'PageTest')]
    public function PageTest(QuestionRepository $repository, $QuestionEnCours=null, $monQuestionnaire=null): Response
    {
        $QuestionsFaciles = $repository->findQuestionFacile();
        $QuestionsNormales = $repository->findQuestionNormale();
        $QuestionsDifficiles = $repository->findQuestionDifficile();
        $monQuestionnaire=array();
        if (isset($QuestionEnCours) ) {
            $question=$monQuestionnaire[0];
            unset($monQuestionnaire[0]);
        }else {
            
            for($i=0;$i<10;$i++){
                if($i<3){
    
                    $Rdm = Roulette(sizeof($QuestionsFaciles));
        
                    $question= $QuestionsFaciles[$Rdm];
                    unset($QuestionsFaciles[$Rdm]);
                    $monQuestionnaire[$i]=$question;
                }elseif ($i>2 && $i<7) {
                    $Rdm = Roulette(sizeof($QuestionsNormales));
        
                    $question= $QuestionsNormales[$Rdm];
                    unset($QuestionsNormales[$Rdm]);
                    $monQuestionnaire[$i]=$question;
                }else {
                    $Rdm = Roulette(sizeof($QuestionsDifficiles));
        
                    $question= $QuestionsDifficiles[$Rdm];
                    unset($QuestionsDifficiles[$Rdm]);
                    $monQuestionnaire[$i]=$question;
                }
            }
        }
            return $this->render('main/pageTest.html.twig', [
            'Question' => $question,
            'Questionnaire' => $monQuestionnaire
            
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
