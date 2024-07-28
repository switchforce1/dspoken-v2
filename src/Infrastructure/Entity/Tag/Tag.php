<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Tag;

use App\Infrastructure\Entity\Common\CodedTrait;
use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Table(name: 'tag_tag')]
#[ORM\Entity(repositoryClass: \App\Infrastructure\Repository\Tag\TagRepository::class)]
class Tag implements EntityInterface
{
    use IdentifierTrait, EntityTrait, CodedTrait;

    #[ORM\Column(name: 'default_label', type: 'string', length: 64, nullable: false)]
    private string $defaultLabel;

    #[ORM\Column(name: 'default_description', type: 'text', nullable: true)]
    private string $defaultDescription;

    #[ORM\OneToMany(targetEntity: TagVersion::class, mappedBy: 'tag')]
    private ?Collection $tagVersions;

    public function __construct()
    {
        $this->code = Uuid::uuid4()->toString();
    }

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
