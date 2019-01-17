<?php

namespace App\Controller;


use App\Entity\Accomodation;
use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;

class AccomodationController extends AbstractController
{

    public function index(AccomodationRepository $repository)
    {
        return $this->render('front/home.html.twig', [
            'datas' => $repository->findAll()
        ]);
    }

    public function view(Accomodation $accomodation, Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());

            $review = $form->getData();
            $review->setUser($this->getUser());
            $review->setAccomodation($accomodation);
            $review->setDate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();
        }

        return $this->render('front/view.html.twig', [
            'accomodation'   => $accomodation,
            'type'           => $accomodation->getType(),
            'location'       => $accomodation->getLocation(),
            'equipments'     => $accomodation->getEquipments()->getValues(),
            'availabilities' => $accomodation->getAvalabilities()->getValues(),
            'photos'         => $accomodation->getPhotos()->getValues(),
            'owner'          => $accomodation->getUser(),
            'reviews'        => $accomodation->getReviews()->getValues(),
            'form'           => $form->createView()
        ]);
    }
}