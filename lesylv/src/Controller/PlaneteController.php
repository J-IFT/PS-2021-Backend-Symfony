<?php

namespace App\Controller;

use App\Entity\Planete;
use App\Form\PlaneteType;
use App\Service\Reformateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planete")
 */
class PlaneteController extends AbstractController
{
    /**
     * @Route("/", name="planete_index", methods={"GET"})
     */
    public function index(Reformateur $reformateur): Response
    {
        $planetes = $this->getDoctrine()
            ->getRepository(Planete::class)
            ->findAll();

        foreach ($planetes as $planete) {

            $reformat = $reformateur->reformaterNombre($planete->getDistance());

            $planete->setDistance($reformat);
        }

        return $this->render('planete/index.html.twig', [
            'planetes' => $planetes,
        ]);
    }

    /**
     * @Route("/new", name="planete_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planete = new Planete();
        $form = $this->createForm(PlaneteType::class, $planete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planete);
            $entityManager->flush();

            return $this->redirectToRoute('planete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planete/new.html.twig', [
            'planete' => $planete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="planete_show", methods={"GET"})
     */
    public function show(Planete $planete): Response
    {
        return $this->render('planete/show.html.twig', [
            'planete' => $planete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planete_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Planete $planete): Response
    {
        $form = $this->createForm(PlaneteType::class, $planete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planete/edit.html.twig', [
            'planete' => $planete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="planete_delete", methods={"POST"})
     */
    public function delete(Request $request, Planete $planete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planete_index', [], Response::HTTP_SEE_OTHER);
    }
}
