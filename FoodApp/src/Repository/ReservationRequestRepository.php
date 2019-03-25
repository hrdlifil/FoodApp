<?php

namespace App\Repository;

use App\Entity\ReservationRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReservationRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationRequest[]    findAll()
 * @method ReservationRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRequestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReservationRequest::class);
    }

    // /**
    //  * @return ReservationRequest[] Returns an array of ReservationRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationRequest
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
