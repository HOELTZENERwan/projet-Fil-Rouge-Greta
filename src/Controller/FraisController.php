<?php

namespace App\Controller;

use App\Entity\Frais;
use App\Form\FraisType;
use App\Repository\FraisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/frais")
 */
class FraisController extends AbstractController
{
    /**
     * @Route("/", name="frais_index", methods={"GET"})
     */
    public function index(FraisRepository $fraisRepository): Response
    {
        return $this->render('frais/index.html.twig', [
            'frais' => $fraisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="frais_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $frai = new Frais();
        $form = $this->createForm(FraisType::class, $frai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($frai);
            $entityManager->flush();

            return $this->redirectToRoute('frais_index');
        }

        return $this->render('frais/new.html.twig', [
            'frai' => $frai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frais_show", methods={"GET"})
     */
    public function show(Frais $frai): Response
    {
        return $this->render('frais/show.html.twig', [
            'frai' => $frai,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="frais_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Frais $frai): Response
    {
        $form = $this->createForm(FraisType::class, $frai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('frais_index');
        }

        return $this->render('frais/edit.html.twig', [
            'frai' => $frai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frais_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Frais $frai): Response
    {
        if ($this->isCsrfTokenValid('delete'.$frai->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($frai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('frais_index');
    }
}
