<?php

namespace App\Doctrine\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Project;
use App\Entity\User;
use App\Repository\ProjectRepository;
use App\Security\Role;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

class DoctrineUserExtension
{
    private TokenStorageInterface $tokenStorage;

    private Security $security;

    private ProjectRepository $projectRepository;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        Security $security,
        ProjectRepository $projectRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->security = $security;
        $this->projectRepository = $projectRepository;
    }

    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ) {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $qb, string $resourceClass): void
    {
        if ($this->security->isGranted(Role::ROLE_ADMIN)) {
            return;
        }

        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();

        $rootAlias = $qb->getRootAliases()[0];

        if (Project::class === $resourceClass) {
            $qb->andWhere(\sprintf('%s.%s = :currentUser', $rootAlias, $this->getResources()[$resourceClass]));
            $qb->setParameter(':currentUser', $user);
        }
    }

    private function getResources(): array
    {
        return [
            Project::class => 'user',
        ];
    }
}
