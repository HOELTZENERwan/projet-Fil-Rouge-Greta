<?php

namespace App\DataFixtures;

use App\Entity\Trajet;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TrajetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=10;$i++){
            $trajet = new Trajet();
            $dateDebut = new \DateTime();
            $dateFin = $dateDebut->modify('+3 day');
            $trajet->setLabel("Prospection Saint-Emilion")
                ->setDateDebut($dateDebut)
                ->setDateFin($dateFin)
                ->setCommentaire("le client est très emballé !");
            $manager->persist($trajet);
            $manager->flush();
        }
    }
}
