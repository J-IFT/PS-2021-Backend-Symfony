<?php

namespace App\Controller;

use App\Entity\Galaxie;
use App\Form\GalaxieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/galaxie")
 */
class GalaxieController extends AbstractController
{
    /**
     * @Route("/", name="galaxie_index", methods={"GET"})
     */
    public function index(): Response
    {
        $galaxies = $this->getDoctrine()
            ->getRepository(Galaxie::class)
            ->findAll();

        return $this->render('galaxie/index.html.twig', [
            'galaxies' => $galaxies,
        ]);
    }

    /**
     * @Route("/new", name="galaxie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $galaxie = new Galaxie();
        $form = $this->createForm(GalaxieType::class, $galaxie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($galaxie);
            $entityManager->flush();

            return $this->redirectToRoute('galaxie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galaxie/new.html.twig', [
            'galaxie' => $galaxie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="galaxie_show", methods={"GET"})
     */
    public function show(Galaxie $galaxie): Response
    {
        return $this->render('galaxie/show.html.twig', [
            'galaxie' => $galaxie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="galaxie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Galaxie $galaxie): Response
    {
        $form = $this->createForm(GalaxieType::class, $galaxie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('galaxie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galaxie/edit.html.twig', [
            'galaxie' => $galaxie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="galaxie_delete", methods={"POST"})
     */
    public function delete(Request $request, Galaxie $galaxie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galaxie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($galaxie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('galaxie_index', [], Response::HTTP_SEE_OTHER);
    }
}
