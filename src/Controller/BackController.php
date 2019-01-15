<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    /**
    *  @Route("/admin/home", name="home_page")
    */
    public function iniAction()
    {
        return $this->render('back/home.html.twig', [

        ]);
    }
}