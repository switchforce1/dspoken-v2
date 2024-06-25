<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\CodedTrait;
use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\Core\ReferenceLanguage;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Table(name: 'report_report_section_version')]
#[ORM\Entity(repositoryClass: \App\Infrastructure\Repository\Report\ReportSectionVersionRepository::class)]
class ReportSectionVersion implements EntityInterface
{
    use IdentifierTrait, EntityTrait, CodedTrait;

    /**
     * @var string
     */
    #[ORM\Column(name: 'title', type: 'string', length: 255, nullable: true)]
    private string $title;

    /**
     * @var string
     */
    #[ORM\Column(name: 'content', type: 'text', length: 65535, nullable: true)]
    private string $content;

    /**
     * @var ?ReportSection
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Report\ReportSection::class, inversedBy: 'reportSectionVersions')]
    private ?ReportSection $reportSection;

    /**
     * @var ?ReferenceLanguage
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ReportSectionVersion
     */
    public function setTitle(string $title): ReportSectionVersion
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return ReportSectionVersion
     */
    public function setContent(string $content): ReportSectionVersion
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return ReportSection|null
     */
    public function getReportSection(): ?ReportSection
    {
        return $this->reportSection;
    }

    /**
     * @param ReportSection|null $reportSection
     * @return ReportSectionVersion
     */
    public function setReportSection(?ReportSection $reportSection): ReportSectionVersion
    {
        $this->reportSection = $reportSection;
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
     * @return ReportSectionVersion
     */
    public function setReferenceLanguage(?ReferenceLanguage $referenceLanguage): ReportSectionVersion
    {
        $this->referenceLanguage = $referenceLanguage;
        return $this;
    }
}
