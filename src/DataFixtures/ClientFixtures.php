<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=10;$i++){
            $client = new Client();
            $client->setNom("Dupond$i")
                    ->setPrenom("Michel")
                    ->setAdresse("2 rue des Lilas")
                    ->setEmail("michel.dupond@email.com")
                    ->setTel("9192939495");
            $manager->persist($client);
            $manager->flush();
        }
    }
}
