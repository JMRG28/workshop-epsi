<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
            return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            
        ]);
    }

    #[Route('/tests', name: 'PageTest')]
    public function PageTest(): Response
    {
            return $this->render('main/pageTest.html.twig', [
            'controller_name' => 'MainController',
            
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
