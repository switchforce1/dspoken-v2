<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Common;

use App\Infrastructure\Entity\Core\ReferenceLanguage;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class EntityVersion
 * @package App\Infrastructure\Entity\Common
 */
#[ORM\MappedSuperclass]
abstract class EntityVersion
{
    /**
     * @var string
     */
    #[ORM\Column(name: 'code', type: 'string', length: 64, nullable: true)]
    protected ?string $code = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'label', type: 'string', length: 255, nullable: true)]
    protected ?string $label = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    protected ?string $description = null;

    /**
     * @var ReferenceLanguage
     */
    #[ORM\JoinColumn(name: 'reference_language_id', nullable: false)]
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\ReferenceLanguage::class)]
    protected ?\App\Infrastructure\Entity\Core\ReferenceLanguage $referenceLanguage = null;

    /**
     * EntityVersion constructor.
     */
    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
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
     * @return EntityVersion
     */
    public function setCode(string $code): EntityVersion
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return EntityVersion
     */
    public function setLabel(string $label): EntityVersion
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
     * @return EntityVersion
     */
    public function setDescription(string $description): EntityVersion
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ReferenceLanguage
     */
    public function getReferenceLanguage(): ReferenceLanguage
    {
        return $this->referenceLanguage;
    }

    /**
     * @param ReferenceLanguage $referenceLanguage
     * @return EntityVersion
     */
    public function setReferenceLanguage(ReferenceLanguage $referenceLanguage): EntityVersion
    {
        $this->referenceLanguage = $referenceLanguage;
        return $this;
    }
}