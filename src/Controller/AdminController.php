<?php


namespace App\Controller;
use App\Entity\Accomodation;
use App\Entity\Review;
use App\Form\AccomodationFormType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AdminController extends AbstractController
{

    public function index()
    {
        return $this->render('back/home.html.twig', [

        ]);
    }

    public function editProfile(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_home_page');
        }


        return $this->render('back/user/profile.html.twig', [
            'user' => $form->createView(),
        ]);
    }

    public function editReviews()
    {

        return $this->render('back/user/reviews.html.twig', [
            'reviews' => $this->getUser()->getReviews()

        ]);
    }
    
    //Gustavo stp fixe sa pls
    /**
     *
     * @Route("/user/review/update", methods={"POST","BODY"})
     */
    public function updateReviews(Request $request)
    {
        $data = $request->getContent();

        $encoder = new JsonEncoder();
        $test = $encoder->encode($data , 'json');

        if(empty($data))
        {
            return new Response('nop ', Response::HTTP_OK);
        }
        else{

            $review = $this->getDoctrine()->getRepository(Review::class)->find(1);
            $review->setTitle($test[0]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();
            return $this->redirectToRoute('user_favorites');
        }

    }


    public function deleteReviews($id)
    {

        $review = $this->getDoctrine()->getRepository(Review::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($review);
        $entityManager->flush();
        return new Response('oui ', Response::HTTP_OK);

    }

    public function editFavorites()
    {
        return $this->render('back/user/favorites.html.twig', [
            'favorites' => $this->getUser()->getFavorites()
        ]);
    }


    public function editReservations()
    {
        return $this->render('back/user/reservations.html.twig', [

        ]);
    }

    public function editBill()
    {
        return $this->render('back/user/bill.html.twig', [

        ]);
    }

    public function editAccomodation()
    {
        return $this->render('back/user/accomodation.html.twig', [

        ]);
    }


    //Gustavo stp fixe sa pls
    public function addAccomodation(Request $request)
    {

        $accomodation = new Accomodation();

        $form = $this->createForm(AccomodationFormType::class, $accomodation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accomodation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_home_page');
        }
        return $this->render('back/user/add_accomodation.html.twig', [
            'accomodation' => $form->createView(),
        ]);
    }

}