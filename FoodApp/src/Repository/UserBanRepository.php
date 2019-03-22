<?php

namespace App\Repository;

use App\Entity\UserBan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserBan|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBan|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBan[]    findAll()
 * @method UserBan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBanRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserBan::class);
    }

    // /**
    //  * @return UserBan[] Returns an array of UserBan objects
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

    /*
    public function findOneBySomeField($value): ?UserBan
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
