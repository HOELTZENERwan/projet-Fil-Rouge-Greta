<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractFOSRestController
{

    /**
     * @var UtilisateurRepository
     */
    private $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }


    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @return \FOS\RestBundle\View\View 
     */
    public function index(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $utilisateur = $this->utilisateurRepository->findOneBy([
            'email' => $email
        ]);

        if(!is_null($utilisateur)){
            return $this->view([
                'message' => 'Cet utilisateur existe déjà'
            ], Response::HTTP_CONFLICT);
        }

        

        $utilisateur = new Utilisateur();
        $utilisateur->setEmail($email);
        $utilisateur->setPassword($this->passwordEncoder->encodePassword($utilisateur, $password));

        $this->entityManager->persist($utilisateur);
        $this->entityManager->flush();

        return $this->view($utilisateur, Response::HTTP_CREATED)->setContext((new Context())->setGroups(['public']));
    }
}
