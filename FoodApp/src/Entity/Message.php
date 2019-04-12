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
     * @ORM\Column(type="string", name="subject")
     */
    private $subject;

    /**
     * @ORM\Column(type="datetime", name="time_of_sending")
     */
    private $timeOfSending;

    /**
     * @ORM\Column(type="boolean", name="sender_deleted")
     */
    private $senderDeleted = false;

    /**
     * @ORM\Column(type="boolean", name="receiver_deleted")
     */
    private $receiverDeleted = false;

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

    /**
     * @ORM\Column(type="boolean", name="read_by_reciever")
     */
    private $readByReciever = false;

    public function getTimeOfSendingString()
    {
        return $this->timeOfSending->format('d-m-y H:i:s');
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getReadByReciever()
    {
        return $this->readByReciever;
    }

    /**
     * @param mixed $readByReciever
     */
    public function setReadByReciever($readByReciever): void
    {
        $this->readByReciever = $readByReciever;
    }



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