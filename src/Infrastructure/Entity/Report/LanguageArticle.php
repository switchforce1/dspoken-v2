<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Report;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\Common\Publishable;
use App\Infrastructure\Entity\Common\TimestampableTrait;
use App\Infrastructure\Entity\Core\Language;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'report_language_article')]
#[ORM\Entity(repositoryClass: \App\Infrastructure\Repository\Report\LanguageArticleRepository::class)]
class LanguageArticle implements EntityInterface
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
     * @var Article|null
     */
    #[ORM\ManyToOne(targetEntity: \App\Infrastructure\Entity\Report\Article::class)]
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
