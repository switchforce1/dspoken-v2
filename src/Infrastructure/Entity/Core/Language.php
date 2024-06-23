<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Core;

use App\Infrastructure\Entity\Common\AppFile;
use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\Publishable;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\Common\WeightDisplayableTrait;
use App\Infrastructure\Entity\EntityInterface;
use App\Infrastructure\Entity\Security\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * La langue créée
 */
#[ORM\Table(name: 'core_language')]
#[ORM\Entity(repositoryClass: \App\Repository\Core\LanguageRepository::class)]
class Language implements EntityInterface
{
    use EntityTrait,
        Publishable,
        WeightDisplayableTrait,
        TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'label', type: 'string', length: 255, nullable: true)]
    private ?string $label = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'string', length: 255, nullable: false)]
    private string $code;

    /**
     * @var string
     */
    #[ORM\Column(name: 'score', type: 'integer', length: 4, nullable: false, options: ['default' => 0])]
    private int $score = 0;

    #[ORM\Column(name: 'description', type: 'text', length: 16777215, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'country_code', type: 'string', length: 255, nullable: true)]
    private ?string $countryCode = null;

    #[ORM\Column(name: 'region', type: 'string', length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(name: 'people', type: 'string', length: 255, nullable: true)]
    private ?string $people = null;

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Security\User::class)]
    protected ?\App\Infrastructure\Entity\Security\User $creator = null;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: \App\Infrastructure\Entity\Core\Location::class, mappedBy: 'language')]
    private \Doctrine\Common\Collections\Collection $locations;

    /**
     * @var AppFile
     */
    #[ORM\JoinColumn(name: 'app_file_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Common\AppFile::class, cascade: ['persist'])]
    private ?\App\Infrastructure\Entity\Common\AppFile $appFile = null;

    /**
     * Language constructor.
     */
    public function __construct()
    {
        $this->locations = new ArrayCollection();
        $this->code = Uuid::uuid4()->toString();
        $this->isPublished = false;
        $this->score = 0;
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
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return Language
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Language
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param ArrayCollection $locations
     * @return Language
     */
    public function setLocations(?ArrayCollection $locations): Language
    {
        $this->locations = $locations;
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
     * @return Language
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
     * @return Language
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
     * @param $people
     * @return $this
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
     * @param User|null $creator
     * @return $this
     */
    public function setCreator(?User $creator): Language
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return AppFile|null
     */
    public function getAppFile(): ?AppFile
    {
        return $this->appFile;
    }

    /**
     * @param AppFile|null $appFile
     * @return $this
     */
    public function setAppFile(?AppFile $appFile): Language
    {
        $this->appFile = $appFile;
        return $this;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setLanguage($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getLanguage() === $this) {
                $location->setLanguage(null);
            }
        }

        return $this;
    }
}
