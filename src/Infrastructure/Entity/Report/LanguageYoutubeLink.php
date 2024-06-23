<?php
declare(strict_types=1);

namespace App\Entity\Report;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\IdentifierTrait;
use App\Entity\Common\TimestampableTrait;
use App\Entity\Core\Language;
use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="report_language_youtube_link")
 * @ORM\Entity(repositoryClass="App\Repository\Report\LanguageYoutubeLinkRepository")
 */
class LanguageYoutubeLink implements EntityInterface
{
    use EntityTrait,
        IdentifierTrait,
        TimestampableTrait;

    /**
     * @var Language|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Language")
     */
    private ?Language $language;

    /**
     * @var YoutubeLink|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Report\YoutubeLink")
     */
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
