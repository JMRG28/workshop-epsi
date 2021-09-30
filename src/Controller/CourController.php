<?php

namespace App\Controller;

use App\Repository\CourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourController extends AbstractController
{
    #[Route('/cour', name: 'cour')]
    public function index(CourRepository $repository): Response
    {
        $cours = $repository->findAll();
        return $this->render('cour/index.html.twig', [
            'controller_name' => 'CourController',
            'cours'=>$cours,
        ]);
    }
}
