<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserBanRepository")
 * @ORM\Table(name="user_ban")
 */
class UserBan
{
    /**
     * Unidirectional mapping protoze podle meho se to zde hodi
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }
}
