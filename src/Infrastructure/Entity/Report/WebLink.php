<?php

namespace App\Entity\Report;

use App\Entity\Common\IdentifierTrait;
use App\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="report_web_link")
 * @ORM\Entity(repositoryClass="App\Repository\Report\WebLinkRepository")
 */
class WebLink extends AbstractReport implements EntityInterface
{
    use IdentifierTrait;
    public const TYPE_WIKIPEDIA = 'TYPE_WIKIPEDIA';
    public const ALLOWED_TYPES= [
        self::TYPE_WIKIPEDIA
    ];

    /**
     * @var string
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private string $url;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private string $type;

    /**
     * @var Article|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Report\Article")
     */
    private ?Article $article;

    /**
     * @var Collection|ArrayCollection|null
     * @ORM\OneToMany(targetEntity="App\Entity\Report\DefaultReportVersion", mappedBy="webLink")
     */
    private ?Collection $defaultReportVersions;

    public function __construct()
    {
        parent::__construct();
        $this->defaultReportVersions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return WebLink
     */
    public function setUrl(?string $url): WebLink
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return WebLink
     */
    public function setType(?string $type): WebLink
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getDefaultReportVersions(): Collection
    {
        return $this->defaultReportVersions;
    }

    /**
     * @param Collection $defaultReportVersions
     * @return WebLink
     */
    public function setDefaultReportVersions(Collection $defaultReportVersions): WebLink
    {
        $this->defaultReportVersions = $defaultReportVersions;
        return $this;
    }

    /**
     * @return Article|null
     */
    public function getArticle(): ?Article
    {
        return $this->article;
    }

    /**
     * @param Article|null $article
     * @return self
     */
    public function setArticle(?Article $article): self
    {
        $this->article = $article;
        return $this;
    }
}