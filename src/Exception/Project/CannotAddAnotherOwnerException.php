<?php

namespace App\Exception\Project;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CannotAddAnotherOwnerException extends AccessDeniedHttpException
{
    private const MESSAGE = 'You cannot add projects to another user';

    public static function create(): self
    {
        throw new self(self::MESSAGE);
    }
}
