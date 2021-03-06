<?php

namespace App\Repository;

use App\Entity\Task;

class TaskRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Task::class;
    }

    public function save(Task $task): void
    {
        $this->saveEntity($task);
    }
}
