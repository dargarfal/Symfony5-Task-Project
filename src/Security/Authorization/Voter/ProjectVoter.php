<?php


namespace App\Security\Authorization\Voter;



use App\Entity\Project;
use App\Entity\User;
use App\Security\Role;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProjectVoter extends BaseVoter
{
    private const PROJECT_READ = 'PROJECT_READ';
    private const PROJECT_CREATE = 'PROJECT_CREATE';
    private const PROJECT_UPDATE = 'PROJECT_UPDATE';
    private const PROJECT_DELETE = 'PROJECT_DELETE';

    protected function supports(string $attribute, $subject)
    {
        return \in_array($attribute, $this->getSupportedAttributes(), true);
    }

    /**
     * @param Project\null $subject
     */

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        /** @var User $tokenUser */
        $tokenUser = $token->getUser();

        if (self::PROJECT_READ === $attribute) {
            if (null === $subject) {
                return $this->security->isGranted(Role::ROLE_ADMIN);
            }


        }
    }

    private function getSupportedAttributes(): array
    {
        return [
            self::PROJECT_READ,
            self::PROJECT_CREATE,
            self::PROJECT_UPDATE,
            self::PROJECT_DELETE,
        ];
    }
}