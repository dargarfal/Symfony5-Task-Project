<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

class Project
{
    private ?string $project_id;

    private string $name;

    private string $description;

    protected ?\DateTime $createdAt = null;

    protected ?\DateTime $updatedAt = null;

    protected User $user;

    /** @var Collection|Task[] */
    protected ?Collection $tasks = null;

    /**
     * @throws \Exception
     */
    public function __construct(string $name, string $description, string $project_id = null, User $user)
    {
        $this->name = $name;
        $this->description = $description;
        $this->project_id = $project_id ?? Uuid::uuid4()->toString();
        $this->createdAt = new \DateTime();
        $this->user = $user;
        $this->tasks = new ArrayCollection();
        $this->markAsUpdated();
    }

    public function getProjectId(): ?string
    {
        return $this->project_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function isOwnerBy(User $user): bool
    {
        return $this->getUser()->getId() === $user->getId();
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }
}
