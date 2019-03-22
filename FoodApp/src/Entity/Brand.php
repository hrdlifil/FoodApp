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
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * JoinColumn rika ze to je sloupec ve kterem jsou cizi klice s jmenem producer_id ktere
     * odkazuji na producer_id z tabulky producer
     * Entita ve ktere jsou cizi klice je vzdy ManyToOne a ne OneToMany a ma vzdy inversedBy
     * protoze mappedBy ma ta druha, ktera nema cizi klice
     * @ORM\ManyToOne(targetEntity="Producer", inversedBy="brands")
     * @ORM\JoinCOlumn(name="producer_id", referencedColumnName="producer_id")
     *
     */
    private $producer;

    public function getId(): ?int
    {
        return $this->id;
    }
}
