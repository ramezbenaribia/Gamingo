<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Categorie::class);
        return $this->render('home/home.html.twig', [
            'categories' => $categories
        ]);
    }
}
