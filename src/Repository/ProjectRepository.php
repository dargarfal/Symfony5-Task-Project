<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\User;

class ProjectRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Project::class;
    }

    public function findOneById(string $id): ?Project
    {
        /** @var Project $project */
        $project = $this->objectRepository->find($id);

        return $project;
    }

    public function userIsOwner(Project $project, User $user): bool
    {
        if ($project->getUser()->getId() === $user->getId()) {
            return true;
        }

        return false;
    }
}
