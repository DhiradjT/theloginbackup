<?php

namespace App\Controller;

use App\Entity\person;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('default/login.html.twig',[
            'controller_name' => 'LoginController',
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new person();
        $user->setRoles(['ROLE_KLANT']);
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute(route: 'app_default');
        }

        return $this->renderForm('default/register.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('logout', name:'logout')]
    public function logout(): Response
    {
        throw new \Exception;
    }

    #[Route('/redirect', name:'redirect')]
    public function redirectAction(Security $security)
    {
        if($security->isGranted('ROLE_INSTRUCTOR')) {
            return $this->redirectToRoute('app_admin');
        }
        if($security->isGranted('ROLE_KLANT')) {
            return $this->redirectToRoute('app_klant');
        }
        return $this->redirectToRoute('app_default');
    }



}
