<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\CodedTrait;
use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Core\ReferenceLanguage;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\MappedSuperclass]
abstract class AbstractReportVersion
{
    use CodedTrait, EntityTrait;


    /**
     * @var string
     */
    #[ORM\Column(name: 'title', type: 'string', length: 255, nullable: false)]
    private string $title;

    /**
     * @var string
     */
    #[ORM\Column(name: 'description', type: 'text', nullable: false)]
    private string $description;

    /**
     * @var ReferenceLanguage|null
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\ReferenceLanguage::class)]
    private ?ReferenceLanguage $referenceLanguage;

    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param ?string $title
     * @return AbstractReportVersion
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
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
     * @return AbstractReportVersion
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ReferenceLanguage|null
     */
    public function getReferenceLanguage(): ?ReferenceLanguage
    {
        return $this->referenceLanguage;
    }

    /**
     * @param ReferenceLanguage|null $referenceLanguage
     * @return AbstractReportVersion
     */
    public function setReferenceLanguage(?ReferenceLanguage $referenceLanguage): self
    {
        $this->referenceLanguage = $referenceLanguage;
        return $this;
    }
}
