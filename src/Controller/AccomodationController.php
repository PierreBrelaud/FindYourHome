<?php

namespace App\Controller;


use App\Entity\Accomodation;
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
        dump($accomodation);
        return $this->render('front/view.html.twig', [
            'accomodation' => $accomodation
        ]);
    }
}