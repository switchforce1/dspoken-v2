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
 * @ORM\Table(name="report_language_web_link")
 * @ORM\Entity(repositoryClass="App\Repository\Report\LanguageWebLinkRepository")
 */
class LanguageWebLink implements EntityInterface
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
     * @var WebLink|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Report\WebLink")
     */
    private ?WebLink $webLink;

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
     * @return LanguageWebLink
     */
    public function setLanguage(?Language $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return WebLink|null
     */
    public function getWebLink(): ?WebLink
    {
        return $this->webLink;
    }

    /**
     * @param WebLink|null $webLink
     * @return LanguageWebLink
     */
    public function setWebLink(?WebLink $webLink): self
    {
        $this->webLink = $webLink;
        return $this;
    }
}
