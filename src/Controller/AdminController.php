<?php

namespace App\Controller;

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

}
