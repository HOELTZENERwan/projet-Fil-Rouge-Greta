<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Role();
        $comptable = new Role();
        $commercial = new Role();
        $admin->setLabel("Admin");
        $comptable->setLabel("Comptable");
        $commercial->setLabel("Commercial");

        for($i = 1; $i<= 10; $i++){
            //on crée un objet Article
            $utilisateur = new Utilisateur();   
            $utilisateur->setNom("Nom n°$i")
                    ->setPrenom("Prénom n°$i")
                    ->setEmail("courrier.electronique@email.com")
                    ->setTelephone("0102030405")
                    ->setUsername("Pseudo$i")
                    ->setPassword("mdp$i")
                    ->setIdRole($admin);
            $manager->persist($utilisateur);
            $manager->persist($admin);
            $manager->flush();
        }

        for($i = 1; $i<= 10; $i++){
            //on crée un objet Article
            $utilisateur = new Utilisateur();
            $utilisateur->setNom("Nompluslong n°$i")
                    ->setPrenom("Prénompluslong n°$i")
                    ->setEmail("courrier.pigeon@email.com")
                    ->setTelephone("1020304050")
                    ->setUsername("Pseudopluslong$i")
                    ->setPassword("mdppluslong$i")
                    ->setIdRole($comptable);
            $manager->persist($utilisateur);
            $manager->persist($comptable);
            $manager->flush();
        }
    }
}
