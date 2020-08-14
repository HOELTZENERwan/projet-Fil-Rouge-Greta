<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function client(Request $request)
    {
        $client = new Client(); //créer un formulaire vide
        $form = $this->createForm(ClientType::class, $client); //on crée le form en se servant du type
        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid()){
            $client = $form->getData();
            $em = $this->getDoctrine()->getManager();  //gestionnaire d'entity
            $em->persist($client); //préparer la requête
            $em->flush(); //stocker ds BDD
            return $this->redirectToRoute('client'); //redirection
        }

        return $this->render('client/index.html.twig', [
            'titre' => 'client',
             'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/client", name="clients_get", methods={"GET"})
     */
    public function clients(ClientRepository $clientRepository, SerializerInterface $serializer){
        return $this->json($clientRepository->findAll(), 200, [], ['groups' => 'read:client']);
    }

    /**
     * @Route("/clients", name="clients_index")
     */
    public function index(ClientRepository $repo){
        $clients = $repo->findAll();
        return $this->render('client/index.html.twig', [
            'clients' => $clients
        ]);
    }
}
