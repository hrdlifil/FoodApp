<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProducerRepository")
 * @ORM\Table(name="producer")
 */
class Producer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="producer_id")
     */
    private $producerId;

    /**
     * country_of_origin jr Enum, ktery jsem si sam vytvoril
     * @ORM\Column(type="country_of_origin")
     *
     */
    private $countryOfOrigin;

    /**
     * mappedBy rika, ze producer je jmeno php promene v Entite Brand ktere je namapovano na cizi klic producer_id
     * @ORM\OneToMany(targetEntity="Brand", mappedBy="producer")
     *
     */
    private $brands;

    /**
     * @return ArrayCollection
     */
    public function getBrand(): ArrayCollection
    {
        return $this->brand;
    }

    /**
     * @param ArrayCollection $brand
     */
    public function setBrand(ArrayCollection $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * @param mixed $brands
     */
    public function setBrands($brands): void
    {
        $this->brands = $brands;
    }

    /**
     * @return mixed
     */
    public function getProducerName()
    {
        return $this->producerName;
    }

    /**
     * @param mixed $producerName
     */
    public function setProducerName($producerName): void
    {
        $this->producerName = $producerName;
    }

    /**
     *
     * @ORM\Column(type="string")
     *
     */
    private $producerName;

    public function __construct()
    {
        $this->brand = new ArrayCollection();
    }

    public function addBrand(Brand $brand)
    {
        $this->brand[] = $brand;
    }

    /**
     * @return mixed
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @param mixed $countryOfOrigin
     */
    public function setCountryOfOrigin($countryOfOrigin): void
    {
        $this->countryOfOrigin = $countryOfOrigin;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
