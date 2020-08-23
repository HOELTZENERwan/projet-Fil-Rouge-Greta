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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
            $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');


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


        $superAdmin = new Utilisateur();
        $plainPassword = "bonjourbonsoir";
        $superAdmin->setNom("Gaits")
                    ->setPrenom("Estelle")
                    ->setEmail("estelle.gaits@gmail.com")
                    ->setTelephone("0783886218")
                    ->setUsername("estelle.gaits@gmail.com")
                    ->setPassword($this->passwordEncoder->encodePassword($superAdmin, $plainPassword))
                    ->setLocale("fr_FR")
                    ->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($superAdmin);


        for($i=1; $i<10 ; $i++){
            $utilisateur = new Utilisateur();
            $email = $faker->companyEmail();
            $plainPasswordFaker = $faker->password();
            $encodedPasswordFaker = $this->passwordEncoder->encodePassword($utilisateur, $plainPasswordFaker);
            $utilisateur->setNom($faker->lastName())
                        ->setPrenom($faker->firstName())
                        ->setEmail($email)
                        ->setTelephone($faker->phoneNumber())
                        ->setUsername($email)
                        ->setLocale($faker->locale())
                        ->setPassword($encodedPasswordFaker);
                   
            $manager->persist($utilisateur);
        }

     

        for($j=1;$j<10;$j++){
            $client = new Client();
            $client->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setTel($faker->phoneNumber())
                ->setEmail($faker->companyEmail())
                // -setAddedBy($superAdmin->getId())
                ->setAdresse($faker->address());
        
            for($k=1;$k<=mt_rand(2, 4);$k++){
                $trajet = new Trajet();
                $dateDebut = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone='Europe/Paris');
                $dateFin = $faker->dateTimeInInterval($startDate = $dateDebut, $interval = '+ 4 days', $timezone = 'Europe/Paris'); 
                $trajet->setLabel($faker->sentence())
                        ->setCommentaire($faker->sentence())
                        ->setDateDebut($dateDebut)
                        ->setDateFin($dateFin);
                        // ->setIdClient($client->getId());   
                // $client->addTrajet($trajet);
               

                for($y=1;$y<mt_rand(2, 4); $y++){
                    $frais = new Frais();
                    $frais->setMontant($faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 500))
                            ->setDate($faker->dateTimeBetween($startDate= $dateDebut, $endDate= $dateFin, $timezone = 'Europe/Paris'))
                            ->setCommentaire($faker->sentence());
                            // ->setIdTrajet($trajet->getId());
                            // ->setScan($faker->text($maxNbChars = 250));
                            // -setIdStatutFrais($enAttente->getId())
                            // -setIdTypeFrais($hebergement->getId())
                            // ->setIdCommercial($commercial->getId())
                            // -setIdTrajet($trajet);
                    // $trajet->addFraisAll($frais);
                    $manager->persist($frais);
                }

                $manager->persist($trajet);
            }

            $manager->persist($client);
        }

       
        $manager->flush();
    }
}
