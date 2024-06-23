<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity\Security;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserRoleObject
 * @package App\Infrastructure\Entity\Security
 */
#[ORM\Table(name: 'security_user_role_object')]
#[ORM\Entity(repositoryClass: \App\Repository\Security\UserRoleObjectRepository::class)]
class UserRoleObject implements EntityInterface
{
    use EntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var RoleObject
     */
    #[ORM\ManyToOne(
        targetEntity: RoleObject::class,
        inversedBy: 'userRoleObjects'
    )]
    private ?RoleObject $roleObject = null;

    /**
     * @var User
     */
    #[ORM\ManyToOne(
        targetEntity: User::class,
        inversedBy: 'userRoleObjects'
    )]
    private ?User $user = null;

    /**
     * @var \DateTimeInterface
     */
    private $createAt;

    /**
     * UserRoleObject constructor.
     */
    public function __construct()
    {
        $this->createAt = new \DateTime();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UserRoleObject
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return RoleObject
     */
    public function getRoleObject(): RoleObject
    {
        return $this->roleObject;
    }

    /**
     * @param RoleObject $roleObject
     * @return UserRoleObject
     */
    public function setRoleObject(RoleObject $roleObject): UserRoleObject
    {
        $this->roleObject = $roleObject;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return UserRoleObject
     */
    public function setUser(User $user): UserRoleObject
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    /**
     * @param \DateTime $createAt
     * @return UserRoleObject
     */
    public function setCreateAt(\DateTime $createAt): UserRoleObject
    {
        $this->createAt = $createAt;
        return $this;
    }
}
