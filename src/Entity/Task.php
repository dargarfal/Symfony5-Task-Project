<?php


namespace App\Entity;


use Ramsey\Uuid\Uuid;

class Task
{
    private string $task_id;

    private string $name;

    private string $description;

    private Project $project;

    protected \DateTime $createdAt;

    protected \DateTime $updatedAt;

    /**
     * @throws \Exception
     */
    public function __construct(
        string $name,
        string $description,
        Project $project,
        string $task_id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->task_id = $task_id ?? Uuid::uuid4()->toString();
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

}