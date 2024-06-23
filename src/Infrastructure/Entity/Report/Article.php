<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="report_article")
 * @ORM\Entity(repositoryClass="App\Repository\Report\ArticleRepository")
 */
class Article extends AbstractReport implements EntityInterface
{
    use IdentifierTrait;

    /**
     * @var string
     * @ORM\Column(name="template_code", type="string", length=255, nullable=false)
     */
    private string $templateCode;

    /**
     * @var Collection|ArrayCollection|null
     * @ORM\OneToMany(targetEntity="App\Infrastructure\Entity\Report\ReportSection", mappedBy="article")
     */
    private ?Collection $reportSections;

    /**
     * @var Collection|ArrayCollection|null
     * @ORM\OneToMany(targetEntity="App\Infrastructure\Entity\Report\ArticleVersion", mappedBy="article",
     *      cascade={"persist", "remove"})
     */
    private ?Collection $articleVersions;

    public function __construct()
    {
        parent::__construct();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->reportSections = new ArrayCollection();
        $this->articleVersions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTemplateCode(): ?string
    {
        return $this->templateCode;
    }

    /**
     * @param string $templateCode
     * @return self
     */
    public function setTemplateCode(?string $templateCode): self
    {
        $this->templateCode = $templateCode;
        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getReportSections(): ?Collection
    {
        return $this->reportSections;
    }

    /**
     * @param Collection|null $reportSections
     * @return self
     */
    public function setReportSections(?Collection $reportSections): self
    {
        $this->reportSections = $reportSections;
        return $this;
    }

    public function addReportSection(ReportSection $reportSection)
    {
        if (!$this->reportSections->contains($reportSection)) {
            $reportSection->setArticle($this);
            $this->reportSections->add($reportSection);
        }

        return $this;
    }

    public function removeReportSection(ReportSection $reportSection)
    {
        if ($this->reportSections->contains($reportSection)) {
            $reportSection->setArticle(null);
            $this->reportSections->removeElement($reportSection);
        }

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getArticleVersions(): ?Collection
    {
        return $this->articleVersions;
    }

    /**
     * @param Collection|null $articleVersions
     * @return self
     */
    public function setArticleVersions(?Collection $articleVersions): self
    {
        $this->articleVersions = $articleVersions;
        return $this;
    }

    public function addArticleVersion(ArticleVersion $articleVersion): self
    {
        if (!$this->articleVersions->contains($articleVersion)) {
            $articleVersion->setArticle($this);
            $this->articleVersions->add($articleVersion);
        }

        return $this;
    }

    public function removeArticleVersion(ArticleVersion $articleVersion): self
    {
        if ($this->articleVersions->contains($articleVersion)) {
            $articleVersion->setArticle(null);
            $this->articleVersions->removeElement($articleVersion);
        }
        return $this;
    }
}