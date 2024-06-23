<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Core;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Langue de refenrce connue (au debut francais, anglais ... puis allemend ...)
 *
 * @ORM\Table(name="core_reference_language")
 * @ORM\Entity(repositoryClass="App\Repository\Core\ReferenceLanguageRepository")
 */
class ReferenceLanguage implements EntityInterface
{
    use EntityTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="code", type="string", length=5, nullable=false, unique=true)
     */
    private $code;

    /**
     * @ORM\Column(name="label", type="string", length=255, nullable=false, unique=true)
     */
    private $label;

    /**
     * @var string
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $description;

    /**
     * @var boolean
     * @ORM\Column(name="enabled", type="boolean", length=255, nullable=true)
     */
    protected $enabled = true;

    /**
     * @var boolean
     * @ORM\Column(name="is_default", type="boolean", length=255, nullable=true)
     */
    protected $isDefault = false;

    /**
     * ReferenceLanguage constructor.
     */
    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return ReferenceLanguage
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return ReferenceLanguage
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ReferenceLanguage
     */
    public function setDescription(string $description): ReferenceLanguage
    {
        $this->description = $description;
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
     * @return ReferenceLanguage
     */
    public function setEnabled(bool $enabled): ReferenceLanguage
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     * @return ReferenceLanguage
     */
    public function setIsDefault(bool $isDefault): ReferenceLanguage
    {
        $this->isDefault = $isDefault;
        return $this;
    }
}
