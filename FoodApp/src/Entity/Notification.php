<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 * @ORM\Table(name="notification")
 */
class Notification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="notification_id")
     */
    private $notificationId;

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
     * @ORM\Column(type="string")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_rating_id", referencedColumnName="user_id")
     */
    private $userRating;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumn(name="reservation_id", referencedColumnName="reservation_id")
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationRequest")
     * @ORM\JoinColumn(name="reservation_request_id", referencedColumnName="reservation_request_id")
     */
    private $reservationRequest;

    /**
     * @ORM\Column(type="notification_type", name="notification_type")
     */
    private $type;

    public function getNotificationId(): ?int
    {
        return $this->notificationId;
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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getUserRating()
    {
        return $this->userRating;
    }

    /**
     * @param mixed $userRating
     */
    public function setUserRating($userRating): void
    {
        $this->userRating = $userRating;
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
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * @param mixed $reservation
     */
    public function setReservation($reservation): void
    {
        $this->reservation = $reservation;
    }

    /**
     * @return mixed
     */
    public function getReservationRequest()
    {
        return $this->reservationRequest;
    }

    /**
     * @param mixed $reservationRequest
     */
    public function setReservationRequest($reservationRequest): void
    {
        $this->reservationRequest = $reservationRequest;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }


}