<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Tag;

use App\Infrastructure\Entity\Common\EntityTrait;
use App\Infrastructure\Entity\Common\EntityVersion;
use App\Infrastructure\Entity\Common\IdentifierTrait;
use App\Infrastructure\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tag_tag_version")
 * @ORM\Entity(repositoryClass="App\Repository\Tag\TagVersionRepository")
 */
class TagVersion extends EntityVersion implements EntityInterface
{
    use IdentifierTrait, EntityTrait;
}