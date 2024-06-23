<?php
declare(strict_types=1);

namespace App\Entity\Report;

use App\Entity\Common\EntityTrait;
use App\Entity\Common\IdentifierTrait;
use App\Entity\Common\Publishable;
use App\Entity\Common\TimestampableTrait;
use App\Entity\Core\Language;
use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="report_language_article")
 * @ORM\Entity(repositoryClass="App\Repository\Report\LanguageArticleRepository")
 */
class LanguageArticle implements EntityInterface
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
     * @var Article|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Report\Article")
     */
    private ?Article $article;

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
     * @return LanguageArticle
     */
    public function setLanguage(?Language $language): self
    {
        $this->language = $language;
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
     * @return LanguageArticle
     */
    public function setArticle(?Article $article): self
    {
        $this->article = $article;
        return $this;
    }
}
