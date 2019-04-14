<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", name="comment")
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime", name="rating_time")
     */
    private $ratingTime;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="user_id")
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="user_id")
     */
    private $receiver;

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
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param mixed $receiver
     */
    public function setReceiver($receiver): void
    {
        $this->receiver = $receiver;
    }
}