<?php

namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AccomodationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class AccomodationController extends AbstractController
{

    public function index(AccomodationRepository $repository)
    {
        $response = new JsonResponse(['data' => $repository->findAll()]);
        return $response;
    }
}