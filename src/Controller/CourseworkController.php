<?php

namespace App\Controller;

use App\Entity\Coursework;
use App\Form\CourseworkType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coursework")
 * @IsGranted("ROLE_USER")
 */
class CourseworkController extends AbstractController
{
    /**
     * @Route("/", name="coursework_index", methods={"GET"})
     */
    public function index(): Response
    {
        $courseworks = $this->getDoctrine()
            ->getRepository(Coursework::class)
            ->findAll();

        return $this->render('coursework/index.html.twig', [
            'courseworks' => $courseworks,
        ]);
    }

    /**
     * @Route("/new", name="coursework_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $coursework = new Coursework();
        $form = $this->createForm(CourseworkType::class, $coursework);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coursework);
            $entityManager->flush();

            return $this->redirectToRoute('coursework_index');
        }

        return $this->render('coursework/new.html.twig', [
            'coursework' => $coursework,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coursework_show", methods={"GET"})
     * @param Coursework $coursework
     * @return Response
     */
    public function show(Coursework $coursework): Response
    {
        return $this->render('coursework/show.html.twig', [
            'coursework' => $coursework,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="coursework_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Coursework $coursework
     * @return Response
     */
    public function edit(Request $request, Coursework $coursework): Response
    {
        $form = $this->createForm(CourseworkType::class, $coursework);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coursework_index');
        }

        return $this->render('coursework/edit.html.twig', [
            'coursework' => $coursework,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coursework_delete", methods={"DELETE"})
     * @param Request $request
     * @param Coursework $coursework
     * @return Response
     */
    public function delete(Request $request, Coursework $coursework): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coursework->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coursework);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coursework_index');
    }
}
