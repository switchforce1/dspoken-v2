<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Tag;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\EntityVersion;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Infrastructure\Entity\Tag\Tag;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'tag_tag_version')]
#[ORM\Entity(repositoryClass: \App\Infrastructure\Repository\Tag\TagVersionRepository::class)]
class TagVersion extends EntityVersion implements EntityInterface
{
    use IdentifierTrait, EntityTrait;

    #[ORM\ManyToOne(targetEntity: Tag::class, inversedBy: 'tagVersions')]
    #[ORM\JoinColumn(name: 'tag_id', nullable: false)]
    protected ?Tag $tag;

    public function __construct()
    {
        parent::__construct();
    }

    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    public function setTag(?Tag $tag): TagVersion
    {
        $this->tag = $tag;

        return $this;
    }
}