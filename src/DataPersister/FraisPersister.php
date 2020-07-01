<?php
namespace App\DataPersister;

use App\Entity\Frais;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class FraisPersister implements DataPersisterInterface {

    protected $em;

    public function __construct(EntityManagerInterface $em){
        //manager de doctrine
        $this->em = $em;
    }

      
    public function supports($data): bool {
        return $data instanceof Frais;
    }

    //ici on définit le travail de persistance
    public function persist($data){
        //d'abord mettre une date de création
        $data->setDate(new \DateTime());

        //puis demander à doctrine de persisiter
        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data){
        //demander à Doctrine de supprmier l'article
        $this->em->remove($data);
        $this->em->flush();

    }
}