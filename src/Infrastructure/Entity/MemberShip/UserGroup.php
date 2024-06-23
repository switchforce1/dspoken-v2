<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\MemberShip;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use App\Infrastructure\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserGroup
 * @package App\Infrastructure\Entity\MemberShip
 * @ORM\Table(name="member_ship_user_group")
 * @ORM\Entity(repositoryClass="App\Repository\MemberShip\UserGroupRepository")
 */
class UserGroup implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Security\User")
     */
    private $user;

    /**
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\MemberShip\Group")
     */
    private $group;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return UserGroup
     */
    public function setUser(User $user): UserGroup
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Group
     */
    public function getGroup(): Group
    {
        return $this->group;
    }

    /**
     * @param Group $group
     * @return UserGroup
     */
    public function setGroup(Group $group): UserGroup
    {
        $this->group = $group;
        return $this;
    }
}