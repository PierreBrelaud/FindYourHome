<?php


namespace App\Controller;

use App\Repository\AccomodationRepository;
use App\Form\SearchFormType;
use GraphAware\Neo4j\OGM\EntityManager;
use App\Entity\NodeVisitor;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController {

    public function index(AccomodationRepository $repository, Request $request, EntityManagerInterface $emg)  {

        //------------------------------------------------
        /*$test = new NodeVisitor();
        $test->setName('Brelaud Pierre');
        $test->setAge(23);
        $emg->persist($test);
        $emg->flush();*/
        //------------------------------------------------


        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $search = $form->getData();
            $search = $search['search'];

            return $this->redirectToRoute('front_search', array('search' => $search));
        }

        $datas = array();
        $accomodations = $repository->findAll();
        dump($datas);

        foreach($accomodations as $accomodation) {
            $mark = $repository->getAccomodationAverageMarks($accomodation->getId())[1];
            $datas[$accomodation->getId()]['accomodation'] = $accomodation;
            $datas[$accomodation->getId()]['mark'] = $mark;
        }

        return $this->render('front/home.html.twig', [
            'datas' => $datas,
            'form'  => $form->createView()
        ]);
    }
}