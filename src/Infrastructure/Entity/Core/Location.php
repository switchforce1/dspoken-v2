<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Core;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\Common\WeightDisplayableTrait;
use App\Infrastructure\Entity\EntityInterface;
use App\Infrastructure\Entity\Security\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Information de localisation
 */
#[ORM\Table(name: 'core_location')]
#[ORM\Entity(repositoryClass: \App\Infrastructure\Repository\Core\LocationRepository::class)]
class Location implements EntityInterface
{
    use EntityTrait,
        WeightDisplayableTrait,
        TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'string', length: 255, nullable: false)]
    private string $code;

    #[ORM\Column(name: 'label', type: 'string', length: 255, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(name: 'country_code', type: 'string', length: 255, nullable: true)]
    private ?string $countryCode = null;

    #[ORM\Column(name: 'region', type: 'string', length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(name: 'people', type: 'string', length: 255, nullable: true)]
    private ?string $people = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'latitude', type: 'float', length: 255, nullable: false)]
    private float $latitude;

    /**
     * @var string
     */
    #[ORM\Column(name: 'longitude', type: 'float', length: 255, nullable: false)]
    private float $longitude;

    /**
     * @var string
     */
    #[ORM\Column(name: 'extended_length', type: 'float', nullable: true)]
    private ?float $extendedLength = null;

    /**
     * @var integer
     */
    #[ORM\Column(name: 'raduis', type: 'integer', nullable: true)]
    private ?int $raduis = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'circumstances', type: 'text', nullable: true)]
    private ?string $circumstances = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'is_main', type: 'boolean', nullable: false)]
    private bool $isMain = false;

    /**
     * @var Language
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\Language::class, inversedBy: 'locations')]
    private ?\App\Infrastructure\Entity\Core\Language $language = null;

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Security\User::class)]
    protected ?\App\Infrastructure\Entity\Security\User $creator = null;

    /**
     * Location constructor.
     */
    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
     * @param string $code
     * @return Location
     */
    public function setCode(string $code): Location
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return Location
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Location
     */
    public function setLatitude(?float $latitude): Location
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Location
     */
    public function setLongitude(?float $longitude): Location
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtendedLength(): ?float
    {
        return $this->extendedLength;
    }

    /**
     * @param string $extendedLength
     * @return Location
     */
    public function setExtendedLength(?float $extendedLength): Location
    {
        $this->extendedLength = $extendedLength;
        return $this;
    }

    /**
     * @return int
     */
    public function getRaduis(): ?int
    {
        return $this->raduis;
    }

    /**
     * @param int $raduis
     * @return Location
     */
    public function setRaduis(int $raduis): Location
    {
        $this->raduis = $raduis;
        return $this;
    }

    /**
     * @return string
     */
    public function getCircumstances(): ?string
    {
        return $this->circumstances;
    }

    /**
     * @param string $circumstances
     * @return Location
     */
    public function setCircumstances(?string $circumstances): Location
    {
        $this->circumstances = $circumstances;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     * @return Location
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     * @return Location
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * @param mixed $people
     * @return Location
     */
    public function setPeople($people)
    {
        $this->people = $people;
        return $this;
    }

    /**
     * @return User
     */
    public function getCreator(): ?User
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     * @return Location
     */
    public function setCreator(?User $creator): Location
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return Language
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @param Language $language
     * @return Location
     */
    public function setLanguage(?Language $language): Location
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get the value of isMain
     *
     * @return  bool
     */ 
    public function getIsMain()
    {
        return $this->isMain;
    }

    /**
     * Set the value of isMain
     *
     * @param  bool  $isMain
     *
     * @return  self
     */ 
    public function setIsMain(bool $isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    public function isMain(): ?bool
    {
        return $this->isMain;
    }

    public function setMain(bool $isMain): static
    {
        $this->isMain = $isMain;

        return $this;
    }
}
