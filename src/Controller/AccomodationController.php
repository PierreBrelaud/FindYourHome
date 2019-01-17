<?php

namespace App\Controller;


use App\Entity\Accomodation;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewFormType;
use App\Form\SearchFormType;
use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AccomodationController extends AbstractController
{

    public function index(AccomodationRepository $repository)
    {
        return $this->render('front/search.html.twig', [
            'datas' => $repository->findAll()
        ]);
    }

    public function search(AccomodationRepository $repository, Request $request)
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $search = $form->getData();
            $search = $search['search'];

            return $this->redirectToRoute('front_search', array('search' => $search));
        }

        $search = $request->get('search');

        return $this->render('front/search.html.twig', [
            'datas' => $repository->searchAccomodation($search),
            'form'  => $form->createView()
        ]);
    }

    public function view(Accomodation $accomodation, Request $request, User $user)
    {
        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);

        $user = new User();



        if($form->isSubmitted() && $form->isValid()) {

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