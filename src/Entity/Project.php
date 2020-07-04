<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;

class Project
{
    private ?string $project_id;

    private string $name;

    private string $description;

    protected \DateTime $createdAt;

    protected \DateTime $updatedAt;

    //Debo crear el objeto de User y configurar la relaciones
    /** @var User */
    protected User $user;

    //Falta crear la coleccion de tasks

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
        $this->user->addProjects($this);
        //Falta inicializar la coleccion de tasks
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

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    //Falta el getter de las tasks

    //Falta el metodo addTasks
}
