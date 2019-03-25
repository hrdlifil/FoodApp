<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PickingOptionRepository")
 * @ORM\Table(name="picking_option")
 */
class PickingOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="notification_id")
     */
    private $pickingOptionId;

    /**
     * @ORM\Column(type="day")
     */
    private $day;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginning;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id", inversedBy="pickingOptions")
     */
    private $offerId;

    /**
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     */
    private $addressId;

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
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end): void
    {
        $this->end = $end;
    }

    /**
     * @return mixed
     */
    public function getOfferId()
    {
        return $this->offerId;
    }

    /**
     * @param mixed $offerId
     */
    public function setOfferId($offerId): void
    {
        $this->offerId = $offerId;
    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * @param mixed $addressId
     */
    public function setAddressId($addressId): void
    {
        $this->addressId = $addressId;
    }


}