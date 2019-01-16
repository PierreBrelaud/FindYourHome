<?php

namespace App\Controller;


use App\Entity\Accomodation;
use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccomodationController extends  AbstractController {

    private $repository;
    private $em;

    public function __construct() {

    }

    public function index() {
        return $this->render('front/home.html.twig', [
            'datas' =>  $this->getDoctrine()->getRepository(Accomodation::class)->findAll()
        ]);
    }

    public function view(Accomodation $accomodation) {

        //$test = $this->getDoctrine()->getRepository(Type::class)->find($accomodation->getType()->getId());
        dump($accomodation->getUser());
        return $this->render('front/view.html.twig', [
            'accomodation'   => $accomodation,
            'type'           => $accomodation->getType(),
            'location'       => $accomodation->getLocation(),
            'equipments'     => $accomodation->getEquipments()->getValues(),
            'availabilities' => $accomodation->getAvalabilities()->getValues(),
            'photos'         => $accomodation->getPhotos()->getValues(),
            'owner'          => $accomodation->getUser()
        ]);
    }
}