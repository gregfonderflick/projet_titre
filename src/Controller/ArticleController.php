<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{

    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/article/new", name="article_create")
     * @Route("/article/{id}/edit", name="article_edit")
     */


    public function form(Article $article = null, Request $request, ObjectManager $manager)
    {
        if (!$article) {
            $article = new Article();
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }


            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article/show.html.twig', [
                'id' => $article->getId()
            ]);

        }

        return $this->render('article/create.html.twig', [
            'formArticle' => $form->createView(),
            'article' => $article,
            'editMode' => $article->getId() !== null
        ]);

    }

    /**
     * @Route("/article/delete/{id}", name="article_delete")
     */
    public function remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id7418520.*963.5201'.$id
            );
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return new Response('Delete article'.$id);
    }
    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show(Article $article){

        return $this->render('article/show.html.twig',[
            'controller_name' => 'ArticleController',
            'title' => $article->getTitle(),
            'article' => $article
        ]);
    }

}





