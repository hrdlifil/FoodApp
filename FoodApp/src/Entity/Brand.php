<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrandRepository")
 */
class Brand
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="brand_id")
     */
    private $brandId;

    /**
     * @ORM\Column(type="string", name="brand_name")
     */
    private $brandName;

    /**
     * JoinColumn rika ze to je sloupec ve kterem jsou cizi klice s jmenem producer_id ktere
     * odkazuji na producer_id z tabulky producer
     * Entita ve ktere jsou cizi klice je vzdy ManyToOne a ne OneToMany a ma vzdy inversedBy
     * protoze mappedBy ma ta druha, ktera nema cizi klice
     * @ORM\ManyToOne(targetEntity="Producer", inversedBy="brands")
     * @ORM\JoinColumn(name="producer_id", referencedColumnName="producer_id")
     *
     */
    private $producer;

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
     * @return mixed
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * @param mixed $brandName
     */
    public function setBrandName($brandName): void
    {
        $this->brandName = $brandName;
    }

    /**
     * @return mixed
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param mixed $producer
     */
    public function setProducer($producer): void
    {
        $this->producer = $producer;
    }

    public function getId()
    {
        return $this->brandId;
    }




}
