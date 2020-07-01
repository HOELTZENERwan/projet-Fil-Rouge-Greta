<?php

namespace App\Controller;

use App\Repository\FraisRepository;
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
     * @Route("/api/frais", name="api_frais_index", methods={"GET"})
     */
    public function index(FraisRepository $fraisRepository, SerializerInterface $serializer)
    {
        return $this->json($fraisRepository->findAll(), 200, [], ['groups' => 'read:frais']);
    }

    /**
     * @Route("/api/frais", name="api_frais_create", methods={"POST"})
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

}
