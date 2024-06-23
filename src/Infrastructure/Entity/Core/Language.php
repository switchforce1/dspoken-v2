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
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * La langue créée
 * @ORM\Table(name="core_language")
 * @ORM\Entity(repositoryClass="App\Repository\Core\LanguageRepository")
 */
class Language implements EntityInterface
{
    use EntityTrait,
        Publishable,
        WeightDisplayableTrait,
        TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var string
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(name="score", type="integer", length=4, nullable=false, options={"default" : 0})
     */
    private $score = 0;

    /**
     * @ORM\Column(name="description", type="text", length=16777215, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="country_code", type="string", length=255, nullable=true)
     */
    private $countryCode;

    /**
     * @ORM\Column(name="region", type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(name="people", type="string", length=255, nullable=true)
     */
    private $people;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Security\User")
     */
    protected $creator;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Infrastructure\Entity\Core\Location", mappedBy="language")
     */
    private $locations;

    /**
     * @var AppFile
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Common\AppFile", cascade={"persist"})
     * @ORM\JoinColumn(name="app_file_id", referencedColumnName="id", nullable=true)
     */
    private $appFile;

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
}
