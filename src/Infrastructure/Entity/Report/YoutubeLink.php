<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\CodedTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="report_youtube_link")
 * @ORM\Entity(repositoryClass="App\Repository\Report\YoutubeLinkRepository")
 */
class YoutubeLink extends AbstractReport implements EntityInterface
{
    use IdentifierTrait;

    /**
     * Assert\@Assert\Regex("^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$")
     * @var ?string
     * @ORM\Column(name="video_link", type="string", length=255, nullable=true)
     */
    private ?string $videoLink;

    /**
     * @var ?string|null
     * @ORM\Column(name="channel_link", type="string", length=255, nullable=true)
     */
    private ?string $channelLink;

    /**
     * @var Article|null
     * @ORM\ManyToOne(targetEntity="App\Infrastructure\Entity\Report\Article")
     */
    private ?Article $article;

    /**
     * @var Collection|ArrayCollection|null
     * @ORM\OneToMany(targetEntity="App\Infrastructure\Entity\Report\DefaultReportVersion", mappedBy="youtubeLink",
     *     cascade={"persist", "remove"})
     */
    private ?Collection $defaultReportVersions;

    public function __construct()
    {
        parent::__construct();
        $this->defaultReportVersions = new ArrayCollection();
    }

    /**
     * @return ?string
     */
    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    /**
     * @param ?string $videoLink
     * @return self
     */
    public function setVideoLink(?string $videoLink): self
    {
        $this->videoLink = $videoLink;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getChannelLink(): ?string
    {
        return $this->channelLink;
    }

    /**
     * @param ?string $channelLink
     * @return self
     */
    public function setChannelLink(?string $channelLink): self
    {
        $this->channelLink = $channelLink;
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
     * @return self
     */
    public function setDefaultReportVersions(Collection $defaultReportVersions): self
    {
        $this->defaultReportVersions = $defaultReportVersions;
        return $this;
    }

    /**
     * @param DefaultReportVersion $defaultReportVersion
     * @return $this
     */
    public function addDefaultReportVersion(DefaultReportVersion $defaultReportVersion): self
    {
        if (!$this->defaultReportVersions->contains($defaultReportVersion)) {
            $defaultReportVersion->setYoutubeLink($this);
            $this->defaultReportVersions->add($defaultReportVersion);
        }
        return $this;
    }

    /**
     * @param DefaultReportVersion $defaultReportVersion
     * @return $this
     */
    public function removeDefaultReportVersion(DefaultReportVersion $defaultReportVersion): self
    {
        if ($this->defaultReportVersions->contains($defaultReportVersion)) {
            $defaultReportVersion->setYoutubeLink(null);
            $this->defaultReportVersions->removeElement($defaultReportVersion);
        }

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
