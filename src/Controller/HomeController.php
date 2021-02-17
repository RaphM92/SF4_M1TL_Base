<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param RoomRepository $roomRepository
     * @return Response
     */
    public function index(RoomRepository $roomRepository): Response
    {

        $rooms = $roomRepository->findAll();

        return $this->render('home/index.html.twig', [
            'rooms'=>$rooms
        ]);
    }
}
