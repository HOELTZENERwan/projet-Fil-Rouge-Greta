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


        $repas = new TypeFrais();
        $repas->setLabel('repas');
        $manager->persist($repas);
        $transport = new TypeFrais();
        $transport->setLabel('transport');
        $manager->persist($transport);
        $peage = new TypeFrais();
        $peage->setLabel('péage');
        $manager->persist($peage);
        $carburant = new TypeFrais();
        $carburant->setLabel('carburant');
        $manager->persist($carburant);
        $kilometrique = new TypeFrais();
        $kilometrique->setLabel('kilometrique');
        $manager->persist($kilometrique);
        $hebergement = new TypeFrais();
        $hebergement->setLabel('hébergement');
        $manager->persist($hebergement);
        $achat = new TypeFrais();
        $achat->setLabel('achat');
        $manager->persist($achat);
        $autre = new TypeFrais();
        $autre->setLabel('autre');
        $manager->persist($autre);

        $enAttente = new StatutFrais();
        $enAttente->setLabel('en attente');
        $manager->persist($enAttente);

        $rejete = new StatutFrais();
        $rejete->setLabel('rejeté');
        $manager->persist($rejete);

        $valide= new StatutFrais();
        $valide->setLabel('validé');
        $manager->persist($valide);

        $rembourseIntegral = new StatutFrais();
        $rembourseIntegral->setLabel('remboursé intégralement');
        $manager->persist($rembourseIntegral);

        $remboursePartiel = new StatutFrais();
        $remboursePartiel->setLabel('partiellement remboursé');
        $manager->persist($remboursePartiel);

        $cloture = new StatutFrais();
        $cloture->setLabel('clôturé');
        $manager->persist($cloture);


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
                $dateDebut = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone='Europe/Paris');
                $dateFin = $faker->dateTimeInInterval($startDate = $dateDebut, $interval = '+ 3 days', $timezone = 'Europe/Paris'); 
                $trajet->setLabel($faker->sentence())
                        ->setCommentaire($faker->paragraph())
                        ->setDateDebut($dateDebut)
                        ->setDateFin($dateFin);   
                       
                $manager->persist($trajet);

                for($y=1;$y<mt_rand(2, 4); $y++){
                    $frais = new Frais();
                    $frais->setMontant($faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 500))
                            ->setDate($faker->dateTimeBetween($startDate= $dateDebut, $endDate= $dateFin, $timezone = 'Europe/Paris'))
                            ->setScan($faker->text($maxNbChars = 250));
                            // -setIdStatutFrais($enAttente->getId())
                            // -setIdTypeFrais($hebergement->getId())
                            // ->setIdCommercial($commercial->getId())
                            // -setIdTrajet($trajet);
                    $manager->persist($frais);
                }


            }

        }

       
        $manager->flush();
    }
}
