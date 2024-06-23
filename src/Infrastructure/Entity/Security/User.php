<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Security;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="security_user")
 * @ORM\Entity(repositoryClass="App\Repository\Security\UserRepository")
 */
class User implements EntityInterface,UserInterface
{
    use EntityTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Code unique d'identification
     *
     * @var string
     * @ORM\Column(name="code", type="string", length=255, nullable=false, unique=true)
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", name="email", unique=true, nullable=false)
     */
    protected $email;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="enabled", nullable=false)
     */
    protected $enabled = false;

    /**
     * @var string
     * @ORM\Column(type="string", name="enable_confirmation_token", unique=true, nullable=true)
     */
    protected $enableConfirmationToken;

    /**
     * @var string
     * @ORM\Column(type="string", name="reset_password_token", unique=true, nullable=true)
     */
    protected $resetPasswordToken;

    /**
    * @var string
    * @ORM\Column(type="string", name="api_token", unique=true, nullable=true)
    */
    private $apiToken;

    /**
     * None encrypted password. Must never be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     * @ORM\Column(type="string", name="password", unique=false, nullable=false)
     */
    protected $password;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", name="last_login", nullable=true)
     */
    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string|null
     * @ORM\Column(type="string", name="confirmation_token", unique=true, nullable=true)
     */
    protected $confirmationToken;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", name="password_requested_at", nullable=true)
     */
    protected $passwordRequestedAt;

    /**
     * @var array
     * @ORM\Column(type="array", name="roles", nullable=true)
     */
    protected $roles;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="\App\Infrastructure\Entity\Security\UserRoleObject", mappedBy="user")
     */
    private $userRoleObjects;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->enabled = false;
        $this->roles = [];
        $this->code = Uuid::uuid4()->toString();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return User
     */
    public function setEnabled(bool $enabled): User
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnableConfirmationToken(): ?string
    {
        return $this->enableConfirmationToken;
    }

    /**
     * @param string|null $enableConfirmationToken
     * @return $this
     */
    public function setEnableConfirmationToken(?string $enableConfirmationToken): User
    {
        $this->enableConfirmationToken = $enableConfirmationToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getResetPasswordToken(): ?string
    {
        return $this->resetPasswordToken;
    }

    /**
     * @param string|null $resetPasswordToken
     * @return $this
     */
    public function setResetPasswordToken(?string $resetPasswordToken): User
    {
        $this->resetPasswordToken = $resetPasswordToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return User
     */
    public function setPlainPassword(string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     * @return User
     */
    public function setApiToken(string $apiToken): User
    {
        $this->apiToken = $apiToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime|null $lastLogin
     * @return User
     */
    public function setLastLogin(?\DateTime $lastLogin): User
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    /**
     * @param string|null $confirmationToken
     * @return User
     */
    public function setConfirmationToken(?string $confirmationToken): User
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getPasswordRequestedAt(): ?\DateTime
    {
        return $this->passwordRequestedAt;
    }

    /**
     * @param \DateTime|null $passwordRequestedAt
     * @return User
     */
    public function setPasswordRequestedAt(?\DateTime $passwordRequestedAt): User
    {
        $this->passwordRequestedAt = $passwordRequestedAt;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param string $role
     * @return User
     * @throws \Exception
     */
    public function addRole(string $role): User
    {
        if (!in_array($role, RoleObject::ALL_ROLES)) {
            throw new \Exception(sprintf('Invalid role: <%s>', $role));
        }
        $roles = $this->getRoles();
        if (!in_array($role, $roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $role
     * @return User
     * @throws \Exception
     */
    public function removeRole(string $role): User
    {
        if (!in_array($role, RoleObject::ALL_ROLES)) {
            throw new \Exception(sprintf('Invalid role: <%s>', $role));
        }
        $roles = $this->getRoles();
        if (in_array($role, $roles)) {
            $key = array_search($role, $roles);
            unset($this->roles[$key]);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRoleObjects()
    {
        return $this->userRoleObjects;
    }

    /**
     * @param ArrayCollection $userRoleObjects
     * @return User
     */
    public function setUserRoleObjects(ArrayCollection $userRoleObjects): User
    {
        $this->userRoleObjects = $userRoleObjects;
        return $this;
    }

    /**
     * @param UserRoleObject $userRoleObject
     * @return UserInterface
     */
    public function addUserRoleObject(UserRoleObject $userRoleObject) : UserInterface
    {
        if(!$this->userRoleObjects->contains($userRoleObject)){
            $this->userRoleObjects->add($userRoleObject);
        }
        return $this;
    }

    /**
     * @param UserRoleObject $userRoleObject
     * @return UserInterface
     */
    public function removeUserRoleObject(UserRoleObject $userRoleObject) : UserInterface
    {
        if($this->userRoleObjects->contains($userRoleObject)){
            $this->userRoleObjects->removeElement($userRoleObject);
        }
        return $this;
    }

    /**
     * Get array without nested ArrayCollection and Entity object
     * Avoid cyclic redundancies
     *
     * @return mixed
     */
    public function toTinnyArray()
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'enabled' => $this->isEnabled(),
            'roles' => $this->getRoles(),
        ];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
