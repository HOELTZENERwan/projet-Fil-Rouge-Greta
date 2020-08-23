<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

     /**
     * @Route("/", name="index")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        //on vérifie le rôle de l'utilisateur pour rediriger en fonction 
        if ($this->getUser()) {
            if( in_array('ROLE_SUPER_ADMIN',$this->getUser()->getRoles()) || in_array('ROLE_ADMIN', $this->getUser()->getRoles()))
            {
                return $this->redirectToRoute('admin');
            } else{
                return $this->redirectToRoute('denied');
            }
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }



    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    /**
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {

        $utilisateur = new Utilisateur();

        //on relie les champs entre eux
        $form = $this->createForm(RegistrationType::class, $utilisateur);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //on crype les mdp ds la bdd avec bcrypt
            $hash = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($hash);

            // $locale = $form->getData()['locale'];
            // $utilisateur->setLocale($locale);
            $manager->persist($utilisateur);
            $manager->flush();

        //à la soumission on fait une redirection
         return $this->redirectToRoute('app_login');

        }

        return $this->render('registration/index.html.twig', [
                'form' => $form->createView()
            ]);

       
    }


    /**
     * @Route("/denied", name="access_denied")
     */
    public function denied()
    {
        return $this->render('registration/denied.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}
