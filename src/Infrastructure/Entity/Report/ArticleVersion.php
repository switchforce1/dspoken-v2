<?php
declare(strict_types=1);

namespace App\Entity\Report;

use App\Entity\Common\IdentifierTrait;
use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="report_article_version")
 * @ORM\Entity(repositoryClass="App\Repository\Report\ArticleVersionRepository")
 */
class ArticleVersion extends AbstractReportVersion implements EntityInterface
{
    use IdentifierTrait;

    /**
     * @var Article|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Report\Article", inversedBy="articleVersions")
     */
    private ?Article $article;

    public function __construct()
    {
        parent::__construct();
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
     * @return ArticleVersion
     */
    public function setArticle(?Article $article): self
    {
        $this->article = $article;
        return $this;
    }
}
