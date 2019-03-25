<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 * @ORM\Table(name="rating")
 */
class Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="rating_id")
     */
    private $ratingId;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="integer")
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime", name="rating_time")
     */
    private $ratingTime;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinCOlumn(name="user_id", referencedColumnName="user_id")
     */
    private $senderId;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinCOlumn(name="user_id", referencedColumnName="user_id")
     */
    private $receiverId;

    public function getRatingId(): ?int
    {
        return $this->ratingId;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points): void
    {
        $this->points = $points;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getRatingTime()
    {
        return $this->ratingTime;
    }

    /**
     * @param mixed $ratingTime
     */
    public function setRatingTime($ratingTime): void
    {
        $this->ratingTime = $ratingTime;
    }

    /**
     * @return mixed
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * @param mixed $senderId
     */
    public function setSenderId($senderId): void
    {
        $this->senderId = $senderId;
    }

    /**
     * @return mixed
     */
    public function getReceiverId()
    {
        return $this->receiverId;
    }

    /**
     * @param mixed $receiverId
     */
    public function setReceiverId($receiverId): void
    {
        $this->receiverId = $receiverId;
    }
}