<?php
declare(strict_types=1);

namespace App\Entity\MemberShip;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\IdentifierTrait;
use App\Entity\EntityInterface;
use App\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserGroup
 * @package App\Entity\MemberShip
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
     */
    private $user;

    /**
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\MemberShip\Group")
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