<?php

namespace App\Controller;

use App\Entity\Submission;
use App\Form\SubmissionType;
use App\Service\GradeCalculator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/submissions")
 * @IsGranted("ROLE_USER")
 */
class SubmissionController extends AbstractController
{
    /**
     * @Route("/", name="submission_index", methods={"GET"})
     */
    public function index(): Response
    {
        $submissions = $this->getDoctrine()
            ->getRepository(Submission::class)
            ->findAllWithStudents();

        return $this->render('submission/index.html.twig', [
            'submissions' => $submissions,
        ]);
    }

    /**
     * @Route("/new", name="submission_new", methods={"GET","POST"})
     * @param Request $request
     * @param GradeCalculator $gradeCalculator
     * @return Response
     */
    public function new(Request $request, GradeCalculator $gradeCalculator): Response
    {
        $submission = new Submission();
        $form = $this->createForm(SubmissionType::class, $submission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $mark = $submission->getMark();
            if ($submission->isIsSecondSubmission()) {
                $grade = $gradeCalculator->calculateGrade($mark, true);
            } else {
                $grade = $gradeCalculator->calculateGrade($mark, false);
            }
            $submission->setGrade($grade);

            $entityManager->persist($submission);
            $entityManager->flush();

            return $this->redirectToRoute('submission_index');
        }

        return $this->render('submission/new.html.twig', [
            'submission' => $submission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="submission_show", methods={"GET"})
     * @param Submission $submission
     * @return Response
     */
    public function show(Submission $submission): Response
    {
        return $this->render('submission/show.html.twig', [
            'submission' => $submission,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="submission_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Submission $submission
     * @return Response
     */
    public function edit(Request $request, Submission $submission, GradeCalculator $gradeCalculator): Response
    {
        $form = $this->createForm(SubmissionType::class, $submission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Submission $submission */
            $submission = $form->getData();

            $mark = $submission->getMark();
            if ($submission->isIsSecondSubmission()) {
                $grade = $gradeCalculator->calculateGrade($mark, true);
            } else {
                $grade = $gradeCalculator->calculateGrade($mark, false);
            }

            $submission->setGrade($grade);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('submission_index');
        }

        return $this->render('submission/edit.html.twig', [
            'submission' => $submission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="submission_delete", methods={"DELETE"})
     * @param Request $request
     * @param Submission $submission
     * @return Response
     */
    public function delete(Request $request, Submission $submission): Response
    {
        if ($this->isCsrfTokenValid('delete' . $submission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($submission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('submission_index');
    }
}
