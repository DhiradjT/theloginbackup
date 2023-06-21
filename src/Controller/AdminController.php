<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Form\ProfileType;
use App\Form\LessonType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $lessons = $doctrine->getRepository(Lesson::class)->findAll();
        return $this->render('admin/index.html.twig', [
            'lessons' => $lessons
        ]);
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

        return $this->render('admin/update_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/lesson/delete/{id}', name: 'lesson_delete')]
    public function deleteLesson(int $id, EntityManagerInterface $entityManager): RedirectResponse
    {
        $lesson = $entityManager->getRepository(Lesson::class)->find($id);

        if (!$lesson) {
            throw $this->createNotFoundException('Lesson not found.');
        }

        $entityManager->remove($lesson);
        $entityManager->flush();

        // Add a flash message
        $this->addFlash('success', 'Lesson deleted successfully.');

        // Redirect back to the previous page or any desired page
        return $this->redirectToRoute('admin/index.html.twig');
    }

    #[Route('/edit/{id}', name: 'edit_lesson')]
    public function editLesson(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        // Get the lesson by its ID
        $lesson = $entityManager->getRepository(Lesson::class)->find($id);

        // Create the edit form and handle the form submission
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the changes to the database
            $entityManager->flush();

            // Redirect to a success page or perform any other desired action
            return $this->redirectToRoute('edit_success_page');
        }

        // Render the edit form
        return $this->render('admin/edit_lesson.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit_success', name: 'edit_success_page')]
    public function editSucces()
    {
        return $this->render('admin/edit_success_page.html.twig');
    }

    #[Route('/lesson/add', name: 'lesson_add')]
    public function addLesson(Request $request): Response
    {
        $lesson = new Lesson();

        // Create the form and handle the form submission
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the new lesson to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lesson);
            $entityManager->flush();

            // Redirect to a success page or perform any other desired action
            return $this->redirectToRoute('success_page');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
