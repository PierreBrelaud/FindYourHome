<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OwnerController extends AbstractController
{
    public function editAccomodation()
    {
        return $this->render('back/owner/accomodation.html.twig', [

        ]);
    }

    public function editAvailability()
    {
        return $this->render('back/owner/availability.html.twig', [

        ]);
    }

    public function editBooking()
    {
        return $this->render('back/owner/booking.html.twig', [

        ]);
    }

}