<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 * @ORM\Table(name="reservation")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="reservation_id")
     */
    private $reservationId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginning;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiration;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinCOlumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offer_id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinCOlumn(name="user_id", referencedColumnName="user_id")
     */
    private $user_id;

    public function getReservationId(): ?int
    {
        return $this->reservationId;
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
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param mixed $expiration
     */
    public function setExpiration($expiration): void
    {
        $this->expiration = $expiration;
    }

    /**
     * @return mixed
     */
    public function getOfferId()
    {
        return $this->offer_id;
    }

    /**
     * @param mixed $offer_id
     */
    public function setOfferId($offer_id): void
    {
        $this->offer_id = $offer_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }
}