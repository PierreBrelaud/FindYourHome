<?php


namespace App\Controller;

use App\Repository\AccomodationRepository;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    public function index(AccomodationRepository $repository) : Response {

        $accomodations = $repository->findAll();
        dump($accomodations);
        return $this->render('front/home.html.twig', [
            'accomodations' => $accomodations
        ]);

    }
}