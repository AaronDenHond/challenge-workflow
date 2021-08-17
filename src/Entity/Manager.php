<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass=ManagerRepository::class)
 */
class Manager extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="manager", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?User
    {
        return $this->userID;
    }

    public function setUserID(User $userID): self
    {
        $this->userID = $userID;

        return $this;
    }
}
