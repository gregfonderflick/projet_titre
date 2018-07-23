<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('home_page/home.html.twig', [
            'title'=> "Bienvenue sur la page d'accueil",
            'controller_name'=> "Controller page accueil",
        ]);
    }
}
