<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $om = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(InscriptionType::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $hasher->hashPassword($user,$user->getPassword());
            $user->setPassword($hashedPassword);
            $om->persist($user);
            $om->flush();
            $this->addFlash('success','Inscription réussie');
            return $this->redirectToRoute('login');

        }

        return $this->render('security/inscription.html.twig', [
            'controller_name' => 'AuthController',
            'form' => $form->createView()
        ]);
    }
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $util,Request $request): Response
    {
        session_start();
        return $this->render('security/login.html.twig', [
            'controller_name' => 'AuthController',
            'lastUsername' => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }

    #[Route('/logout', name: 'deconnexion')]
    public function logout()
    {

    }
}
