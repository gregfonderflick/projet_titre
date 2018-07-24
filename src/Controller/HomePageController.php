<?php

namespace App\Controller;

use App\Entity\Heading;
use App\Form\HeadingType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Twig\AppExtension;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="home")
     */

    public function home()
    {

        return $this->render('home_page/home.html.twig', array()
        );
    }

}
