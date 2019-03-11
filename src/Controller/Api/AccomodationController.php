<?php

namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AccomodationRepository;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\JsonResponse;


class AccomodationController extends AbstractController
{

    public function index(AccomodationRepository $repository, Packages $assetManager)
    {
        $datas = $repository->findAll();

        $path = $assetManager->getUrl('images/default/user.png');
        //dump($path);die();
        $response = [];
        foreach ($datas as $data) {
            $response[] = array(
                'description' => $data->getDescription(),
                'name' => $data->getName(),
                'picture' => $path//$data->getUser()->getPicture()
            );
        }
        return  new JsonResponse($response);
    }
}