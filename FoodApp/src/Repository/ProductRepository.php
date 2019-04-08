<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProductByBrandAndCategory($znacka, $kategorie)
    {
        $gb = $this->createQueryBuilder("p");
        $gb->select("p")->where("p.brand = :znacka")->andWhere("p.category = :kategorie")
            ->setParameters(array("znacka" => $znacka, "kategorie" => $kategorie));


        return $gb->getQuery()->getResult();
    }

    public function getProductByCategory($kategorie)
    {
        $gb = $this->createQueryBuilder("p");
        $gb->select("p")->Where("p.category = :kategorie")
            ->setParameters(array("kategorie" => $kategorie));


        return $gb->getQuery()->getResult();
    }

    public function getProductByBrand($znacka)
    {
        $gb = $this->createQueryBuilder("p");
        $gb->select("p")->where("p.brand = :znacka")
            ->setParameters(array("znacka" => $znacka));


        return $gb->getQuery()->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
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
    public function findOneBySomeField($value): ?Product
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
