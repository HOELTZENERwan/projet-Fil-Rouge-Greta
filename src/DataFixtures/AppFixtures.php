<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Frais;
use App\Entity\Client;
use App\Entity\Utilisateur;
use App\Entity\Trajet;
use App\Entity\StatutFrais;
use App\Entity\TypeFrais;
use App\Entity\Role;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $admin = new Role();
        $commercial = new Role();
        $admin->setLabel("Admin");
        $commercial->setLabel("Commercial");
        $manager->persist($admin);
        $manager->persist($commercial);


        for($i=1; $i<10 ; $i++){
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($faker->lastName())
                        ->setPrenom($faker->firstName())
                        ->setEmail($faker->companyEmail())
                        ->setTelephone($faker->phoneNumber())
                        ->setUsername($faker->userName())
                        ->setPassword($faker->password())
                        ->setIdRole($commercial);

            $manager->persist($utilisateur);
            

        }


        for($j=1;$j<10;$j++){
            $client = new Client();
            $client->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setTel($faker->phoneNumber())
                ->setEmail($faker->companyEmail())
                ->setAdresse($faker->address());

            $manager->persist($client);

            for($k=1;$k<=mt_rand(2, 4);$k++){
                $trajet = new Trajet();
                // $dateDebut = 
                $trajet->setLabel($faker->sentence())
                ->setCommentaire($faker->paragraph());
                // ->setDateDebut($faker->dateTime())
                // ->setDateFin($faker->dateTime())   
            }

        }

       

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
