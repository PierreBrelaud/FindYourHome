<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    public function index()
    {
        return $this->render('back/home.html.twig', [

        ]);
    }

    public function editProfile()
    {
        return $this->render('back/user/profile.html.twig', [

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