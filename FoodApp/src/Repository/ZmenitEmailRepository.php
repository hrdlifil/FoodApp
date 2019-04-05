<?php

namespace App\Repository;

use App\Entity\ZmenitEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ZmenitEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZmenitEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZmenitEmail[]    findAll()
 * @method ZmenitEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZmenitEmailRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ZmenitEmail::class);
    }

    // /**
    //  * @return ZmenitEmail[] Returns an array of ZmenitEmail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZmenitEmail
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
