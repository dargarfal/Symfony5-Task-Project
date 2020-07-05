<?php

namespace App\Api\Listener\Task;

use App\Api\Listener\PreWriteListener;
use App\Entity\Task;
use App\Entity\User;
use App\Exception\Project\CannotAddAnotherOwnerException;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TaskPreWriteListener implements PreWriteListener
{
    private const POST_TASK = 'api_tasks_post_collection';

    private TokenStorageInterface $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function onKernelView(ViewEvent $event): void
    {
        /** @var User $tokenUser */
        $tokenUser = $this->tokenStorage->getToken()->getUser();

        $request = $event->getRequest();

        if (self::POST_TASK === $request->get('_route')) {
            /** @var Task $task */
            $task = $event->getControllerResult();

            if (!$task->isOwnerBy($tokenUser)) {
                throw CannotAddAnotherOwnerException::create();
            }
        }
    }
}
