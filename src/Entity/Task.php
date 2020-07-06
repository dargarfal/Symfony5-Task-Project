<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;

class Task
{
    private string $task_id;

    private string $name;

    private string $description;

    private Project $project;

    protected ?\DateTime $createdAt = null;

    protected ?\DateTime $updatedAt = null;

    /**
     * @throws \Exception
     */
    public function __construct(
        string $name,
        string $description,
        Project $project)
    {
        $this->name = $name;
        $this->description = $description;
        $this->task_id = Uuid::uuid4()->toString();
        $this->project = $project;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    public function getTaskId(): string
    {
        return $this->task_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated()
    {
        $this->updatedAt = new \DateTime();
    }

    public function isOwnerBy(User $user): bool
    {
        return $this->getProject()->getUser()->getId() === $user->getId();
    }

    public function isProjectBy(Project $project): bool
    {
        return $this->project->getProjectId() === $project->getProjectId();
    }
}
