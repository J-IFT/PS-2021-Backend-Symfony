<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voyage")
 */
class VoyageController extends AbstractController
{
    /**
     * @Route("/", name="voyage_index", methods={"GET"})
     */
    public function index(): Response
    {
        $voyages = $this->getDoctrine()
            ->getRepository(Voyage::class)
            ->findAll();

        return $this->render('voyage/index.html.twig', [
            'voyages' => $voyages,
        ]);
    }

    /**
     * @Route("/new", name="voyage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyage);
            $entityManager->flush();

            return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_show", methods={"GET"})
     */
    public function show(Voyage $voyage): Response
    {
        return $this->render('voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voyage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voyage $voyage): Response
    {
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_delete", methods={"POST"})
     */
    public function delete(Request $request, Voyage $voyage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
    }
}
