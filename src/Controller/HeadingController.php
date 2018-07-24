<?php

namespace App\Controller;

use App\Entity\Heading;
use App\Form\HeadingType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\ArticleRepository;
use App\Twig\AppExtension;

class HeadingController extends Controller
{


    /**
     * @Route("/heading", name="heading")
     */
    public function index()
    {
        return $this->render('heading/index.html.twig', [
            'controller_name' => 'HeadingController',
        ]);
    }

    /**
     * @Route("/heading/new", name="heading_create")
     * @Route("/heading/{id}/edit", name="heading_edit")
     */


    public function form(Heading $heading = null, Request $request, ObjectManager $manager)
    {
        if (!$heading) {
            $heading = new Heading();
        }

        $form = $this->createForm(HeadingType::class, $heading);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $manager->persist($heading);
            $manager->flush();

            return $this->redirectToRoute('heading/show.html.twig', [
                'id' => $heading->getId()
            ]);

        }

        return $this->render('heading/create.html.twig', [
            'formHeading' => $form->createView(),
            'heading' => $heading,
            'editMode' => $heading->getId() !== null
        ]);

    }

    /**
     * @Route("/heading/delete/{id}", name="heading_delete")
     */
    public function remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $heading = $entityManager->getRepository(Heading::class)->find($id);
        if (!$heading) {
            throw $this->createNotFoundException(
                'No article found for id7418520.*963.5201'.$id
            );
        }

        $entityManager->remove($heading);
        $entityManager->flush();

        return new Response('Delete heading'.$id);
    }
    /**
     * @Route("/heading/{id}", name="heading_show")
     */
    public function show(Heading $heading){

        return $this->render('heading/show.html.twig',[
            'controller_name' => 'HeadingController',
            'title' => $heading->getTitle(),
            'heading' => $heading
        ]);
    }

}
