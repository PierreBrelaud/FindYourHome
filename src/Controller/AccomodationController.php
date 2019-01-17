<?php

namespace App\Controller;


use App\Entity\Accomodation;
use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccomodationController extends AbstractController
{

    public function index(AccomodationRepository $repository)
    {
        return $this->render('front/home.html.twig', [
            'datas' => $repository->findAll()
        ]);
    }

    public function view(Accomodation $accomodation)
    {

        //$test = $this->getDoctrine()->getRepository(Type::class)->find($accomodation->getType()->getId());
        dump($accomodation->getUser());
        return $this->render('front/view.html.twig', [
            'accomodation' => $accomodation,
            'type' => $accomodation->getType(),
            'location' => $accomodation->getLocation(),
            'equipments' => $accomodation->getEquipments()->getValues(),
            'availabilities' => $accomodation->getAvalabilities()->getValues(),
            'photos' => $accomodation->getPhotos()->getValues(),
            'owner' => $accomodation->getUser(),
            'reviews' => $accomodation->getReviews()->getValues()
        ]);
    }
}