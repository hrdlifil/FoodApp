<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRequestRepository")
 * @ORM\Table(name="reservation_request")
 */
class ReservationRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="reservation_request_id")
     */
    private $reservationRequestId;

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

    /**
     * @ORM\Column(type="datetime", name="inserted_at")
     */
    private $insertedAt;

    /**
     * @ORM\Column(type="integer", name="length_in_hours")
     */
    private $lengthInHours;

    public function getReservationRequestId(): ?int
    {
        return $this->reservationRequestId;
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

    /**
     * @return mixed
     */
    public function getInsertedAt()
    {
        return $this->insertedAt;
    }

    /**
     * @param mixed $insertedAt
     */
    public function setInsertedAt($insertedAt): void
    {
        $this->insertedAt = $insertedAt;
    }

    /**
     * @return mixed
     */
    public function getLengthInHours()
    {
        return $this->lengthInHours;
    }

    /**
     * @param mixed $lengthInHours
     */
    public function setLengthInHours($lengthInHours): void
    {
        $this->lengthInHours = $lengthInHours;
    }


}