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
     * @ORM\Column(type="integer", name="product_id")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="product_name")
     */
    private $productName;

    /**
     * category_type je Enum, ktery jsem si sam vytvoril
     * @ORM\Column(type="category_type", name="category")
     */
    private $categoryType;

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getCategoryType()
    {
        return $this->categoryType;
    }

    /**
     * @param mixed $categoryType
     */
    public function setCategoryType($categoryType): void
    {
        $this->categoryType = $categoryType;
    }

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param mixed $brandId
     */
    public function setBrandId($brandId): void
    {
        $this->brandId = $brandId;
    }

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
