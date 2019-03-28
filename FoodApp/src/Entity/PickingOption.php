<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PickingOptionRepository")
 * @ORM\Table(name="picking_option")
 */
class PickingOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="picking_option_id")
     */
    private $pickingOptionId;

    /**
     * @ORM\Column(type="day")
     */
    private $day;

    /**
     * @ORM\Column(type="string")
     */
    private $beginning;

    /**
     * @ORM\Column(type="string")
     */
    private $ending;

    /**
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="pickingOptions")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     */
    private $address;

    public function getPickingOptionId(): ?int
    {
        return $this->pickingOptionId;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day): void
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getBeginning()
    {
        return $this->beginning;
    }

    /**
     * @param mixed $beginning
     */
    public function setBeginning($beginning): void
    {
        $this->beginning = $beginning;
    }

    /**
     * @return mixed
     */
    public function getEnding()
    {
        return $this->ending;
    }

    /**
     * @param mixed $ending
     */
    public function setEnding($ending): void
    {
        $this->ending = $ending;
    }

    /**
     * @return mixed
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param mixed $offer
     */
    public function setOffer($offer): void
    {
        $this->offer = $offer;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }


}