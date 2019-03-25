<?php


namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $userId;

    /**
     * @ORM\Column(type="datetime", name="insertedAt")
     */
    private $insertedAt;

    /**
     * @ORM\Column(type="string")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $userRatingId;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offerId;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $reservationId;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $reservationRequestId;

    /**
     * @ORM\Column(type="notification_type")
     */
    private $type;

    public function getNotificationId(): ?int
    {
        return $this->notificationId;
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
    public function getUserRatingId()
    {
        return $this->userRatingId;
    }

    /**
     * @param mixed $userRatingId
     */
    public function setUserRatingId($userRatingId): void
    {
        $this->userRatingId = $userRatingId;
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
    public function getReservationId()
    {
        return $this->reservationId;
    }

    /**
     * @param mixed $reservationId
     */
    public function setReservationId($reservationId): void
    {
        $this->reservationId = $reservationId;
    }

    /**
     * @return mixed
     */
    public function getReservationRequestId()
    {
        return $this->reservationRequestId;
    }

    /**
     * @param mixed $reservationRequestId
     */
    public function setReservationRequestId($reservationRequestId): void
    {
        $this->reservationRequestId = $reservationRequestId;
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