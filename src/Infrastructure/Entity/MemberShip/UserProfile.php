<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\MemberShip;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Complementary user's informations that are not directly related to security context
 * Class UserProfile
 * @package App\Infrastructure\Entity\MemberShip
 * @ORM\Table(name="member_ship_user_profile")
 * @ORM\Entity(repositoryClass="App\Repository\MemberShip\GroupRepository")
 */
class UserProfile implements EntityInterface
{
    use IdentifierTrait,
        EntityTrait,
        TimestampableTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=false)
     */
    private $code;

    /**
     * Replicated username by default
     * @var string
     *
     * @ORM\Column(name="public_username", type="string", nullable=false)
     */
    private $publicUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="origin_country_code", type="string", nullable=true)
     */
    private $originCountryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="living_country_code", type="string", nullable=true)
     */
    private $livingCountryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * UserProfile constructor.
     */
    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return UserProfile
     */
    public function setCode(string $code): UserProfile
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublicUsername(): string
    {
        return $this->publicUsername;
    }

    /**
     * @param string $publicUsername
     * @return UserProfile
     */
    public function setPublicUsername(string $publicUsername): UserProfile
    {
        $this->publicUsername = $publicUsername;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return UserProfile
     */
    public function setFirstName(string $firstName): UserProfile
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserProfile
     */
    public function setLastName(string $lastName): UserProfile
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate(): \DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     * @return UserProfile
     */
    public function setBirthdate(\DateTime $birthdate): UserProfile
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginCountryCode(): string
    {
        return $this->originCountryCode;
    }

    /**
     * @param string $originCountryCode
     * @return UserProfile
     */
    public function setOriginCountryCode(string $originCountryCode): UserProfile
    {
        $this->originCountryCode = $originCountryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLivingCountryCode(): string
    {
        return $this->livingCountryCode;
    }

    /**
     * @param string $livingCountryCode
     * @return UserProfile
     */
    public function setLivingCountryCode(string $livingCountryCode): UserProfile
    {
        $this->livingCountryCode = $livingCountryCode;
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
     * @return UserProfile
     */
    public function setDescription(string $description): UserProfile
    {
        $this->description = $description;
        return $this;
    }
}