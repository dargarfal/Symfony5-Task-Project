<?php

declare(strict_types=1);

namespace App\Entity;

use App\Security\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    protected ?string $id;

    protected string $name;

    protected string $email;

    protected string $password;

    protected array $roles;

    protected ?\DateTime $createdAt = null;

    protected ?\DateTime $updatedAt = null;

    /** @var Collection|Project[] */
    protected ?Collection $projects = null;

    /**
     * @throws \Exception
     */
    public function __construct(string $name, string $email, string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->name = $name;
        $this->email = $email;
        $this->roles[] = Role::ROLE_USER;
        $this->projects = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
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

    public function getSalt(): void
    {
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
    }

    public function equals(User $user): bool
    {
        return $this->getId() === $user->getId();
    }

    /**
     * @return Project[]|Collection
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProjects(Project $project): void
    {
        $this->projects->add($project);
    }
}
