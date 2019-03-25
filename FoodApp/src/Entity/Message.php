<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 * @ORM\Table(name="message")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="message_id")
     */
    private $messageId;

    /**
     * @ORM\Column(type="string")
     */
    private $text;


    /**
     * @ORM\Column(type="datetime", name="time_of_sending")
     */
    private $timeOfSending;

    /**
     * @ORM\Column(type="boolean", name="sender_deleted")
     */
    private $senderDeleted;

    /**
     * @ORM\Column(type="boolean", name="receiver_deleted")
     */
    private $receiverDeleted;

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

    public function getMessageId(): ?int
    {
        return $this->messageId;
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
    public function getTimeOfSending()
    {
        return $this->timeOfSending;
    }

    /**
     * @param mixed $timeOfSending
     */
    public function setTimeOfSending($timeOfSending): void
    {
        $this->timeOfSending = $timeOfSending;
    }

    /**
     * @return mixed
     */
    public function getSenderDeleted()
    {
        return $this->senderDeleted;
    }

    /**
     * @param mixed $senderDeleted
     */
    public function setSenderDeleted($senderDeleted): void
    {
        $this->senderDeleted = $senderDeleted;
    }

    /**
     * @return mixed
     */
    public function getReceiverDeleted()
    {
        return $this->receiverDeleted;
    }

    /**
     * @param mixed $receiverDeleted
     */
    public function setReceiverDeleted($receiverDeleted): void
    {
        $this->receiverDeleted = $receiverDeleted;
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