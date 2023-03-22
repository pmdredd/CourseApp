<?php

namespace App\Controller;

use App\Entity\CourseWork;
use App\Form\CourseWorkType;
use App\Repository\CourseWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coursework')]
class CourseWorkController extends AbstractController
{
    #[Route('/', name: 'app_course_work_index', methods: ['GET'])]
    public function index(CourseWorkRepository $courseWorkRepository): Response
    {
        return $this->render('course_work/index.html.twig', [
            'course_works' => $courseWorkRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_course_work_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CourseWorkRepository $courseWorkRepository): Response
    {
        $courseWork = new CourseWork();
        $form = $this->createForm(CourseWorkType::class, $courseWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courseWorkRepository->save($courseWork, true);

            return $this->redirectToRoute('app_course_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('course_work/new.html.twig', [
            'course_work' => $courseWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_course_work_show', methods: ['GET'])]
    public function show(CourseWork $courseWork): Response
    {
        return $this->render('course_work/show.html.twig', [
            'course_work' => $courseWork,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_course_work_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CourseWork $courseWork, CourseWorkRepository $courseWorkRepository): Response
    {
        $form = $this->createForm(CourseWorkType::class, $courseWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courseWorkRepository->save($courseWork, true);

            return $this->redirectToRoute('app_course_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('course_work/edit.html.twig', [
            'course_work' => $courseWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_course_work_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        CourseWork $courseWork,
        CourseWorkRepository $courseWorkRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $courseWork->getId(), $request->request->get('_token'))) {
            $courseWorkRepository->remove($courseWork, true);
        }

        return $this->redirectToRoute('app_course_work_index', [], Response::HTTP_SEE_OTHER);
    }
}
