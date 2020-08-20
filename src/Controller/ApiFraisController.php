<?php

namespace App\Controller;

use App\Repository\FraisRepository;
use App\Repository\ClientRepository;
use App\Repository\TrajetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiFraisController extends AbstractController
{
    /**
     * @Route("/apiee/frais", name="api_frais_index", methods={"GET"})
     */
    public function index(FraisRepository $fraisRepository, SerializerInterface $serializer)
    {
        return $this->json($fraisRepository->findAll(), 200, [], ['groups' => 'read:frais']);
    }

    /**
     * @Route("/apiee/frais/create", name="api_frais_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        
        $jsonRecu = $request->getContent();
        try {
            //désérialisation du json reçu, création d'un objet Frais
            $frais = $serializer->deserialize($jsonRecu, Frais::class, 'json');
            
            //avant de persister dans la BDD on valide (pour éviter les erreurs SQL)
            $errors = $validator->validate($frais);
            
            if(count($errors) > 0){
                return $this->json($errors, 400);  //liste des erreurs de validation
            }

            //persister dans la BDD avec Doctrine
            $em->persist($frais);
            $em->flush();

        }catch(NotEncodableValueException $e){
            //en cas d'erreur de formatage du json envoyé
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
            
        }
    }

    /**
     * @Route("/apiee/clients", name="api_clients_index", methods={"GET"})
     */
    public function indexClient(ClientRepository $clientRepository, SerializerInterface $serializer)
    {
        return $this->json($clientRepository->findAll(), 200, [], ['groups' => 'read:client']);
    }


     /**
     * @Route("/apiee/clients/create", name="api_clients_create", methods={"POST"})
     */
    public function createClient(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        
        $jsonRecu = $request->getContent();
        try {
            //désérialisation du json reçu, création d'un objet Client
            $client = $serializer->deserialize($jsonRecu, Client::class, 'json');
            
            //avant de persister dans la BDD on valide (pour éviter les erreurs SQL)
            $errors = $validator->validate($client);
            
            if(count($errors) > 0){
                return $this->json($errors, 400);  //liste des erreurs de validation
            }

            //persister dans la BDD avec Doctrine
            $em->persist($client);
            $em->flush();

        }catch(NotEncodableValueException $e){
            //en cas d'erreur de formatage du json envoyé
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
            
        }
    }

/**
     * @Route("/apiee/trajets", name="api_trajets_index", methods={"GET"})
     */
    public function indexTrajets(TrajetRepository $trajetRepository, SerializerInterface $serializer)
    {
        return $this->json($trajetRepository->findAll(), 200, [], ['groups' => 'read:trajet']);
    }

    /**
     * @Route("/apiee/trajets/create", name="api_trajets_create", methods={"POST"})
     */
    public function createTrajet(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        
        $jsonRecu = $request->getContent();
        try {
            //désérialisation du json reçu, création d'un objet Trajet
            $trajet = $serializer->deserialize($jsonRecu, Trajet::class, 'json');
            
            //avant de persister dans la BDD on valide (pour éviter les erreurs SQL)
            $errors = $validator->validate($trajet);
            
            if(count($errors) > 0){
                return $this->json($errors, 400);  //liste des erreurs de validation
            }

            //persister dans la BDD avec Doctrine
            $em->persist($trajet);
            $em->flush();

        }catch(NotEncodableValueException $e){
            //en cas d'erreur de formatage du json envoyé
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
            
        }
    }





}
