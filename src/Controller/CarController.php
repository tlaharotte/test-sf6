<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CarFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Car;

#[Route('/voitures', name: 'car_')]
class CarController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('car/index.html.twig', [
            'cars' => $carRepository->findBy([], ['name' => 'asc'])
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em): Response{
        // Création d'une nouvelle voiture
        $car = new Car();

        // Création du formulaire
        $carForm = $this->createForm(CarFormType::class, $car);

        // Traiement des données du formulaire
        $carForm->handleRequest($request);
        
        if ($carForm->isSubmitted() && $carForm->isValid()) { 
            // Stockage des données
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->renderForm('car/add.html.twig', compact('carForm'));
    }


    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Car $car, Request $request, EntityManagerInterface $em): Response{


        // Création du formulaire
        $carForm = $this->createForm(CarFormType::class, $car);

        // Traiement des données du formulaire
        $carForm->handleRequest($request);

        if ($carForm->isSubmitted() && $carForm->isValid()) { 
            // Stockage des données
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->renderForm('car/edit.html.twig', [
            'carForm' => $carForm,
            'car' => $car
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Car $car, Request $request, EntityManagerInterface $em): Response{
        $em->remove($car);
        $em->flush();

        return $this->redirectToRoute('car_index');
    }
}