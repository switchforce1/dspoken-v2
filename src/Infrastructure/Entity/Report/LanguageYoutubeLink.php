<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\Core\Language;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'report_language_youtube_link')]
#[ORM\Entity(repositoryClass: \App\Repository\Report\LanguageYoutubeLinkRepository::class)]
class LanguageYoutubeLink implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait,
        TimestampableTrait;

    /**
     * @var Language|null
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Core\Language::class)]
    private ?Language $language;

    /**
     * @var YoutubeLink|null
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Report\YoutubeLink::class)]
    private ?YoutubeLink $youtubeLink;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return Language|null
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @param Language|null $language
     * @return LanguageYoutubeLink
     */
    public function setLanguage(?Language $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return YoutubeLink|null
     */
    public function getYoutubeLink(): ?YoutubeLink
    {
        return $this->youtubeLink;
    }

    /**
     * @param YoutubeLink|null $youtubeLink
     * @return LanguageYoutubeLink
     */
    public function setYoutubeLink(?YoutubeLink $youtubeLink): self
    {
        $this->youtubeLink = $youtubeLink;
        return $this;
    }
}
