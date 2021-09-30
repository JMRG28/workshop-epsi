<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Entity\User;
use App\Form\AlimentType;
use App\Form\InscriptionType;
use App\Form\UpdatePassword;
use App\Form\UpdateProfil;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/profil', name: 'profil')]
    public function profil(UserInterface $user): Response
    {
        return $this->render('user/profil.html.twig', [
            'controller_name' => 'UserController',
            'profil' => $user,
        ]);
    }

    #[Route('/updateProfil', name: 'updateProfil')]
    public function updateProfil(Request $request, UserInterface $userInt,UserRepository $repository): Response
    {
        $userId = $userInt->getId();
        $user =$repository->find($userId);

        $objectManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(UpdateProfil::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($user);
            $objectManager->flush();
            $this->addFlash('success','Modification réussie');
            return $this->redirectToRoute('profil');

        }

        return $this->render('user/updateProfil.html.twig', [
            'controller_name' => 'AuthController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/updatePassword', name: 'updatePassword')]
    public function updatePassword(Request $request, UserPasswordHasherInterface $hasher, UserInterface $user): Response
    {
        $form = $this->createForm(UpdatePassword::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $hasher->hashPassword($user,$user->getPassword());
            $user->setPassword($hashedPassword);
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification réussie');
            return $this->redirectToRoute('profil');

        }

        return $this->render('user/updatePassword.html.twig', [
            'controller_name' => 'AuthController',
            'form' => $form->createView()
        ]);
    }
}
