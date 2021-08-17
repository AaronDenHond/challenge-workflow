<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSecondLine;

    /**
     * @ORM\ManyToOne(targetEntity=Manager::class, inversedBy="agents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $managerId;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="agent", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsSecondLine(): ?bool
    {
        return $this->isSecondLine;
    }

    public function setIsSecondLine(bool $isSecondLine): self
    {
        $this->isSecondLine = $isSecondLine;

        return $this;
    }

    public function getManagerId(): ?Manager
    {
        return $this->managerId;
    }

    public function setManagerId(?Manager $managerId): self
    {
        $this->managerId = $managerId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
