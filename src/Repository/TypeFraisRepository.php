<?php

namespace App\Repository;

use App\Entity\TypeFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeFrais[]    findAll()
 * @method TypeFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeFraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeFrais::class);
    }


    /**
     * @return int|mixed|string
     */
    public function countTypeFrais(){
        $queryBuilder = $this->createQueryBuilder('type');
        $queryBuilder->select('COUNT(type.id) as value');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }


    // /**
    //  * @return TypeFrais[] Returns an array of TypeFrais objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeFrais
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
