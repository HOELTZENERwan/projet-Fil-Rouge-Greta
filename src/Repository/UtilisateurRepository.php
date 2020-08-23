<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }


    /**
     * @return int|mixed|string
     */

    public function countUtilisateurs(){
        $queryBuilder = $this->createQueryBuilder('utilisateur');
        $queryBuilder->select('COUNT(utilisateur.id) as value');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }



    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $utilisateur, string $newEncodedPassword): void
    {
        if (!$utilisateur instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($utilisateur)));
        }

        $utilisateur->setPassword($newEncodedPassword);
        $this->_em->persist($utilisateur);
        $this->_em->flush();
    }

    // /**
    //  * @return Utilisateur[] Returns an array of Utilisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneByRole(): ?Utilisateur
    {
        return $this->createQueryBuilder('utilisateur')
        ->where("utilisateur.prenom = 'Estelle'")
            // ->where("utilisateur.roles LIKE '%ROLE_SUPER_ADMIN%'")
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    

//     public function findAllGreaterThanPrice($price): array
// {
//     $conn = $this->getEntityManager()->getConnection();

//     $sql = '
//         SELECT * FROM product p
//         WHERE p.price > :price
//         ORDER BY p.price ASC
//         ';
//     $stmt = $conn->prepare($sql);
//     $stmt->execute(['price' => $price]);

//     // returns an array of arrays (i.e. a raw data set)
//     return $stmt->fetchAll();
// }
}
