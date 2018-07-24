<?php

namespace App\DataFixtures;

use App\Entity\Heading;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class HeadingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i <= 10; $i++){
            $heading = new Heading();
            $heading ->setTitle("Titre de la rubrique num $i")
                ->setPosition($i)
                ->setActive(0);

            $manager->persist($heading);
        }

        $manager->flush();
    }
}
