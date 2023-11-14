<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'cars' => $carRepository->findBy([], ['name' => 'asc'])
        ]);
    }
}