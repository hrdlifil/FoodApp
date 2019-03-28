<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
}