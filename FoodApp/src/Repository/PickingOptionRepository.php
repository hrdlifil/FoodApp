<?php

namespace App\Repository;

use App\Entity\PickingOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PickingOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method PickingOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method PickingOption[]    findAll()
 * @method PickingOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PickingOptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PickingOption::class);
    }

    // /**
    //  * @return PickingOption[] Returns an array of PickingOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PickingOption
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
