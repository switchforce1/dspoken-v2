<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\CodedTrait;
use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Table(name: 'report_report_section')]
#[ORM\Entity(repositoryClass: \App\Repository\Report\ReportSectionRepository::class)]
class ReportSection implements EntityInterface
{
    use IdentifierTrait, EntityTrait, CodedTrait;

    /**
     * @var ?string
     */
    #[ORM\Column(name: 'default_title', type: 'string', length: 255, nullable: false)]
    private ?string $defaultTitle;

    /**
     * @var ?string
     */
    #[ORM\Column(name: 'default_content', type: 'text', length: 65535, nullable: true)]
    private ?string $defaultContent;

    /**
     * @var ?string
     */
    #[ORM\Column(name: 'image_url', type: 'string', length: 255, nullable: true)]
    private ?string $imageUrl;

    /**
     * @var ?string
     */
    #[ORM\Column(name: 'template_code', type: 'string', length: 255, nullable: true)]
    private ?string $templateCode;

    /**
     * @var int
     */
    #[ORM\Column(name: 'position', type: 'integer', length: 255, nullable: false)]
    private int $position = 0;

    /**
     * @var Article|null
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Report\Article::class, inversedBy: 'reportSections')]
    private ?Article $article;

    /**
     * @var Collection|ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: \App\Infrastructure\Entity\Report\ReportSectionVersion::class, mappedBy: 'reportSection', cascade: ['persist', 'remove'])]
    private Collection $reportSectionVersions;

    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
        $this->reportSectionVersions = new ArrayCollection();
    }

    public function getDefaultTitle(): ?string
    {
        return $this->defaultTitle;
    }

    public function setDefaultTitle(?string $defaultTitle): self
    {
        $this->defaultTitle = $defaultTitle;
        return $this;
    }

    public function getDefaultContent(): ?string
    {
        return $this->defaultContent;
    }

    public function setDefaultContent(?string $defaultContent): self
    {
        $this->defaultContent = $defaultContent;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getTemplateCode(): ?string
    {
        return $this->templateCode;
    }

    public function setTemplateCode(?string $templateCode): self
    {
        $this->templateCode = $templateCode;
        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function getReportSectionVersions(): Collection
    {
        return $this->reportSectionVersions;
    }

    public function setReportSectionVersions(Collection $reportSectionVersions): self
    {
        $this->reportSectionVersions = $reportSectionVersions;
        return $this;
    }

    public function addReportSectionVersion(ReportSectionVersion $reportSectionVersion): self
    {
        if (!$this->reportSectionVersions->contains($reportSectionVersion)) {
            $reportSectionVersion->setReportSection($this);
            $this->reportSectionVersions->add($reportSectionVersion);
        }
        return $this;
    }

    public function removeReportSectionVersion(ReportSectionVersion $reportSectionVersion): self
    {
        if ($this->reportSectionVersions->contains($reportSectionVersion)) {
            $reportSectionVersion->setReportSection(null);
            $this->reportSectionVersions->removeElement($reportSectionVersion);
        }

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): ReportSection
    {
        $this->article = $article;
        return $this;
    }
}
