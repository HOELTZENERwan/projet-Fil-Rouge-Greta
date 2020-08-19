<?php

namespace App\Repository;

use App\Entity\StatutFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatutFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutFrais[]    findAll()
 * @method StatutFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutFraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutFrais::class);
    }

    // /**
    //  * @return StatutFrais[] Returns an array of StatutFrais objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Frais
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
