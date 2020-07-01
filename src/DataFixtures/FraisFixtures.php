<?php

namespace App\DataFixtures;

use App\Entity\Frais;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FraisFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=10;$i++){
            $frais = new Frais();
            $frais->setMontant(50.99)
                ->setDate(new \DateTime())
                ->setCommentaire("je n'ai pas pu prendre de photo, déso");
            $manager->persist($frais);
            $manager->flush();
        }
    }
}
