<?php

namespace App\Controller;

use App\Entity\Submission;
use App\Form\SubmissionType;
use App\Repository\SubmissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/submission')]
class SubmissionController extends AbstractController
{
    #[Route('/', name: 'app_submission_index', methods: ['GET'])]
    public function index(SubmissionRepository $submissionRepository): Response
    {
        return $this->render('submission/index.html.twig', [
            'submissions' => $submissionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_submission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SubmissionRepository $submissionRepository): Response
    {
        $submission = new Submission();
        $form = $this->createForm(SubmissionType::class, $submission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submissionRepository->save($submission, true);

            return $this->redirectToRoute('app_submission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('submission/new.html.twig', [
            'submission' => $submission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_submission_show', methods: ['GET'])]
    public function show(Submission $submission): Response
    {
        return $this->render('submission/show.html.twig', [
            'submission' => $submission,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_submission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Submission $submission, SubmissionRepository $submissionRepository): Response
    {
        $form = $this->createForm(SubmissionType::class, $submission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submissionRepository->save($submission, true);

            return $this->redirectToRoute('app_submission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('submission/edit.html.twig', [
            'submission' => $submission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_submission_delete', methods: ['POST'])]
    public function delete(Request $request, Submission $submission, SubmissionRepository $submissionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$submission->getId(), $request->request->get('_token'))) {
            $submissionRepository->remove($submission, true);
        }

        return $this->redirectToRoute('app_submission_index', [], Response::HTTP_SEE_OTHER);
    }
}
