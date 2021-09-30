<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Entity\Cour;
use App\Form\AlimentType;
use App\Form\CoursType;
use App\Repository\CourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\EditUserType;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
 * @Route("admin/utilisateurs", name="utilisateurs")
 */
public function usersList(UserRepository $users)
{
    return $this->render('admin/index.html.twig', [
        'users' => $users->findAll(),
    ]);
}
/**
 * @Route("/admin/utilisateurs/modifier/{id}", name="modifier_utilisateur")
 */
public function editUser(User $user, Request $request)
{
    $form = $this->createForm(EditUserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Utilisateur modifié avec succès');
        return $this->redirectToRoute('utilisateurs');
    }
    
    return $this->render('admin/users.html.twig', [
        'userForm' => $form->createView(),
    ]);
}
    #[Route('/admin/cours', name: 'listeCours')]
    public function coursList(CourRepository $cours)
    {
        return $this->render('admin/cours/cours.html.twig', [
            'cours' => $cours->findAll(),
        ]);
    }

    #[Route('/admin/modifierCours/{id}', name: 'modifierCours')]
    public function modifierCours(Request $request,Cour $cours=null)
    {
        $objectManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(CoursType::class,$cours);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $objectManager->persist($cours);
            $objectManager->flush();
            $this->addFlash('success', 'Modification effectuée' );
            return $this->redirectToRoute('listeCours');
        }
        return $this->render('admin/cours/modifEtAjoutCours.html.twig', [
            'controller_name' => 'AdminController',
            'cour' => $cours,
            "form" => $form->createView(),
        ]);
    }
    #[Route('/admin/supprimerCours/{id}', name: 'supressionCours')]
    public function supprimerCours(Cour $cours)
    {
        return $this->render('admin/cours/cours.html.twig', [
            'cours' => $cours,
        ]);
    }

    #[Route('/admin/ajouterCours', name: 'ajouterCours')]
    public function ajouterCours(Request $request,Cour $cours=null)
    {
        $cours = new Cour();
        $objectManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(CoursType::class,$cours);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $objectManager->persist($cours);
            $objectManager->flush();
            $this->addFlash('success', 'Ajout effectuée' );
            return $this->redirectToRoute('listeCours');
        }
        return $this->render('admin/cours/modifEtAjoutCours.html.twig', [
            'controller_name' => 'AdminController',
            'cour' => $cours,
            "form" => $form->createView(),
        ]);
    }





}
