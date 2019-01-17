<?php


namespace App\Controller;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    public function index()
    {
        return $this->render('back/home.html.twig', [

        ]);
    }

    public function editProfile(Request $request ,$id)
    {
        $user = $this->getDoctrine()->getRepository('User')->find($id);
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

        ]);
    }

    public function editFavorites()
    {
        return $this->render('back/user/favorites.html.twig', [

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

}