<?php


namespace App\Exception\Project;


use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CannotAddAnotherOwnerException extends AccessDeniedHttpException
{
    private const MESSAGE = 'You cannot add another user as owner';

    public static function create(): self
    {
        throw new self(self::MESSAGE);
    }
}