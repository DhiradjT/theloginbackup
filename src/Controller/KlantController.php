<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Form\ProfileType;
use App\Entity\Registration;
use App\Entity\Training;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LessonRepository;
use App\Repository\TrainingRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KlantController extends AbstractController
{

    #[Route('/klant', name: 'app_klant')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $lessons = $doctrine->getRepository(Lesson::class)->findAll();
        return $this->render('klant/index.html.twig', [
            'lessons' => $lessons
        ]);
    }

//    #[Route('/activity/{id}', name: 'activity')]
//    public function activities(ManagerRegistry $doctrine, Lesson::class): Response
//    {
//
//
//    }

//    #[Route('/activity/{id}', name: 'activity_details')]
//    public function activityDetails($id): Response
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $lessons = $entityManager->getRepository(Lesson::class)->find($id);
//
//        return $this->render('klant/activities.html.twig', [
//            'lessons' => $lessons,
//        ]);
//    }

//    #[Route('/activity/{id}', name: 'activity_details')]
//    public function activityDetails(ManagerRegistry $doctrine, int $id, TrainingRepository $lessonRepository): Response
//    {
//        $entityManager = $doctrine->getManager();
//
//        $lesson = $lessonRepository->find($id);
//        $lessons = $entityManager->getRepository(Lesson::class)->findAll();
//
//        return $this->render('klant/activities.html.twig', [
//            'lesson' => $lesson,
//            'lessons' => $lessons
//        ]);
//    }

    #[Route('/activity/{id}', name: 'activity_details')]
    public function activityDetails(int $id, LessonRepository $lessonRepository): Response
    {
        $lesson = $lessonRepository->find($id);

        if(!$lesson){
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->render('klant/activities.html.twig', [
            'lesson' => $lesson,
        ]);
    }

    #[Route('/signup/{id}', name: 'signup')]
    public function lessonSignUp(int $id, EntityManagerInterface $entityManager): Response
    {
        // Get the lesson by its ID
        $lesson = $entityManager->getRepository(Lesson::class)->find($id);

        // Update the isSignedUp flag to true
        $lesson->setIsSignedUp(true);

        // Save the changes to the database
        $entityManager->persist($lesson);
        $entityManager->flush();

        // Redirect to a success page or perform any other desired action
        return $this->redirectToRoute('success_page');
    }

    #[Route('/succes', name: 'success_page')]
    public function success()
    {
        return $this->render('klant/success.html.twig');
    }

    #[Route('/leave-activity/{id}', name: 'leave_activity')]
    public function leaveActivity(int $id, EntityManagerInterface $entityManager): Response
    {
        // Get the lesson by its ID
        $lesson = $entityManager->getRepository(Lesson::class)->find($id);

        // Update the isSignedUp flag to false
        $lesson->setIsSignedUp(false);

        // Save the changes to the database
        $entityManager->persist($lesson);
        $entityManager->flush();

        // Redirect to a success page or perform any other desired action
        return $this->redirectToRoute('leave_page');
    }

    #[Route('/leave', name: 'leave_page')]
    public function leave()
    {
        return $this->render('klant/leave.html.twig');
    }



    #[Route('/update-profile', name: 'update_profile')]
    public function updateProfile(Request $request): Response
    {
        // Get the authenticated user
        $user = $this->getUser();

        // Create the form and handle the request
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the updated data
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            // Redirect or show a success message
            return $this->redirectToRoute('update_success_page');
        }

        return $this->render('klant/update_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update-success', name:'update_success_page')]
    public function updateSucces()
    {
        return $this->render('klant/update_success_page.html.twig');
    }





}
