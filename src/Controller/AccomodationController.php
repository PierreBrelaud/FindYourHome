<?php

namespace App\Controller;

use App\Entity\Accomodation;
use App\Form\AccomodationType;
use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accomodation")
 */
class AccomodationController extends AbstractController
{
    /**
     * @Route("/", name="accomodation_index", methods={"GET"})
     */
    public function index(AccomodationRepository $accomodationRepository): Response
    {
        return $this->render('accomodation/index.html.twig', [
            'accomodations' => $accomodationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="accomodation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accomodation = new Accomodation();
        $form = $this->createForm(AccomodationType::class, $accomodation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accomodation);
            $entityManager->flush();

            return $this->redirectToRoute('accomodation_index');
        }

        return $this->render('accomodation/new.html.twig', [
            'accomodation' => $accomodation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accomodation_show", methods={"GET"})
     */
    public function show(Accomodation $accomodation): Response
    {
        return $this->render('accomodation/show.html.twig', [
            'accomodation' => $accomodation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="accomodation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accomodation $accomodation): Response
    {
        $form = $this->createForm(AccomodationType::class, $accomodation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accomodation_index', [
                'id' => $accomodation->getId(),
            ]);
        }

        return $this->render('accomodation/edit.html.twig', [
            'accomodation' => $accomodation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accomodation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Accomodation $accomodation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accomodation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accomodation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accomodation_index');
    }
}
