<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="product_name")
     */
    private $productName;

    /**
     * category_type je Enum, ktery jsem si sam vytvoril
     * @ORM\Column(type="category_type")
     */
    private $categoryType;

    /**
     * Zde neni bidirectional mapping, protoze podle me nema smysl, aby si brand udrzoval
     * pole vsech produktu, ktere brand ma
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="brand_id")
     */
    private $brandId;

    public function getId(): ?int
    {
        return $this->id;
    }
}
