<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRequestRepository")
 * @ORM\Table(name="reservation_request")
 */
class ReservationRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="message_id")
     */
    private $reservationRequestId;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinCOlumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offerId;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinCOlumn(name="user_id", referencedColumnName="user_id")
     */
    private $userId;

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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
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