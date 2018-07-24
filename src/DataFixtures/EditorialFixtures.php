<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Heading;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EditorialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i <= 6; $i++){
            $heading = new Heading();
            $heading ->setTitle("Rubrique $i")
                ->setPosition($i)
                ->setActive(0);

            for($j = 1; $j <= rand(3,6); $j++){
                $article = new Article();
                $article ->setTitle("Aticle $i-$j")
                    ->setContent("<p>Contenu de l'article num $i-$j</p>")
                    ->setImage("http://placehold.it/350x150 http://placehold.it/350x150")
                    ->setCreatedAt(new \DateTime())
                    ->setPosition($j)
                    ->setHeading($heading)
                    ->setValidated(0);

                $manager->persist($article);
            }

            $manager->persist($heading);
        }

        $manager->flush();
    }
}
