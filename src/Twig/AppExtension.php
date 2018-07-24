<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 23/07/18
 * Time: 22:42
 */

namespace App\Twig;


use App\Entity\Article;
use App\Entity\Heading;
use App\Entity\User;
use App\Form\HeadingType;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;


class AppExtension extends AbstractExtension
{

    protected $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }


    public function getLastEntities($entityName)
    {

        $entitiesMapping = [
            'article' => Article::class,
            'heading' => Heading::class,
            'heading_type' => HeadingType::class,
            'user' => User::class
        ];

        $entity = $entitiesMapping[$entityName];

        $headings = $this->doctrine->getRepository($entity)->findAll();

        return $headings;
    }


    public function getFunctions()
    {
        return array(
            new TwigFunction('getLastEntities', [$this, 'getLastEntities'])
        );

    }

    public function getFilters()
    {
        return array(
            new TwigFilter('title', array($this, 'titleFilter')),
        );
    }
}




