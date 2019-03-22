<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 * @ORM\Table(name="address")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="address_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $street;

    /**
     * @ORM\Column(type="string")
     */
    private $town;

    /**
     * @ORM\Column(type="integer")
     */
    private $houseNumber;

    /**
     * @ORM\Column(type="integer", name="postcode")
     */
    private $postCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town): void
    {
        $this->town = $town;
    }

    /**
     * @return mixed
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @param mixed $houseNumber
     */
    public function setHouseNumber($houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param mixed $postCode
     */
    public function setPostCode($postCode): void
    {
        $this->postCode = $postCode;
    }
}
