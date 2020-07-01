<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\Client;
use App\Entity\Utilisateur;
use App\Repository\TrajetRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PetitTestController extends AbstractController
{
    /**
     * @Route("/petit/test", name="petit_test")
     */
    public function index(TrajetRepository $repo)
    {
       $trajets = $repo->findAll();

        return $this->render('petit_test/index.html.twig', [
            'controller_name' => 'PetitTestController',
            'trajets' => $trajets
        ]);
    }
}
