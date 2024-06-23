<?php

namespace App\Infrastructure\Entity\Security;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'security_role_object')]
#[ORM\Entity(repositoryClass: \App\Repository\Security\RoleObjectRepository::class)]
class RoleObject implements EntityInterface
{
    use EntityTrait;

    const ROLE_ADMIN = "ROLE_ADMIN";
    const ROLE_SUPER_ADMIN = "ROLE_SUPER_ADMIN";
    const ROLE_USER = "ROLE_USER";
    const ROLE_GUEST = "ROLE_GUEST";
    const ROLE_MANAGER = "ROLE_MANAGER";
    const ROLE_ANONYMOUS = "ROLE_ANONYMOUS";

    const ALL_ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_SUPER_ADMIN,
        self::ROLE_USER,
        self::ROLE_GUEST,
        self::ROLE_MANAGER,
        self::ROLE_ANONYMOUS,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255, nullable: false, unique: true)]
    private string $label;

    /**
     * @var string
     */
    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $code = null;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(
        targetEntity: UserRoleObject::class,
         mappedBy: 'roleObject'
    )]
    private \Doctrine\Common\Collections\Collection $userRoleObjects;

    /**
     * RoleObject constructor.
     */
    public function __construct()
    {
        $this->userRoleObjects = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return RoleObject
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return RoleObject
     */
    public function setDescription(string $description): RoleObject
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return RoleObject
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getUserRoleObjects()
    {
        return $this->userRoleObjects;
    }

    /**
     * @param ArrayCollection $userRoleObjects
     * @return RoleObject
     */
    public function setUserRoleObjects(ArrayCollection $userRoleObjects): RoleObject
    {
        $this->userRoleObjects = $userRoleObjects;
        return $this;
    }

    public function addUserRoleObject(UserRoleObject $userRoleObject): static
    {
        if (!$this->userRoleObjects->contains($userRoleObject)) {
            $this->userRoleObjects->add($userRoleObject);
            $userRoleObject->setRoleObject($this);
        }

        return $this;
    }

    public function removeUserRoleObject(UserRoleObject $userRoleObject): static
    {
        if ($this->userRoleObjects->removeElement($userRoleObject)) {
            // set the owning side to null (unless already changed)
            if ($userRoleObject->getRoleObject() === $this) {
                $userRoleObject->setRoleObject(null);
            }
        }

        return $this;
    }
}
