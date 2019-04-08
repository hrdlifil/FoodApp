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
     *
     * @ORM\Column(type="string")
     *
     */
    private $producerName;

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
     * @return mixed
     */
    public function getBrands()
    {
        return $this->brands;
    }


    /**
     * @return mixed
     */
    public function getProducerName()
    {
        return $this->producerName;
    }

    /**
     * @return mixed
     */
    public function getProducerId()
    {
        return $this->producerId;
    }

    /**
     * @param mixed $producerId
     */
    public function setProducerId($producerId): void
    {
        $this->producerId = $producerId;
    }

    /**
     * @param mixed $producerName
     */
    public function setProducerName($producerName): void
    {
        $this->producerName = $producerName;
    }



    public function __construct()
    {
        $this->brands = new ArrayCollection();
    }

    public function addBrand(Brand $brand)
    {
        $this->brands[] = $brand;
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

    public function getId()
    {
        return $this->producerId;
    }

}
