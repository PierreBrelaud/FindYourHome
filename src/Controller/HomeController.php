<?php


namespace App\Controller;

use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    public function index(AccomodationRepository $repository)  {

        $accomodations = $repository->findAll();
        //dump($accomodations);
        return $this->render('front/home.html.twig', [
            'accomodations' => $accomodations
        ]);
    }
}