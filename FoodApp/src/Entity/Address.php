<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private $addressId;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $street;

    /**
     * @ORM\Column(type="string", name="popis_adresy")
     */
    private $popisAdresy;

    /**
     * @return mixed
     */
    public function getPopisAdresy()
    {
        return $this->popisAdresy;
    }

    /**
     * @param mixed $popisAdresy
     */
    public function setPopisAdresy($popisAdresy): void
    {
        $this->popisAdresy = $popisAdresy;
    }

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $town;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $houseNumber;

    /**
     * @ORM\Column(type="string", name="postcode")
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
    private $postCode;

    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    public function toString()
    {
        return $this->town . "-" . $this->street . "-" . $this->houseNumber . "-" . $this->postCode;
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
