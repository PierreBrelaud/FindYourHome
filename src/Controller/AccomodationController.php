<?php

namespace App\Controller;


use App\Entity\Accomodation;
use App\Entity\NodeAccomodation;
use App\Entity\NodeConsultation;
use App\Entity\NodeVisitor;
use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Form\SearchFormType;
use App\Repository\AccomodationRepository;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
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

    public function view(Accomodation $accomodation, Request $request, EntityManagerInterface $emg)
    {

        //Accomodation
        $existAccomodation = $emg->getRepository(NodeAccomodation::class)->findOneBy(['name' => $accomodation->getName()]);
        $gAccomodation = new NodeAccomodation();
        if(!$existAccomodation) {
            $gAccomodation->setName($accomodation->getName());
            $emg->persist($gAccomodation);
        } else {
            $gAccomodation = $existAccomodation;
        }

        //Visitor
        $visitorId = $this->get('session')->get('visitorId');
        $existVisitor = $emg->getRepository(NodeVisitor::class)->findOneBy(['name' => $visitorId]);
        $gVisitor = new NodeVisitor();
        if(!$existVisitor) {
            $gVisitor->setName($visitorId);
            $emg->persist($gVisitor);
        } else {
            $gVisitor = $existVisitor;
        }


        $emg->flush();

        $query = $emg->createQuery(
            'MATCH (v:Visitor)-[c:CONSULT]->(a:Accomodation) 
             WHERE v.name = {visitor}
             AND   a.name = {accomodation}
             RETURN c.nbVisits AS nb'
        );

        $query->addEntityMapping('v', NodeVisitor::class);
        $query->addEntityMapping('c', NodeConsultation::class);
        $query->addEntityMapping('a', NodeAccomodation::class);

        $query->setParameter('visitor', $gVisitor->getName());
        $query->setParameter('accomodation', $gAccomodation->getName());

        $existConsultation = $query->execute();

        if(!$existConsultation) {
            //create
            dump("create");
            $gConsult = new NodeConsultation($gVisitor, $gAccomodation);
            $gVisitor->getConsultations()->add($gConsult);
            $gAccomodation->getConsultations()->add($gConsult);

            $emg->persist($gVisitor);
            $emg->persist($gAccomodation);
            $emg->flush();
        }
        else {
            //increment
            $nbVisits = $existConsultation[0]['nb'];
            $query = $emg->createQuery(
                'MATCH (v:Visitor)-[c:CONSULT]->(a:Accomodation)
                 WHERE v.name = {visitor}
                 AND   a.name = {accomodation}
                 SET c.nbVisits = {increment}
                 RETURN c.nbVisits AS nb'
            );
            $query->setParameter('visitor', $gVisitor->getName());
            $query->setParameter('accomodation', $gAccomodation->getName());
            $query->setParameter('increment', $nbVisits + 1);

            $nbVisits = $query->execute();
            dump($nbVisits);

        }

        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);

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