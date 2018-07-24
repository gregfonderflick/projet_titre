<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

/**
        // $product = new Product();
        // $manager->persist($product);
        for($i = 1; $i <= 10; $i++){
            $article = new Article();
            $article ->setTitle("Titre de l'article num $i")
                ->setContent("<p>Contenu de l'article num $i</p>")
                ->setImage("http://placehold.it/350x150 http://placehold.it/350x150")
                ->setCreatedAt(new \DateTime())
                ->setPosition($i)
                ->setValidated(0);

            $manager->persist($article);
        }

        $manager->flush();
 * **/
    }
}