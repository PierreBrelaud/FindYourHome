<?php


namespace App\Controller;

use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    public function index(AccomodationRepository $repository)  {

        $datas = array();
        $accomodations = $repository->findAll();

        foreach($accomodations as $accomodation) {
            $mark = $repository->getAccomodationAverageMarks($accomodation->getId())[1];
            $datas[$accomodation->getId()]['accomodation'] = $accomodation;
            $datas[$accomodation->getId()]['mark'] = $mark;
        }

        dump($datas);

        return $this->render('front/home.html.twig', [
            'datas' => $datas
        ]);
    }
}