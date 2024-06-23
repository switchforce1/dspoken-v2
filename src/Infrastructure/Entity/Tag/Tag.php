<?php
declare(strict_types=1);

namespace App\Entity\Tag;

use App\Entity\Common\CodedTrait;
use App\Entity\Common\EntityTrait;
use App\Entity\Common\IdentifierTrait;
use App\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Table(name="tag_tag")
 * @ORM\Entity(repositoryClass="App\Repository\Tag\TagRepository")
 */
class Tag implements EntityInterface
{
    use IdentifierTrait, EntityTrait, CodedTrait;

    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
    }

    /**
     * @var string
     */
    private string $defaultLabel;

    /**
     * @var string
     */
    private string $defaultDescription;

    /**
     * @var Collection|null
     */
    private ?Collection $tagVersions;

    /**
     * @return string
     */
    public function getDefaultLabel(): string
    {
        return $this->defaultLabel;
    }

    /**
     * @param string $defaultLabel
     * @return Tag
     */
    public function setDefaultLabel(string $defaultLabel): Tag
    {
        $this->defaultLabel = $defaultLabel;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultDescription(): string
    {
        return $this->defaultDescription;
    }

    /**
     * @param string $defaultDescription
     * @return Tag
     */
    public function setDefaultDescription(string $defaultDescription): Tag
    {
        $this->defaultDescription = $defaultDescription;
        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getTagVersions(): ?Collection
    {
        return $this->tagVersions;
    }

    /**
     * @param Collection|null $tagVersions
     * @return Tag
     */
    public function setTagVersions(?Collection $tagVersions): Tag
    {
        $this->tagVersions = $tagVersions;
        return $this;
    }
}
