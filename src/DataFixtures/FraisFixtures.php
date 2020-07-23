<?php

namespace App\DataFixtures;

use App\Entity\Frais;
use App\Entity\StatutFrais;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FraisFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    
        $pending = new StatutFrais();
        $pending->setLabel('En attente');

        $denied = new StatutFrais();
        $denied->setLabel('Refusé');
  
        $approved = new StatutFrais();
        $approved->setLabel('Approuvé');     

        for($i=1; $i<=10;$i++){
            $frais = new Frais();
            $frais->setMontant(50.99)
                ->setDate(new \DateTime())
                ->setCommentaire("je n'ai pas pu prendre de photo, déso");
            $manager->persist($frais);
            $manager->persist($denied);
            $manager->persist($pending);
            $manager->persist($approved);
            $manager->flush();
        }
    }
}
