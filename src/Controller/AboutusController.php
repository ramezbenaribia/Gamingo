<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutusController extends AbstractController
{
    /**
     * @Route("/admin/aboutus", name="aboutus")
     */
    public function index()
    {
        return $this->render('Admin/about_us.html.twig');
    }
}
